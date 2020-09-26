<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Admin\MainRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Registry;
use Illuminate\Http\Request;
use App\Services\ResponseLib;

class RegistryController extends BaseController
{
    function __construct()
    {
        parent::__construct();

        view()->share(['heading' => 'Справочник', 'title' => 'Справочник']);
    }

    public function index()
    {
        $registryHistory = Registry::where('group', 'tariff_data')->latest()->get();
        $registryData = Registry::where('group', 'tariff_data')->latest()->first();

        foreach ($registryHistory as $item) {
            $item->history = json_decode($item->value);
        }

        $data['registryData'] = json_decode($registryData->value);
        $data['registryHistory'] = $registryHistory;
        $data['registry'] = $this->registry;

        return view('admin.registry.index', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PageRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->tariff) {
            $tariffData = json_encode($request->tariff);
            $tariffKey = date('Y_m_d_His') .'_tariff'; //2020_06_30_182544_tariff

            $registry = new Registry();
            $registry->key   = $tariffKey;
            $registry->value = $tariffData;
            $registry->group = 'tariff_data';
            $registryResult  = $registry->save();

        } else {
            foreach ($request->all() as $key => $value) {
                \DB::table('registry')->where('key', $key)
                    ->update(['value' => $value]);
            }
            $registryResult = true;
        }

        return $this->redirectResponse($registryResult, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении'], route('admin.registry.index'));
    }

    public function getForm()
    {
        $response = new ResponseLib();

        $response->dialog([
            "title" => "Новые тарифы",
            "body" => view("admin.registry.modal_tariff_form")->render(),
            "size" => "default",
        ]);
        $response->send();
    }
}
