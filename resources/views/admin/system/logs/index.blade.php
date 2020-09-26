@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.logs.index' => $heading,
        ]
    ])
    @endbreadcrumbs
@endsection

@section('after-styles')
    <style>
        .logs-sidebar {
            display: flex;
            flex-direction: column;
            height: 100%;
            padding: 0;
            margin-bottom: 20px;
            color: #fff;
        }
        .logs-table-container {

        }
        @media only screen and (max-width: 479px) {
            .logs-table-container {
                padding: 0;
            }
        }
    </style>
@endsection


@section('after-scripts')
    <script>
        $(document).ready(function() {
            $('.table-container tr').on('click', function () {
                $('#' + $(this).data('display')).toggle();
            });
        });
    </script>
@endsection

@section('content')
    @include('admin.system.settings.includes.sidebar')

    <div class="col-md-9">
        <section class="block">

            <header class="block_header">
                <h2>
                    {{ $title }}
                </h2>
                <div class="action">
                    @if (count($files) > 1)
                        <a class="btn btn-default btn-xs" href="?delall=true" onclick="return confirmMessage()"><span class="hidden-xs">Очистить все</span> <i class="fa fa-trash-o"></i></a>
                    @endif
                </div>
            </header>

            <div class="block_body">

                <div class="logs">

                    @if ($files)
                    <div class="col-sm-3 col-md-3 logs-sidebar">
                          <div class="list-group">
                            @foreach ($files as $file)
                                <a href="?log={{ base64_encode($file) }}"
                                   class="list-group-item @if ($current_file == $file) active @endif">
                                    {{ $file }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-9 col-md-9 logs-table-container">
                        @if ($logs === null)
                            <div>
                                Файл логов >50M, пожалуйста скачайте его.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table id="table-log" class="table table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Уровень</th>
                                            <th>Дата</th>
                                            <th width="50%">Содержание</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($logs as $key => $log)
                                        <tr data-display="stack{{{ $key }}}">
                                            <td class="text-{{{ $log['level_class']}}} level">
                                                <span class="fa fa-{{{ $log['level_img'] }}}" aria-hidden="true"></span>
                                                {{ $log['level'] }}
                                            </td>
                                            <td class="date">{{{ $log['date'] }}}</td>
                                            <td class="text">
                                                @if($log['stack'])
                                                    <a class="pull-right expand btn btn-default btn-xs" data-display="stack{{{ $key }}}">
                                                        <span class="fa fa-search"></span>
                                                    </a>
                                                @endif
                                                {{{$log['text']}}}
                                                @if (isset($log['in_file'])) <br/>{{{ $log['in_file'] }}}@endif
                                                @if ($log['stack'])
                                                    <div class="stack" id="stack{{{ $key }}}"
                                                         style="display: none; white-space: pre-wrap;">{{{ trim($log['stack']) }}}
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        @endif
                        <div class="mt-20">
                            @if ($current_file)
                                <a class="btn btn-default" href="?download={{ base64_encode($current_file) }}" onclick="return confirmMessage()">
                                    <span class="fa fa-download-alt"></span> Скачать файл
                                </a>
                                -
                                <a id="delete-log" class="btn btn-danger" href="?del={{ base64_encode($current_file) }}" onclick="return confirmMessage()">
                                    <span class="fa fa-trash"></span> Удалить файл
                                </a>
                            @endif
                        </div>
                    </div>

                    @else
                        <p>Список логов пустой</p>
                    @endif

                </div>

            </div>

        </section>
    </div>
@endsection
