<?php

namespace App\Repositories\Admin\Statistic;

use App\Repositories\CoreRepository;
use App\Models\Hit as Model;
use \DB;

class HitRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllHits($startDate = 0, $finishDate = 0, $perPage)
    {
        $result = $this
            ->startConditions()
            ->select(
                'hits.*',
                 DB::raw("count(*) as hits")
              )
            ->where([
                ["created_at", ">=", $startDate ." 00:00:00"],
                ["created_at", "<=", $finishDate ." 23:59:59"],
            ])
            ->groupBy('object_alias')
            ->limit($perPage)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return $result;
    }

    /**
     *
     */
    public function getCountHits($startDate = 0, $finishDate = 0)
    {
        $result = $this
            ->startConditions()
            ->where([
                ["created_at", ">=", $startDate ." 00:00:00"],
                ["created_at", "<=", $finishDate ." 23:59:59"],
            ])
            ->orderBy('created_at', 'desc')
            ->count();

        return $result;
    }

}