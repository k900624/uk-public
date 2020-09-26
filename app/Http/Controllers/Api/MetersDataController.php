<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\MetersData;
use App\Models\Users\User;
use App\Models\Registry;
use App\Models\Users\Area;
use Jenssegers\Date\Date;
use App\Http\Resources\MetersDataResource;
use App\Repositories\Front\Users\AreaRepository;
use App\Repositories\Front\Users\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MetersDataController extends ApiController
{
    protected $areaRepo;
    protected $userRepo;

    public function __construct(AreaRepository $areaRepo, UserRepository $userRepo)
    {
        parent::__construct();

        $this->areaRepo = $areaRepo;
        $this->userRepo = $userRepo;
    }

    public function store(Request $request)
    {
        $rules = [
            'water' => 'required|numeric',
        ];

        // Валидация с ajax
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::findOrFail(Auth::user()->id);

        $area = $this->areaRepo->getUserArea($user->id);

        if ($area) {
            $metersData = MetersData::where('area_id', $area->area_id)->latest()->first();
            $metersData->water = $request->water;

            if ($metersData->save()) {
                return new MetersDataResource($metersData);
            }
        }
    }

    public function getMeters(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $area = $this->areaRepo->getUserArea($user->id);

        $area_id = $area->area_id;

        $tariffData = Registry::where('group', 'tariff_data')->latest()->first();

        $metersDataAll = MetersData::where('area_id', $area_id)->oldest()->get();

        foreach ($metersDataAll as $k => $meter) {
            if ($k > 0) {
                $metersDataAll[$k]->waterMeters = $metersDataAll[$k]->water - $metersDataAll[$k - 1]->water;
                $metersDataAll[$k]->electricityMeters = $metersDataAll[$k]->electricity - $metersDataAll[$k - 1]->electricity;
                $metersDataAll[$k]->electricityNightMeters = $metersDataAll[$k]->electricity_night - $metersDataAll[$k - 1]->electricity_night;
            } else {
                // Берем первоначальные показания счетчиков
                $area = $this->areaRepo->getArea($area_id);

                $сounters = json_decode($area->сounters);

                $metersDataAll[$k]->waterMeters = $сounters->water_first_meter;
                $metersDataAll[$k]->electricityMeters = $сounters->electr_first_meter;
                $metersDataAll[$k]->electricityNightMeters = $сounters->electr_night_first_meter;
            }

            $date = new Date($meter->created_at);
            $metersDataAll[$k]->month = $date->format('F Y');
        }

        $meters['tariff'] = json_decode($tariffData->value);
        $lastMeters = MetersData::where('area_id', $area_id)->latest()->limit(2)->get();
        $meters['prev'] = $lastMeters[1];
        $meters['currency'] = $lastMeters[0];
        $meters['currencyMonth'] = getCurrencyMonth();
        $meters['currencyYear'] = date('Y');
        $meters['metersDataPeriodNotStarted'] = $this->metersDataPeriodNotStarted;
        $meters['metersDataPeriodEnded'] = $this->metersDataPeriodEnded;
        $meters['all'] = $metersDataAll;

        return new MetersDataResource($meters);
    }

    public function getMetersHistory(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $period = $request->period;

        $area = $this->areaRepo->getUserArea($user->id);

        $area_id = $area->area_id;

        // Данные за период
        if ($period == 'year') {
            $metersData = MetersData::where('area_id', $area_id)
                ->whereRaw('YEAR(`created_at`) = YEAR(NOW())')->oldest()->get();
        } else {
            $metersData = MetersData::where('area_id', $area_id)->oldest()->get();
        }

        foreach ($metersData as $k => $meter) {

            if ($metersData[$k]->water == '0.00' || is_null($metersData[$k]->water)) {
                continue;
            }

            if ($k > 0) {
                $waterMeters = $metersData[$k]->water - $metersData[$k - 1]->water;
                $electricityMeters = $metersData[$k]->electricity - $metersData[$k - 1]->electricity;
                $electricityNightMeters = $metersData[$k]->electricity_night - $metersData[$k - 1]->electricity_night;
            } else {
                // Берем первоначальные показания счетчиков
                $area = $this->areaRepo->getArea($area_id);

                $сounters = json_decode($area->сounters);

                $waterMeters = $сounters->water_first_meter;
                $electricityMeters = $сounters->electr_first_meter;
                $electricityNightMeters = $сounters->electr_night_first_meter;
            }

            $metersArr['water'][] = ($waterMeters > 0) ? $waterMeters : 0;
            $metersArr['electricity'][] = ($electricityMeters > 0) ? $electricityMeters : 0;
            $metersArr['electricity_night'][] = ($electricityNightMeters > 0) ? $electricityNightMeters : 0;

            $months[] = format_date($meter->created_at, 7);
        }

        $result['meters'] = $metersArr;
        $result['labels'] = $months;

        return new MetersDataResource($result);
    }
}
