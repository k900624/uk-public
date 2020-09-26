<?php

namespace App\Repositories\Admin;

use App\Repositories\CoreRepository;
use App\Models\Service as Model;
use App\Models\ServiceGroup;

class ServiceRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getServicesPagination($perPage)
    {
        $result = $this
            ->startConditions()
            ->orderBy('created_at', 'asc')
            ->paginate($perPage);

        return $result;
    }

    public function getGroupServices($perPage, $selectGroup)
    {
        $result = $this
            ->startConditions()
            ->where('group_id', $selectGroup)
            ->orderBy('created_at', 'asc')
            ->paginate($perPage);

        return $result;
    }

    public function getGroups()
    {
        $result = ServiceGroup::orderBy('title', 'asc')->get();

        return $result;
    }

    public function getCountServices()
    {
        $result = $this
            ->startConditions()
            ->get()
            ->count();

        return $result;
    }

    public function getCountGroupServices($selectGroup)
    {
        $result = $this
            ->startConditions()
            ->where('group_id', $selectGroup)
            ->get()
            ->count();

        return $result;
    }

    public function getAreaServices($area_id)
    {
        $result = $this
            ->startConditions()
            ->select(
                'services.*'
            )
            ->join('user_service', 'user_service.service_id', '=', 'services.id', 'left')
            ->where('user_service.area_id', $area_id)
            ->get();

        return $result;
    }

}