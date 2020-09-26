@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.registry.index' => $heading,
        ]
    ])
    @endbreadcrumbs
@endsection

@section('content')
    <div class="col-md-9 col-md-offset-1">
        <section class="block">

            <header class="block_header">
                <h2>
                    {{ $title }}
                </h2>
            </header>

            <div class="block_body">
                <form action="{{ route('admin.registry.store') }}" class="validate" method="post" accept-charset="utf-8">
                    {{ csrf_field() }}
                    <fieldset>
                        
                        <legend>Тарифы</legend>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-tariff-current" data-toggle="tab">Текущие</a></li>
                            <li><a href="#tab-tariff-history" data-toggle="tab">История</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab-tariff-current">
                                <table class="table">
                                    <tr>
                                        <th>Вода, руб.</th>
                                        <td>{{ $registryData->water }}</td>
                                    </tr>
                                    <tr>
                                        <th>Электроэнергия, руб.</th>
                                        <td>{{ $registryData->electricity }}</td>
                                    </tr>
                                    <tr>
                                        <th>Электроэнергия (ночь), руб.</th>
                                        <td>{{ $registryData->electricity_night }}</td>
                                    </tr>
                                    <tr>
                                        <th>Дата окончания действия</th>
                                        <td>{{ date('d.m.Y', strtotime($registryData->end_day)) }}</td>
                                    </tr>
                                </table>
                                <br>
                                <a href="javascript:;" class="js-modal btn btn-success" data-remote="{{ route('admin.registry.ajax_tariff_form') }}">Новые тарифы</a>
                            </div>
                            <div class="tab-pane fade" id="tab-tariff-history">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Вода, руб.</th>
                                        <th>Электроэнергия, руб.</th>
                                        <th>Электроэнергия (ночь), руб.</th>
                                        <th>Дата окончания действия</th>
                                        <th>Дата добавления</th>
                                    </tr>
                                    @foreach ($registryHistory as $item)
                                    <tr @if ($loop->first) class="success" @endif>
                                        <td>{{ $item->history->water }}</td>
                                        <td>{{ $item->history->electricity }}</td>
                                        <td>{{ $item->history->electricity_night }}</td>
                                        <td>{{ date('d.m.Y', strtotime($item->history->end_day)) }}</td>
                                        <td>{{ date('d.m.Y', strtotime($item->created_at)) }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <br>
                        <legend>Другое</legend>

                        <div class="form-group">
                            <h5>Период сдачи показаний каждого месяца</h5>
                            <div class="row">
                                <div class="col-sm-12 row">
                                    <label class="col-sm-2">Дата начала</label>
                                    <div class="col-sm-3">
                                        <input class="form-control" type="number" name="meter_reading_period_start" value="{{ $registry['meter_reading_period_start'] }}">
                                    </div>
                                    <label class="col-sm-2">Дата окончания</label>
                                    <div class="col-sm-3">
                                        <input class="form-control" type="number" name="meter_reading_period_end" value="{{ $registry['meter_reading_period_end'] }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Дата расчета квитанций</h5>
                            <div class="row">
                                <div class="col-sm-3">
                                    <input class="form-control" type="number" name="date_receipt_calculation" value="{{ $registry['date_receipt_calculation'] }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="total_area">Общая площадь, сот <span class="required">*</span></label>
                            <input type="text" name="total_area" value="{{ $registry['total_area'] }}" id="total_area" class="form-control" required="">
                        </div>

                    </fieldset>

                    <div class="form-actions">
                        <input type="submit" name="submit" value="Сохранить" class="btn btn-success">
                    </div>

                </form>
            </div>
        </section>
    </div>
@endsection
