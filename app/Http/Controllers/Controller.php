<?php

namespace App\Http\Controllers;

use App\Services\Notify;
use \DB;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use \WhichBrowser\Parser as WhichBrowser;
use App\Models\Registry;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $notify;
    protected $ua;
    protected $registry;
    protected $metersDataPeriodStart;
    protected $metersDataPeriodEnd;
    protected $metersDataPeriodEnded;
    protected $metersDataPeriodNotStarted;

    function __construct()
    {
        $this->notify = new Notify();
        $this->ua = new WhichBrowser(getallheaders(), ['detectBots' => true]);

        Date::setLocale('ru');

        $this->registry = Registry::all([
                'key', 'value', 'group'
            ])
            ->where('group', '!=', 'tariff_data')
            ->keyBy('key')
            ->transform(function ($registry) {
                return $registry->value;
            })
            ->toArray();

        $this->metersDataPeriodEnded = false;
        $this->metersDataPeriodNotStarted = false;

        // Указанные числа платежа
        $meterReadingPeriodStart = $this->registry['meter_reading_period_start'];
        $meterReadingPeriodEnd = $this->registry['meter_reading_period_end'];

        // Сегодня
        $today = Carbon::today();
        $todayYear = $today->year;
        $todayMonth = $today->month;

        // Переводим в дату
        $this->metersDataPeriodStart = Carbon::create($todayYear, $todayMonth, $meterReadingPeriodStart, 0, 0, 0, 'Asia/Yekaterinburg');
        $this->metersDataPeriodEnd = Carbon::create($todayYear, $todayMonth, $meterReadingPeriodEnd, 0, 0, 0, 'Asia/Yekaterinburg');

        // Проверяем, закончился ли период подачи
        // платежей
        if ($today > $this->metersDataPeriodEnd) {
            $this->metersDataPeriodEnded = true;
        } elseif ($today < $this->metersDataPeriodStart) {
            $this->metersDataPeriodNotStarted = true;
        }
    }

    /**
     * Добавляем событие в журнал событий
     *
     */
    protected function setFeed($text, $type = 'success', $user_id = null, $new = true)
    {
        if ( ! $user_id) {
            if (Auth::check()) {
                $user_id = Auth::user()->id;
            } else {
                $user_id = 0;
            }
        }

        $data = [
            'activity'   => $text,
            'user_id'    => $user_id,
            'type'       => $type,
            'created_at' => Carbon::now()->toDateTimeString(),
            'new'        => $new ? 0 : 1
        ];
        return DB::table('activities')->insert($data);
    }

    protected function cronEmulation()
    {
        ignore_user_abort(); // продолжать выполнение скрипта после закрытия браузера - скрипт работает в background режиме
        set_time_limit(0); // убираем ограничение по времени выполнение скрипта
        $interval = 60*30; // время выполнения - каждые пол часа

        do {
            // сюда пишем код который необходимо выполнять по крону
            // ...
            sleep($interval); // ожидаем пол часа
        } while (true);
    }

}
