<?php

namespace App\Repositories\Admin\Statistic;

use App\Repositories\CoreRepository;
use App\Models\Statistic as Model;
use \DB;

class StatisticRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllStatistic($startDate = 0, $finishDate = 0, $perPage)
    {
        $result = $this
            ->startConditions()
            ->where([
                ["last_visit", ">=", $startDate ." 00:00:00"],
                ["last_visit", "<=", $finishDate ." 23:59:59"],
            ])
            ->limit($perPage)
            ->orderBy('last_visit', 'desc')
            ->paginate();

        return $result;
    }
    
    public function getVisitsByDay($startDate = 0, $finishDate = 0)
    {
        $result = $this
            ->startConditions()
            ->select(DB::raw("count(*) as count, DATE_FORMAT(last_visit, '%Y-%m-%d 05:00:00') as date"))
            ->where([
                ["last_visit", ">=", $startDate ." 00:00:00"],
                ["last_visit", "<=", $finishDate ." 23:59:59"],
            ])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return $result;
    }

    public function getUniqueVisitsByDay($startDate = 0, $finishDate = 0)
    {
        $result = $this
            ->startConditions()
            ->select(DB::raw("count(*) as count, DATE_FORMAT(last_visit, '%Y-%m-%d 05:00:00') as date"))
            ->where("last_visit", ">=", "'". $startDate ." 00:00:00'")
            ->where("last_visit", "<=", "'". $finishDate ." 23:59:59'")
            ->where('visits', '=', '1')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return $result;
    }

    public function getCountUniqueVisits($startDate = 0, $finishDate = 0)
    {
        $result = $this
            ->startConditions()
            ->where("last_visit", ">=", "'". $startDate ." 00:00:00'")
            ->where("last_visit", "<=", "'". $finishDate ." 23:59:59'")
            ->where('visits', '=', '1')
            ->orderBy('last_visit', 'desc')
            ->count();

        return $result;
    }

  // --------------------------------------------------------------------

    /**
     *
     */
    public function getCountVisits($startDate = 0, $finishDate = 0)
    {
        $result = $this
            ->startConditions()
            ->where([
                ["last_visit", ">=", $startDate ." 00:00:00"],
                ["last_visit", "<=", $finishDate ." 23:59:59"],
            ])
            ->orderBy('last_visit', 'desc')
            ->count();

        return $result;
    }

}