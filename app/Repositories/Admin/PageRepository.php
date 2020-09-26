<?php

namespace App\Repositories\Admin;

use App\Repositories\CoreRepository;
use App\Models\Page as Model;

class PageRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getPagesPagination($perPage = 10)
    {
        $result = $this
            ->startConditions()
            ->limit($perPage)
            ->latest()
            ->where('cat_id', '=', 0)
            ->paginate($perPage);

        return $result;
    }

    public function getAllPages()
    {
        $result = $this
            ->startConditions()
            ->latest()
            ->where('cat_id', '=', 0)
            ->get();

        return $result;
    }

    public function getCountPages()
    {
        $result = $this
            ->startConditions()
            ->where('cat_id', '=', 0)
            ->get()
            ->count();

        return $result;
    }

}