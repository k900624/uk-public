<?php

namespace App\Http\Controllers\Admin\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Repositories\Admin\Users\AreaRepository;
use App\Repositories\Admin\Users\UserRepository;
use App\Repositories\Admin\ServiceRepository;
use App\Models\Users\Area;
use App\Models\Users\User;
use App\Models\MetersData;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\Notification;
use App\Services\ResponseLib;
use Carbon\Carbon;

class AreaController extends BaseController
{
    protected $areaRepo;
    protected $userRepo;
    protected $serviceRepo;
    
    public function __construct(AreaRepository $areaRepo, UserRepository $userRepo, ServiceRepository $serviceRepo)
    {
        parent::__construct();
        
        $this->areaRepo = $areaRepo;
        $this->userRepo = $userRepo;
        $this->serviceRepo = $serviceRepo;
        
        view()->share(['heading' => 'Участки', 'title' => 'Список участков']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;

        $areas = $this->areaRepo->getAllAreasPagination($perPage);

        foreach ($areas as $area) {
            // Выводим все участки у которых указаны какие-либо
            // данные за период для сдачи показаний
            $currentMetersExists = MetersData::where([
                    ['area_id', '=', $area->id],
                    ['created_at', '>', $this->metersDataPeriodStart],
                    ['created_at', '<', $this->metersDataPeriodEnd],
                ])->get();

            $area->status = '';

            // Проверяем, каких данных у них не хватает,
            // и присваиваем статус
            if ($currentMetersExists->count()) {
                if ($currentMetersExists[0]->water == null || $currentMetersExists[0]->water == '0.00') {
                    $area->status = 'no-data-water';
                } elseif ($currentMetersExists[0]->electricity == null || $currentMetersExists[0]->electricity == '0.00') {
                    $area->status = 'no-data-electricity';
                } elseif (is_null($currentMetersExists[0]->paid_at)) {
                    $area->status = 'no-paid';
                } elseif ( ! is_null($currentMetersExists[0]->paid_at)) {
                    $area->status = 'is-paid';
                }
            } else {
                $area->status = 'no-data';
            }
        }
        $countAreas = $this->areaRepo->getCountAreas();

        $data['countAreas'] = $countAreas;
        $data['areas'] = $areas;

        return view('admin.users.areas.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['area'] = new Area();
        $data['action'] = route('admin.areas.store');
        $data['users'] = $this->userRepo->getUsersOnly()->toArray();

        return view('admin.users.areas.form', $data)->with(['title' => 'Добавление участка']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'address'            => 'required|string',
            'contract_number'    => 'required|integer',
            'contract_date'      => 'required|string',
            'contract_file'      => 'sometimes|mimes:jpg,jpeg,png,bmp,pdf,zip|max:5120',
            'land_area'          => 'required|numeric',
            'house_area'         => 'required|numeric',
            'quantity_residents' => 'required|integer',
            'сounters'           => 'required',
        ]);

        // Save files to storage
        $fileName = null;
        if ($request->hasFile('contract_file')) {
            $fileName = $request->file('contract_file')->store('files', 'public');
        }

        $area = new Area();
        $area->address            = $request->address;
        $area->contract_number    = $request->contract_number;
        $area->contract_date      = $request->contract_date;
        $area->contract_file      = $fileName;
        $area->land_area          = $request->land_area;
        $area->house_area         = $request->house_area;
        $area->quantity_residents = $request->quantity_residents;
        $area->сounters           = json_encode($request->сounters);
        $area->save();

        if ($area) {

            $user = User::find($request->main_user);
            $user->areas()->attach($area->id, ['main' => 'on']);

            if ( ! $user) {
                $this->notify->error('Ошибка при сохранении');
                return back()
                    ->withInput();
            }

            $this->notify->success('Успешно сохранено');
                return redirect()
                    ->route('admin.areas.index');
        } else {
            $this->notify->error('Ошибка при сохранении');
            return back()
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $area = $this->areaRepo->getArea($id);

        $this->recordExists($area);

        $user_id = $area->users()->firstOrFail()->id;
        $user = $this->userRepo->getUser($user_id);

        // Profile
        $area->contract_date = date('d.m.Y', strtotime($area->contract_date));
        $area->сounters = json_decode($area->сounters);

        // Meters Data
        $currentMetersExists = MetersData::where([
                ['area_id', '=', $area->id],
                ['created_at', '>', $this->metersDataPeriodStart],
                ['created_at', '<', $this->metersDataPeriodEnd],
            ])->get();

        if ($currentMetersExists->count()) {
            $noMetersData = false;
            if ($currentMetersExists[0]->water == null || $currentMetersExists[0]->water == '0.00') {
                $area->status = 'no-data-water';
            }
        } else {
            $noMetersData = true;
        }

        $metersData = MetersData::where('area_id', $area->id)->latest()->get();

        // Services
        $services = $this->serviceRepo->getAreaServices($area->id);

        // Requests
        $requests = ServiceRequest::where('area_id', $area->id)->get();

        // Notifications
        $notifications = $user->notifications()->latest()->get();

        // Messages
        $messages = [];

        $data['area'] = $area;
        $data['user'] = $user;
        $data['noMetersData'] = $noMetersData;
        $data['meters_data'] = $metersData;
        $data['notifications'] = $notifications;
        $data['services'] = $services;
        $data['requests'] = $requests;
        $data['messages'] = $messages;
        $data['metersDataPeriodNotStarted'] = $this->metersDataPeriodNotStarted;
        $data['metersDataPeriodEnded'] = $this->metersDataPeriodEnded;

        return view('admin.users.areas.details', $data)->with(['heading' => $area->name, 'title' => 'Информация об участке']);
    }

    public function ajaxSetMeters($id)
    {
        $response = new ResponseLib();

        $area = $this->areaRepo->getArea($id);

        // Meters data
        $currentMetersExists = MetersData::where([
                ['area_id', '=', $area->id],
                ['created_at', '>', $this->metersDataPeriodStart],
                ['created_at', '<', $this->metersDataPeriodEnd],
            ])->get();

        if ($currentMetersExists->count()) {
            $limitMeters = 2;
        } else {
            $limitMeters = 1;
        }
        $lastMeters = MetersData::where('area_id', $area->id)->latest()->limit($limitMeters)->get()->toArray();

        // Если есть предыдущие показания
        if (count($lastMeters) == 1) {
            $meters['prev'] = $lastMeters[0];
        } elseif (count($lastMeters) > 1) {
            $meters['currency'] = $lastMeters[0];
            $meters['prev'] = $lastMeters[1];
        } else {
            // Берем первоначальные показания счетчиков
            $сounters = json_decode($area->сounters);

            $meters['prev'] = [
                'water' => $сounters->water_first_meter,
                'electricity' => $сounters->electr_first_meter,
                'electricity_night' => $сounters->electr_night_first_meter,
            ];
        }

        $data['meters_data'] = $meters;

        $data['area_id'] = $id;
        $data['сounters'] = json_decode($area['сounters']);

        $response->dialog([
            "title" => "Внести показания",
            "body"  => view("admin.users.areas.includes.modal_set_meters_form", $data)->render(),
            "size"  => "default",
        ]);
        $response->send();
    }

    public function setMetersStore(Request $request)
    {
        $this->validate($request, [
            'water'             => 'nullable|numeric',
            'electricity'       => 'required|numeric',
            'electricity_night' => 'required|numeric',
            'area_id'           => 'required|integer',
        ]);

        $area = Area::findOrFail($request->area_id);

        if ($area) {
            $metersData = new MetersData;
            $metersData->area_id           = $request->area_id;
            $metersData->water             = $request->water;
            $metersData->electricity       = $request->electricity;
            $metersData->electricity_night = $request->electricity_night;
            $metersData->save();

            $result = [
                'type'    => 'success',
                'message' => 'Показания успешно сохранены!'
            ];

        } else {
            $result = [
                'type'    => 'danger',
                'message' => 'Показания не сохранены! Попробуйте снова!'
            ];
        }

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = $this->areaRepo->getArea($id);
        
        $this->recordExists($area);

        $area->сounters = json_decode($area->сounters);

        $usersSelect = $this->userRepo->getMainUserArea($id)->toArray();
        $users = $this->userRepo->getUsersOnly()->toArray();
        
        if ($usersSelect) {
            $data['users'] = $this->similaire($usersSelect, $users);
        } else {
            $data['users'] = $users;
        }

        $data['area'] = $area;
        $data['action'] = route('admin.areas.update', $id);
        

        return view('admin.users.areas.form', $data)->with(['title' => 'Редактирование участка']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
    }

    /**
     * Invoice the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function invoice($id)
    {
        //
    }

    /**
     * Invoice the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function metersDataEdit($id)
    {
        //
    }

    private function similaire($a, $b)
    {
        foreach ($a as $row) {
            $a1[$row->user_id] = $row;
        }
        
        $result = [];
        $i = 0;
        foreach ($b as $var) {
            if (array_key_exists($var->user_id, $a1)) {
                $var->selected = true;
            }
            $result[$i] = $var;
            $i++;
        }
        return $result;
    }

}
