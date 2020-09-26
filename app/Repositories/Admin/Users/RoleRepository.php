<?php

namespace App\Repositories\Admin\Users;

use App\Repositories\CoreRepository;
use App\Models\Users\Role as Model;

class RoleRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllRoles($perPage = null)
    {
        $result = $this
            ->startConditions()
            ->limit($perPage)
            ->paginate($perPage);

        return $result;
    }

    public function getCountRoles()
    {
        $result = $this
            ->startConditions()
            ->get()
            ->count();

        return $result;
    }

}