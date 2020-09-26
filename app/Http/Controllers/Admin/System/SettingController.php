<?php

namespace App\Http\Controllers\Admin\System;

use Illuminate\Http\Request;
use \DB;
use App\Http\Controllers\Admin\BaseController;

class SettingController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        view()->share(['heading' => 'Настройки', 'title' => 'Настройки']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['generals'] = DB::table('settings')
            ->orderBy('ordering', 'asc')
            ->where(['type' => 'general'])
            ->get();

        $data['seo'] = DB::table('settings')
            ->orderBy('ordering', 'asc')
            ->where(['type' => 'seo'])
            ->get();

        $data['contacts'] = DB::table('settings')
            ->orderBy('ordering', 'asc')
            ->where(['type' => 'contacts'])
            ->get();

        $keys = DB::table('settings')
            ->orderBy('ordering', 'asc')
            ->where(['type' => 'keys'])
            ->get();

        foreach ($keys as $value) {
            $keys_new[$value->group][] = $value;
        }

        $data['keys'] = $keys_new;

        return view('admin.system.settings.index', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            DB::table('settings')->where('key', $key)
                ->update(['value' => $value]);
        }

//        set_feed('Изменил настройки');
        $this->notify->success('Настройки обновлены');
        return redirect()
            ->route('admin.settings.index');
    }

}
