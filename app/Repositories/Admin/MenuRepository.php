<?php

namespace App\Repositories\Admin;

use App\Repositories\CoreRepository;
use App\Models\Menu as Model;
use \DB;

class MenuRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllMenus($group_id)
    {
        $result = $this
            ->startConditions()
            ->orderBy('ordering', 'asc')
            ->where('group_id', $group_id)
            ->get();

        return $result;
    }

    public function getMenusPagination($perPage, $group_id)
    {
        $result = $this
            ->startConditions()
            ->orderBy('ordering', 'asc')
            ->limit($perPage)
            ->where('group_id', $group_id)
            ->paginate($perPage);

        return $result;
    }

    public function getTreeMenus($group_id)
    {
        $result = $this
            ->startConditions()
            ->where([
                'group_id'  => $group_id
            ])
            ->orderBy('ordering', 'asc')
            ->get();
            

        return $this->buildTree($result);
    }

    public function getAllGroups()
    {
        $result = DB::table('menu_groups')
            ->where('name', '!=', 'admin')
            ->get();

        return $result;
    }

    public function getFirstGroup()
    {
        $result = DB::table('menu_groups')
            ->where('name', '!=', 'admin')
            ->first();

        return $result->id;
    }

    public function getGroupById($id)
    {
        $result = DB::table('menu_groups')->where('id', $id)->first();

        return $result;
    }
    
    public function checkUniqueGroupTitle($name)
    {
        $result = DB::table('menu_groups')
            ->where('name', $name)
            ->exists();

        return $result;
    }

}