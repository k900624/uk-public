@extends('layouts.admin.app')

@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.statistic.index' => $heading,
        ]
     ])
    @endbreadcrumbs
@endsection

@if ($visits)
@section('after-scripts')
    <link href="{{ url('vendor/morris.js/morris.css') }}" rel="stylesheet">
    <script src="{{ url('vendor/morris.js/raphael-2.0.2.min.js') }}"></script>
    <script src="{{ url('vendor/morris.js/morris.min.js') }}"></script>

    <script src="{{ url('vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ url('vendor/bootstrap-datepicker/js/locales/bootstrap-datepicker.ru.js') }}"></script>
    <link href="{{ url('vendor/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet">

    <script>
        $(document).ready(function() {
            
            var data = [
                @foreach ($visits as $item)
                {
                    'date'  : "{{ format_date($item['date'], 6) }}",
                    'visits': {{ $item['visits'] }},
                    'unique': {{ $item['unique'] }}
                },
                @endforeach
            ];
            
            var barChart = Morris.Bar({
                element: 'bar',
                data: data,
                xkey: 'date',
                ykeys: ['visits', 'unique'],
                labels: ['Посещения', 'Уникальные'],
                barColors: ['#4285f4', '#ff3547'],
                barOpacity: 0.7,
                barGap: 1,
                barSizeRatio: 0.5,
                parseTime: false,
                hideHover: 'auto',
                redraw: true,
                resize: true
            });

            var lineChart = Morris.Line({
                element: 'line',
                data: data,
                xkey: 'date',
                ykeys: ['visits', 'unique'],
                labels: ['Посещения', 'Уникальные'],
                lineColors: ['#4285f4', '#ff3547'],
                parseTime: false,
                hideHover: 'auto',
                fillOpacity: 0.6,
                pointSize: 4,
                redraw: true,
                resize: true
            });

            var areaChart = Morris.Area({
                element: 'area',
                data: data,
                xkey: 'date',
                ykeys: ['visits', 'unique'],
                labels: ['Посещения', 'Уникальные'],
                lineColors: ['#4285f4', '#ff3547'],
                parseTime: false,
                hideHover: 'auto',
                behaveLikeLine: true,
                fillOpacity: 0.6,
                pointSize: 4,
                redraw: true,
                resize: true
            });

            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                var target = $(e.target).attr('href') // activated tab

                switch (target) {
                    case '#bar':
                        barChart.redraw();
                        $(window).trigger('resize');
                        break;
                    case '#line':
                        lineChart.redraw();
                        $(window).trigger('resize');
                        break;
                    case '#area':
                        areaChart.redraw();
                        $(window).trigger('resize');
                        break;
                }
            });

            var barWidth=($('#bar').width()/3)*(0.4);

            $('#bar').find('rect[fill="#0b62a4"]').each(function (i) {
                var pos = $(this).offset();
                var top = pos.top;
                top -= 20; //originate at the top of the bar

                //get the height of the bar
                var barHeight = barChart.bars[i];

                // top+=barHeight[0]/2; //so we can now stick the number in the vertical-center of the bar as desired
                var left = pos.left;
                
                if (data[i] && data[i].visits) {
                    $div = $('<div class="morris-count" style="top:'+ top +'px;left:'+ left +'px;" />'); 
                    $div.text(data[i].visits); //get the count
                    $('body').append($div); //stick it into the dom
                }
            });

            $('.datetimepicker').datepicker({
                format: 'yyyy-mm-dd',
                language: 'ru'
            });
            $('.js-stat-refresh').on('click', function(e) {
                e.preventDefault();
                location.reload();
            });
        });

        function setDatePeriod(p) {
            
            var e_date = new Date(),
                s_date = new Date();

            switch (p) {
                case 1:
                    break;
                case 2:
                    s_date.setDate(s_date.getDate() - 1);
                    break;
                case 3:
                    s_date.setDate(s_date.getDate() - 7);
                    break;
                case 4:
                    s_date.setDate(s_date.getDate() - 31);
                    break;
                case 5:
                    s_date.setDate(s_date.getDate() - 366);
                    break;
            }
            $('#dPickerFrom').datepicker('update', s_date);
            $('#dPickerTo').datepicker('update', e_date);
        }
    </script>
@endsection
@endif

@section('content')
    <div class="col-md-12">
        <section class="block">
            <div class="block_body">
                <form action="{{ route('admin.statistic.index') }}" id="stat-form" method="get" accept-charset="utf-8">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">

                                <div data-date-format="YYYY-MM-DD" id="dPickerFrom" data-pick-time="false" class="datetimepicker input-group date mb-lg">
                                    <input value="{{ $startDate }}" type="text" class="form-control" name="start_date" placeholder="Выводить с">
                                    <span class="input-group-addon" style="cursor: pointer;">
                                        <span class="fa-calendar fa"></span>
                                    </span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">

                                <div data-date-format="YYYY-MM-DD" id="dPickerTo" data-pick-time="false" class="datetimepicker input-group date mb-lg">
                                    <input value="{{ $finishDate }}" type="text" class="form-control" name="finish_date" placeholder="По">
                                    <span class="input-group-addon" style="cursor: pointer;">
                                        <span class="fa-calendar fa"></span>
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group">
                                <a href="javascript:setDatePeriod(1);" class="btn btn-default">Сегодня</a>
                                <a href="javascript:setDatePeriod(2);" class="btn btn-default">Вчера</a>
                                <a href="javascript:setDatePeriod(3);" class="btn btn-default">Неделя</a>
                                <a href="javascript:setDatePeriod(4);" class="btn btn-default">Месяц</a>
                                <a href="javascript:setDatePeriod(5);" class="btn btn-default ">Год</a>
                                <button type="submit" class="btn btn-success">Применить</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>

@if ($visits)
<div class="row">
    <div class="col-md-12">
        <div class="block">
            <div class="block_header">
                <h2>График посещений</h2>
                
                <div class="action">
                    <a href="#bar" aria-controls="bar" role="tab" data-toggle="tab" class="btn btn-default btn-xs"><i class="fa fa-bar-chart"></i></a>
                    <a href="#line" aria-controls="line" role="tab" data-toggle="tab" class="btn btn-default btn-xs"><i class="fa fa-line-chart"></i></a>
                    <a href="#area" aria-controls="area" role="tab" data-toggle="tab" class="btn btn-default btn-xs"><i class="fa fa-area-chart line"></i></a>
                </div>
            </div>

            <div class="block_body">
                <div class="tab-content">
                    <div id="bar" role="tabpanel" class="tab-pane active grafic"></div>
                    <div id="line" role="tabpanel" class="tab-pane grafic"></div>
                    <div id="area" role="tabpanel" class="tab-pane grafic"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if (isset($browsers) && isset($platform) && isset($devices))
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <section class="block">
                    <header class="block_header">
                        <h2>График по браузерам</h2>
                    </header>
                    <div class="block_body">
                        <div id="browsers" class="grafic-pie"></div>
                    </div>
                </section>
            </div>
            <div class="col-md-4">
                <section class="block">
                    <header class="block_header">
                        <h2>График по OC</h2>
                    </header>
                    <div class="block_body">
                        <div id="platform" class="grafic-pie"></div>
                    </div>
                </section>
            </div>
            <div class="col-md-4">
                <section class="block">
                    <header class="block_header">
                        <h2>График по устройствам</h2>
                    </header>
                    <div class="block_body">
                        <div id="devices" class="grafic-pie"></div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-md-6 hidden-xs">
        <div class="widget">
            <div class="widget_body flex align-items-center justify-content-between">
                <div class="display-3 mr-20"><i class="fa fa-users"></i></div>
                <div class="flex-auto">
                    <p class="display-4 animated bounceIn mb-0">{{ $countUniqueVisits }}</p>
                    <div class="text-muted text-center">{{ plural_form($countUniqueVisits, array('уникальный посетитель', 'уникальных посетителя', 'уникальных посетителей')) }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 hidden-xs">
        <div class="widget">
            <div class="widget_body flex align-items-center justify-content-between">
                <div class="display-3 mr-20"><i class="fa fa-users"></i></div>
                <div class="flex-auto">
                    <p class="display-4 animated bounceIn mb-0">{{ $countVisits }}</p>
                    <div class="text-muted text-center">{{ plural_form($countVisits, array('посещение', 'посещения', 'посещений')) }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <section class="block">

            <header class="block_header">
                <h2>Лента активности
                    @if ($countVisits > 200)
                        <small>Показаны только последние 200 посещений из {{ $countVisits }}</small>
                    @endif
                </h2>
                <div class="action">
                    <a href="javascript:;" class="btn btn-default btn-xs js-stat-refresh"><span class="hidden-xs">Обновить</span> <i class="fa fa-refresh"></i></a>
                </div>
            </header>

            <div class="block_body">
                <table class="table table-striped table-condensed statistic">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="small-column">Последний визит</th>
                            <th class="hidden-xs small-column">Всего посещений</th>
                            <th class="hidden-xs small-column">Переход с сайта</th>
                            <th class="hidden-xs small-column">Местоположение</th>
                            <th class="col-action">Действие</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($statistic as $item)
                            <tr>
                                <td class="nowrap">
                                    <span class="icon icon_os--{{ ($item->params['platform']) ? \Str::slug(strtolower($item->params['platform'])) : 'unknown-platform' }}"
                                        title="{{ ($item->params['platform']) ? $item->params['platform'] : 'Unknown Platform' }}"></span>
                                    <span class="icon icon_browser--{{ ($item->params['browser']) ? \Str::slug(strtolower($item->params['browser'])) : 'unknown-browser' }}"
                                        title="{{ $item->params['browser'] . ($item->params['browser']) ? $item->params['browser_version'] : 'Unknown Browser' }}"></span>
                                    @if ((isset($item->params['device_type']) && $item->params['device_type'] == 'mobile') ||
                                        (isset($item->params['mobile'])) && $item->params['mobile'] != "")
                                        <span class="icon icon_device--mobile" title="Mobile"></span>
                                    @elseif (isset($item->params['device_type']) && $item->params['device_type'] == 'bot')
                                        <span class="icon icon_device--bot" title="Bot"></span>
                                    @endif
                                </td>
                                <td>
                                    <time class="timeago"
                                        datetime="{{ date('c', mysql_to_unix($item->last_visit)) }}"
                                        title="{{ format_date($item->last_visit, 4) }}">
                                        {{ format_date($item->last_visit, 4) }}
                                    </time>
                                </td>
                                <td class="hidden-xs">{{ $item->visits }}</td>
                                <td class="hidden-xs">
                                    <span title="{{ (isset($item->params['referrer'])) ? $item->params['referrer'] : '' }}">
                                        {!! (isset($item->params['referrer'])) ? ellipsize($item->params['referrer'], 30, 1) : '' !!}
                                    </span>
                                </td>
                                <td class="hidden-xs">
                                    @if (defined('GEOIP_COUNTRY_EDITION'))
                                        @if ($item->geoip_record)
                                            <span class="icon icon_flag">
                                                <img src="{{ url('images/flags/flat/16/'. $item->geoip_record['country_code'] .'.png') }}" alt="{{ $item->geoip_record['country_name'] }}">
                                            </span>
                                            <strong>{{ $item->geoip_record['country_name'] }}</strong><br />
                                            {{ $item->geoip_record['city'] }}
                                        @endif
                                    @else
                                        Нет данных
                                    @endif
                                </td>
                                <td class="col-action">
                                    <div class="btn-group">
                                        <a href="javascript:;" data-remote="{{ route('admin.statistic.show', $item->id) }}" class="js-modal btn btn-sm btn-default"><i class="fa fa-search"></i></a>
                                        <a href="{{ route('admin.statistic.delete', $item->id) }}" class="btn btn-sm btn-danger hidden-xs" onclick="return confirmMessage()"><i class="fa fa-trash-o"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Посетители не найдены</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($statistic->hasPages())
                <div class="block_footer">
                    <div class="pagination-block">
                        {{ $statistic->links() }}
                    </div>
                </div>
            @endif
        
        </section>
    </div>
@endsection