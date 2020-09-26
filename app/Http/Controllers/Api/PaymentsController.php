<?php

namespace App\Http\Controllers\Api;

use App\Models\Payment;
use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\PaymentsResource;
use Jenssegers\Date\Date;
use App\Repositories\Front\Users\AreaRepository;
use App\Models\Registry;
use App\Models\MetersData;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends ApiController
{
    protected $areaRepo;

    public function __construct(AreaRepository $areaRepo)
    {
        parent::__construct();

        $this->areaRepo = $areaRepo;
    }

    public function index(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $period = $request->period;

        // TODO добавить в запрос period
        $payments = Payment::select('user_transactions.*')
            ->where('user_area.user_id', $user->id)
            ->join('user_area', 'user_area.area_id', '=', 'user_transactions.area_id', 'left')
            ->oldest()
            ->get();

        $balance = 0;
        foreach ($payments as $payment) {
            $date = new Date($payment->created_at);
            $payment->month = $date->format('F Y');
            $balance = ($payment->operation) ? $balance + $payment->amount : $balance - $payment->amount;
            $payment->balance = $balance;
        }

        // return new PaymentResource($payments);
        return PaymentsResource::collection($payments);
    }

    // Расчет баланса
    public function getBalance(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $payments = Payment::select('user_transactions.*')
            ->where('user_area.user_id', $user->id)
            ->join('user_area', 'user_area.area_id', '=', 'user_transactions.area_id', 'left')
            ->oldest()
            ->get();

        $balance = 0;
        foreach ($payments as $payment) {
            $balance = ($payment->operation) ? $balance + $payment->amount : $balance - $payment->amount;
            $payment->balance = $balance;
        }

        $result = [
            'isDebt' => ($balance < 0) ? true : false,
            'balanceSum' => $balance,
        ];

        PaymentResource::withoutWrapping();
        return new PaymentResource($result);
    }

    public function getMonthPayments(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $date = new Date($request->date);
        $month = $date->format('m');
        $year = $date->format('Y');

        $area = $this->areaRepo->getUserArea($user->id);

        $area_id = $area->area_id;

        $tariffData = Registry::where('group', 'tariff_data')->latest()->first();

        $tariff = json_decode($tariffData->value);
        $lastMeters = MetersData::where(function ($query) use ($area_id, $year, $month) {
                $query->where('area_id', $area_id)
                    ->whereYear('meters_data.created_at', $year)
                    ->whereMonth('meters_data.created_at', $month);
            })
            ->orWhere(function ($query) use ($area_id, $year, $month) {
                $query->where('area_id', $area_id)
                    ->whereYear('meters_data.created_at', $year)
                    ->whereMonth('meters_data.created_at', $month - 1);
            })
            ->latest()
            ->get();

        if (isset($lastMeters[1])) {
            $meters['prev'] = $lastMeters[1];
        } else {
            // Берем первоначальные показания счетчиков
            $area = $this->areaRepo->getArea($area_id);

            $сounters = json_decode($area->сounters);

            $meters['prev']['electricity'] = $сounters->electr_first_meter;
            $meters['prev']['electricity_night'] = $сounters->electr_night_first_meter;
            $meters['prev']['water'] = $сounters->water_first_meter;
        }

        $meters['currency'] = $lastMeters[0];

        $date = new Date($lastMeters[0]->created_at);
        $meters['currency']->date = $date->format('d F Y');
        $meters['currency']->month = $date->format('F Y');

        $result = [
            'tariff'  => $tariff,
            'meters'  => $meters,
        ];

        return new PaymentResource($result);
    }

    public function getLastPayments(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $area = $this->areaRepo->getUserArea($user->id);

        $area_id = $area->area_id;

        $tariffData = Registry::where('group', 'tariff_data')->latest()->first();

        $tariff = json_decode($tariffData->value);
        $lastMeters = MetersData::where('area_id', $area_id)->latest()->limit(2)->get();

        if (isset($lastMeters[1])) {
            $meters['prev'] = $lastMeters[1];
        } else {
            // Берем первоначальные показания счетчиков
            $area = $this->areaRepo->getArea($area_id);

            $сounters = json_decode($area->сounters);

            $meters['prev']['electricity'] = $сounters->electr_first_meter;
            $meters['prev']['electricity_night'] = $сounters->electr_night_first_meter;
            $meters['prev']['water'] = $сounters->water_first_meter;
        }

        $meters['currency'] = $lastMeters[0];

        $date = new Date($lastMeters[0]->created_at);
        $meters['currency']->date = $date->format('d F Y');
        $meters['currency']->month = $date->format('F Y');

        $result = [
            'tariff'  => $tariff,
            'meters'  => $meters,
        ];

        return new PaymentResource($result);
    }
}
