@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.pages.index' => $heading,
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
                    <span class="label label-success animated bounceIn" title="Количество страниц">{{ $countPages }}</span>
                </h2>
                <div class="action">
                    <a href="{{ route('admin.pages.create') }}" class="btn btn-default btn-xs"><span class="hidden-xs">Добавить</span> <i class="fa fa-plus"></i></a>
                </div>
            </header>

            <div class="block_body">

                <table class="table table-striped table-condensed">
                    <thead class="hidden-xs">
                        <tr>
                            <th>Заголовок</th>
                            <th>Постоянная ссылка (ЧПУ URL)</th>
                            <th class="hidden-sm">Дата изменения</th>
                            <th>Статус</th>
                            <th class="col-action">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pages as $page)
                            @php $published = ($page->published)
                                ? '<a href="'. route('admin.pages.deactivate', $page->id) .'"
                                    title="Отключить страницу"
                                    onclick="return confirmMessage(\'Вы подтверждаете отключение? Страница будет недоступна пользователям!\')"><span class="label label-success">Вкл.</span></a>'
                                : '<a href="'. route('admin.pages.activate', $page->id) .'"
                                    title="Активировать страницу"
                                    onclick="return confirmMessage(\'Вы подтверждаете включение? Страница будет доступна пользователям!\')"><span class="label label-grey">Выкл.</span></a>'
                            @endphp
                            <tr>
                                <td><a href="{{ route('admin.pages.edit', $page->id) }}" title="Редактировать">{{ $page->title }}</a></td>
                                <td class="hidden-xs">{{ $page->alias }}</td>
                                <td class="hidden-sm hidden-xs">
                                    <time title="{{ format_date($page->updated_at, 4) }}">
                                        {{ \Carbon\Carbon::parse($page->updated_at)->diffForHumans() }}
                                    </time>
                                </td>
                                <td class="hidden-xs text-center">{!! $published !!}</td>
                                <td class="col-action">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="{{ route('admin.pages.delete', $page->id) }}" class="btn btn-sm btn-danger hidden-xs" onclick="return confirmMessage()"><i class="fa fa-trash-o"></i></a>
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Страницы не найдены</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

            @if ($pages->hasPages())
                <div class="block_footer">
                    <div class="pagination-block">
                        {{ $pages->links() }}
                    </div>
                </div>
            @endif

        </section>
    </div>
@endsection
