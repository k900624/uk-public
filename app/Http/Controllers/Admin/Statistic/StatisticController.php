<?php

namespace App\Http\Controllers\Admin\Statistic;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Repositories\Admin\Statistic\StatisticRepository;
use App\Services\ResponseLib;
use App\Models\Statistic;

class StatisticController extends BaseController
{
    protected $statisticRepo;
    
    public function __construct(StatisticRepository $statisticRepo)
    {
        parent::__construct();
        
        $this->statisticRepo = $statisticRepo;

        view()->share(['heading' => 'Статистика посещений', 'title' => 'Статистика посещений']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $startDate = $request->start_date;
        $finishDate = $request->finish_date;

        if ($startDate == 0) {
            $startDate = date('Y-m-d', strtotime('-1 week'));
        }
        if ($finishDate == 0) {
            $finishDate = date('Y-m-d');
        }

        $perPage = 100;
        $statistic = $this->statisticRepo->getAllStatistic($startDate, $finishDate, $perPage);
        if ($statistic) {
            foreach ($statistic as $key => $item) {
                $params = unserialize($item->params);
                $statistic[$key]->params = $params;

                // Определяем местоположение пользователя
                if (defined('GEOIP_COUNTRY_EDITION')) {
                    $statistic[$key]->geoip_record = @geoip_record_by_name($item->ip_address);
                }
            }
        }

        if (isset($browsers)) {
            $browsers = array_count_values($browsers);
            arsort($browsers);
            $data['browsers'] = $browsers;
        }
        if (isset($platform)) {
            $platform = array_count_values($platform);
            arsort($platform);
            $data['platform'] = $platform;
        }
        if (isset($devices)) {
            $devices = array_count_values($devices);
            arsort($devices);
            $data['devices'] = $devices;
        }
        
        $countUniqueVisits = $this->statisticRepo->getCountUniqueVisits($startDate, $finishDate);
        $countVisits = $this->statisticRepo->getCountVisits($startDate, $finishDate);

        $visits = [];
        $uniqueByDay = $this->statisticRepo->getUniqueVisitsByDay($startDate, $finishDate);
        $visitsByDay = $this->statisticRepo->getVisitsByDay($startDate, $finishDate);

        foreach ($visitsByDay as $k => $v){
            $visits[$k]['date'] = $v['date'];
            if (isset($uniqueByDay[$k])) {
                $visits[$k]['unique'] = $uniqueByDay[$k]['count'];
            } else {
                $visits[$k]['unique'] = 0;
            }
            $visits[$k]['visits'] = $v['count'];
        }


        $data['statistic'] = $statistic;
        $data['startDate'] = $startDate;
        $data['finishDate'] = $finishDate;
        $data['countUniqueVisits'] = $countUniqueVisits;
        $data['countVisits'] = $countVisits;
        $data['visits'] = $visits;

        return view('admin.statistic.index', $data);
    }

    public function ajax_show($id = null)
    {
        if (request()->ajax()) {

            $statistic = $this->statisticRepo->getId($id);

            $this->recordExists($statistic);

            if ($statistic) {
                // Проверяем, есть ли ip в черном списке
                //$statistic->in_blacklist = $this->is_banned;

                $statistic->params = unserialize($statistic->params);
                // Определяем местоположение пользователя
                if (defined('GEOIP_COUNTRY_EDITION')) {
                  $statistic->geoip_record = @geoip_record_by_name($statistic->ip_address);
                }

                $data['statistic'] = $statistic;

                $response = new ResponseLib();

                $response->dialog([
                    "title" => "Информация о посетителе",
                    'body'  => view('admin.statistic.modal_details', $data)->render(),
                    "size"  => "default",
                ]);
                $response->send();
            }

        } else {
            return response()->json('error', 404);
        }
    }

    /**
    * Удаляет посетителя
    */
    public function delete($id = null)
    {
        $statistic = $this->statisticRepo->getId($id);

        $this->recordExists($statistic);

        $result = Statistic::destroy($id);
        
        if ($result) {
            $this->setFeed('Удалил посетителя из статистики');
        }
        return $this->redirectResponse($result, ['success' => 'Запись удалена', 'error' => 'Ошибка удаления']);
    }
}
