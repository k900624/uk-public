@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.polls.index' => $heading,
        ]
    ])
    @endbreadcrumbs
@endsection

@section('content')
    <div class="col-md-12">
        <section class="block">

            <header class="block_header">
                <h2>
                    {{ $title }}
                    <span class="label label-success animated bounceIn" title="Количество голосований">{{ $countPolls }}</span>
                </h2>
                <div class="action">
                    <a href="{{ route('admin.polls.create') }}" class="btn btn-default btn-xs"><span class="hidden-xs">Добавить</span> <i class="fa fa-plus"></i></a>
                </div>
            </header>

            <div class="block_body">

                <table class="table table-striped table-condensed">
                    <thead class="hidden-xs">
                        <tr>
                            <th>Тема голосования</th>
                            <th class="hidden-sm">Дата создания</th>
                            <th>Статус</th>
                            <th class="col-action">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($polls as $poll)
                            @php $published = ($poll->published)
                                ? '<a href="'. route('admin.polls.deactivate', $poll->id) .'"
                                    title="Отключить страницу"
                                    onclick="return confirmMessage(\'Вы подтверждаете отключение? Голосование будет недоступно пользователям!\')"><span class="label label-success">Вкл.</span></a>'
                                : '<a href="'. route('admin.polls.activate', $poll->id) .'"
                                    title="Активировать страницу"
                                    onclick="return confirmMessage(\'Вы подтверждаете включение? Голосование будет доступно пользователям!\')"><span class="label label-grey">Выкл.</span></a>'
                            @endphp
                            <tr>
                                <td><a href="{{ route('admin.polls.edit', $poll->id) }}" title="Редактировать">{{ $poll->title }}</a></td>
                                <td class="hidden-sm hidden-xs">
                                    <time title="{{ format_date($poll->created_at, 4) }}">
                                        {{ \Carbon\Carbon::parse($poll->created_at)->diffForHumans() }}
                                    </time>
                                </td>
                                <td class="hidden-xs text-center">{!! $published !!}</td>
                                <td class="col-action">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.polls.statistic', $poll->id) }}" class="btn btn-default btn-sm" title="Смотреть статистику"><i class="fa fa-bar-chart"></i></a>
                                        <a href="{{ route('admin.polls.edit', $poll->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="{{ route('admin.polls.delete', $poll->id) }}" class="btn btn-sm btn-danger hidden-xs" onclick="return confirmMessage()"><i class="fa fa-trash-o"></i></a>
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Голосования не найдены</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

            @if ($polls->hasPages())
                <div class="block_footer">
                    <div class="pagination-block">
                        {{ $polls->links() }}
                    </div>
                </div>
            @endif

        </section>
    </div>
@endsection
