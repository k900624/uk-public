<?php

namespace App\Repositories\Front\Users;

use App\Repositories\CoreRepository;
use App\Models\Users\Area as Model;
use \DB;

class AreaRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getArea($id)
    {
        $result = $this
            ->startConditions()
            ->find($id);

        return $result;
    }
    
    public function getAreas()
    {
        $result = $this
            ->startConditions()
            ->select(
                'areas.id as area_id',
                'areas.address as title',
                'areas.contract_number',
                'users.name as username',
                'user_area.main'
            )
            ->join('user_area', 'user_area.area_id', '=', 'areas.id', 'left')
            ->join('users', 'user_area.user_id', '=', 'users.id', 'left')
            ->get();

        return $result;
    }

    public function getUserArea($user_id)
    {
        $result = $this
            ->startConditions()
            ->select(
                'areas.id as area_id',
                'areas.address as title'
            )
            ->join('user_area', 'areas.id', '=', 'user_area.area_id', 'left')
            ->where([
                'user_area.user_id' => $user_id
            ])
            ->first();

        return $result;
    }

    public function getAreaUserMain($area_id)
    {
        $result = DB::table('user_area')
            ->select(
                'users.id as user_id',
                'users.name as username'
            )
            ->join('users', 'users.id', '=', 'user_area.user_id', 'left')
            ->where([
                'user_area.area_id' => $area_id,
                'user_area.main'    => 'on',
            ])
            ->first();

        return $result;
    }

    public function getAreaUsersNotMain($area_id)
    {
        $result = DB::table('user_area')
            ->select(
                'users.id as user_id',
                'users.name as username'
            )
            ->join('users', 'users.id', '=', 'user_area.user_id', 'left')
            ->where([
                'user_area.area_id' => $area_id,
                'user_area.main'    => 'off',
            ])
            ->get();

        return $result;
    }

    public function getAreaUsers($area_id)
    {
        $result = DB::table('user_area')
            ->select(
                'users.id as user_id',
                'users.name as username'
            )
            ->join('users', 'users.id', '=', 'user_area.user_id', 'left')
            ->where([
                'user_area.area_id' => $area_id,
            ])
            ->get();

        return $result;
    }

}