@extends('layouts.admin.app')

@section('title', $title)

@if($visits)
@section('after-scripts')
    <link href="{{ url('vendor/morris.js/morris.css') }}" rel="stylesheet">
    <script src="{{ url('vendor/morris.js/raphael-2.0.2.min.js') }}"></script>
    <script src="{{ url('vendor/morris.js/morris.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            
            var data = [
                @foreach($visits as $item)
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
                goals: [0, 100],
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
                goals: [0, 100],
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
                goals: [0, 100],
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
        });
    </script>
@endsection
@endif

@section('content')

    @if($message['title'])
        <div class="col-md-12">
            <div class="alert alert-{{ $message['type'] }}">{!! $message['title'] !!}</div>
        </div>
    @endif

    <div class="col-md-3 col-sm-6 hidden-xs">
        <div class="widget">
            <a href="{{ route('admin.areas.index') }}" class="widget_link">
                <div class="widget_body flex align-items-center justify-content-between">
                    <div class="display-3 mr-20"><i class="fa fa-globe"></i></div>
                    <div class="flex-auto">
                        <p class="display-4 animated bounceIn mb-0">{{ $countAreas }}</p>
                        <div class="text-muted text-center">Участков</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 hidden-xs">
        <div class="widget">
            <a href="{{ route('admin.users.index') }}" class="widget_link">
                <div class="widget_body flex align-items-center justify-content-between">
                    <div class="display-3 mr-20"><i class="fa fa-users"></i></div>
                    <div class="flex-auto">
                        <p class="display-4 animated bounceIn mb-0">{{ $countUsers }}</p>
                        <div class="text-muted text-center">Пользователей</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 hidden-xs">
        <div class="widget">
            <a href="{{ route('admin.categories.index') }}" class="widget_link">
                <div class="widget_body flex align-items-center justify-content-between">
                    <div class="display-3 mr-20"><i class="fa fa-sitemap"></i></div>
                    <div class="flex-auto">
                        <p class="display-4 animated bounceIn mb-0">{{ $countCategories }}</p>
                        <div class="text-muted text-center">Категорий</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 hidden-xs">
        <div class="widget">
            <a href="{{ route('admin.articles.index') }}" class="widget_link">
                <div class="widget_body flex align-items-center justify-content-between">
                    <div class="display-3 mr-20"><i class="fa fa-file-text-o"></i></div>
                    <div class="flex-auto">
                        <p class="display-4 animated bounceIn mb-0">{{ $countArticles }}</p>
                        <div class="text-muted text-center">Новостей</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

</div>
<div class="row">

    <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
        <div class="block">
            <div class="block_header">
                <h2>
                    График посещений
                    <span class="label label-success animated bounceIn">Сегодня: <strong>{{ $countTodayVisits }}</strong></span>
                </h2>
                <div class="action display-inline">
                    <a href="#bar" aria-controls="bar" role="tab" data-toggle="tab" class="btn btn-default btn-xs hidden-xs"><i class="fa fa-bar-chart"></i></a>
                    <a href="#line" aria-controls="line" role="tab" data-toggle="tab" class="btn btn-default btn-xs hidden-xs"><i class="fa fa-line-chart"></i></a>
                    <a href="#area" aria-controls="area" role="tab" data-toggle="tab" class="btn btn-default btn-xs hidden-xs"><i class="fa fa-area-chart line"></i></a>
                    <a href="{{ route('admin.statistic.index') }}" class="btn btn-default btn-xs" title="Подробнее"><i class="fa fa-list"></i></a>
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

    <div class="col-lg-4 col-md-6 col-sm-12 hidden-xs">
        <div class="block block--scroll">
            <div class="block_header">
                <h2>
                    Журнал событий
                    <span class="label label-success animated bounceIn" title="Количество событий">{{ $countFeeds }}</span>
                </h2>
                <div class="action">
                    <a href="{{ route('admin.feed.index') }}" class="btn btn-default btn-xs" title="Смотреть все"><i class="fa fa-list"></i></a>
                </div>
            </div>
            <div class="block_body">
                <div id="feed" class="feed js-scroll">
                    <div class="wrapper">

                        @if($feeds)
                            <div class="vertical-line"></div>
                            
                            @foreach($feeds as $item)
                                <section class="feed-item">
                                    <div class="icon pull-left">
                                        @if($item->type == 'success')
                                            <i class="fa fa-check text-success"></i>
                                        @elseif($item->type == 'error')
                                            <i class="fa fa-ban text-danger"></i>
                                        @elseif($item->type == 'order')
                                            <i class="fa fa-shopping-cart text-success"></i>
                                        @elseif($item->type == 'register')
                                            <i class="fa fa-user text-success"></i>
                                        @elseif($item->type == 'comment')
                                            <i class="fa fa-comment text-success"></i>
                                        @elseif($item->type == 'feedback')
                                            <i class="fa fa-comment text-success"></i>
                                        @elseif($item->type == 'review')
                                            <i class="fa fa-comment text-success"></i>
                                        @endif
                                    </div>
                                    <div class="feed-item-body">
                                        <div class="text">
                                            @if($item->user_id)
                                                <a href="{{ route('admin.users.show', $item->user_id) }}">{{ $item->name }}</a>
                                            @endif
                                            {!! $item->activity !!}
                                        </div>
                                        <div class="time pull-left">
                                            <time title="{{ format_date($item->created_at, 4) }}">
                                                {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                            </time>
                                        </div>
                                    </div>
                                </section>
                            @endforeach
                            
                            <section class="feed-item">
                                <div class="icon pull-left">
                                    <i class="fa fa-arrow-down"></i>
                                </div>
                                <div class="feed-item-body">
                                    <div class="text">
                                        <a href="{{ route('admin.feed.index') }}">Больше...</a>
                                    </div>
                                </div>
                            </section>

                        @else
                            <p>Нет активности</p>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="block">
            <div class="block_header">
                <h2>Неуказанные показания</h2>
                <div class="action">
                    <a href="{{ route('admin.areas.index') }}" title="Все участки" class="btn btn-default btn-xs"><i class="fa fa-list"></i></a>
                </div>
            </div>
            <div class="block_body">
               <table class="table table-striped table-condensed">
                    <thead class="hidden-xs">
                        <tr>
                            <th>#ID</th>
                            <th>Адрес</th>
                            <th>Статус</th>
                            <th class="col-action">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($areas as $area)
                            <tr>
                                <td class="hidden-xs"><strong>{{ $area->id }}</strong></td>
                                <td>
                                    <a href="{{ route('admin.areas.show', $area->id) }}" title="Просмотр">
                                        {{ $area->address }}
                                    </a>
                                </td>
                                <td>
                                    @if ($area->status == 'no-data-water')
                                        <a href="javascript:;" class="js-modal badge badge-default" data-remote="{{ route('admin.areas.ajax_set_meters', $area->id) }}">Водоснабжение</a>
                                    @elseif ($area->status == 'no-data-electricity')
                                        <a href="javascript:;" class="js-modal badge badge-warning" data-remote="{{ route('admin.areas.ajax_set_meters', $area->id) }}">Электроэнергия</a>
                                    @elseif ($area->status == 'no-data')
                                        <a href="javascript:;" class="badge badge-danger">Показания не указаны!</a>
                                    @endif
                                </td>

                                <td class="col-action">
                                    <div class="dropdown">
                                        <a href="javascript:;" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-ellipsis-h"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="{{ route('admin.areas.show', $area->id) }}"><i class="fa fa-search"></i> Просмотр</a></li>
                                            <li><a href="javascript:;" data-remote="{{ route('admin.areas.notify') }}" data-recipient="one" data-user-id="{{ $area->user_id }}" class="js-modal"><i class="fa fa-envelope-o"></i> Отправить уведомление</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Участки не найдены</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

     <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="block">
            <div class="block_header">
                <h2>Последние заявки</h2>
                <div class="action">
                    <a href="{{ route('admin.services.index') }}" title="Все заявки" class="btn btn-default btn-xs"><i class="fa fa-list"></i></a>
                </div>
            </div>
            <div class="block_body">
                <table class="table table-striped table-condensed">
                    <thead>
                        <tr>
                            <th class="hidden-mobi">№</th>
                            <th class="hidden-mobi">Дата</th>
                            <th class="requests__descrip">Описание</th>
                            <th>Статус</th>
                            <th>Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($serviceRequests as $service)
                        <tr>
                            <td class="hidden-mobi">{{ $service->id }}</td>
                            <td class="hidden-mobi"><span class="nowrap">{{ $service->created }}</span></td>
                            <td class="requests__descrip" title="{{ $service->description }}">{{ Str::limit($service->description, 30) }}</td>
                            <td title="{{ $service->status_title }}">
                                <p class="badge badge-{{ $service->status_color }}">{{ $service->status_label }}</p>
                            </td>
                            <td class="col-action">
                                <div class="btn-group"><a class="btn btn-default btn-xs" href=""><i class="fa fa-search"></i></a></div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Участки не найдены</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="block">
            <div class="block_header">
                <h2>Задачи</h2>
                <div class="action">
                    <a href="javascript:;" class="btn btn-default btn-xs js-todo-clear">Очистить <i class="fa fa-trash-o"></i></a>
                </div>
            </div>
            <div class="block_body">
                <div class="todo-list">

                    <ul class="todo-items">
                        @foreach ($todolist as $key => $todo)
                        <li class="todo-item @if($todo->status == 1) strike @endif" data-todo-id="{{ $todo->id }}">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="js-todo-item-checkbox" @php checked($todo->status == 1) @endphp>
                                    <span class="todo-item-title">{{ $todo->title }}</span>
                                </label>
                            </div>
                            <span class="todo-item-action-remove js-todo-item-action-remove">×</span>
                        </li>
                        @endforeach
                    </ul>
                    
                    <div class="todo-add-row">
                        <div class="input-group">
                            <input type="text" class="form-control js-todo-add-input" placeholder="Новая задача">
                            <span class="input-group-btn">
                                <button data-new-todo-id="{{ $todolistAutoIncrement }}" class="btn btn-default todo-add-action js-todo-add-action" type="button">+</button>
                            </span>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="block">
         <div class="block_header">
                <h2>Мой блокнот</h2>
                <div class="action">
                    <a href="javascript:;" class="btn btn-default btn-xs js-my-notes-clear">Очистить <i class="fa fa-trash-o"></i></a>
                </div>
            </div>
            <div class="block_body">
                <div class="note-area">
                    <textarea rows="10" class="form-control" id="my-notes" placeholder="Тут можно хранить любой текст, он будет сохраняться автоматически" style="height: 238px;">{{ $notes }}</textarea>
                </div>
            </div>
        </div>
    </div>

@endsection
