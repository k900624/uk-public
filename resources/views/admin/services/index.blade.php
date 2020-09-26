@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.services.index' => $heading,
        ]
     ])
    @endbreadcrumbs
@endsection

@section('content')

    @include('admin.services.includes.sidebar')

    <div class="col-md-9">
        <section class="block">
            <header class="block_header">
                <h2>
                    {{ $title }}
                    <span class="label label-success animated bounceIn" title="Количество услуг">{{ $countServices }}</span>
                </h2>
                <div class="action">
                    @haspermission('create_articles')
                    <a href="{{ route('admin.services.create', ['group' => $selectGroup]) }}" class="btn btn-default btn-xs">
                        <span class="hidden-xs">Добавить</span> <i class="fa fa-plus"></i>
                    </a>
                    @endauth
                </div>
            </header>
            <div class="block_body">

                <table class="table table-striped table-condensed">
                    <thead class="hidden-xs">
                        <tr>
                            <th>Название</th>
                            <th>Статус</th>
                            <th class="col-action">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                            @php $published = ($service->published)
                            ? '<a href="'. route('admin.services.deactivate', $service->id) .'"
                                title="Отключить статью"
                                onclick="return confirmMessage(\'Вы подтверждаете отключение? Услуга будет недоступна пользователям!\')"><span class="label label-success">Вкл.</span></a>'
                            : '<a href="'. route('admin.services.activate', $service->id) .'"
                                title="Активировать статью"
                                onclick="return confirmMessage(\'Вы подтверждаете включение? Услуга будет доступна пользователям!\')"><span class="label label-grey">Выкл.</span></a>'
                            @endphp
                            <tr>
                                <td>
                                    <a href="{{ route('admin.services.edit', $service->id) }}" title="Редактировать">{{ $service->title }}</a>
                                    <small>Группа: <a href="{{ route('admin.services.index') .'?group='. $service->group_id }}">{{ $service->group }}</a></small>
                                </td>
                                <td class="hidden-xs text-center">{!! $published !!}</td>
                                <td class="col-action">
                                    <div class="btn-group">
                                        @haspermission('edit_services')
                                        <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                                        @endauth
                                        @haspermission('delete_services')
                                        <a href="{{ route('admin.services.delete', $service->id) }}" class="btn btn-sm btn-danger hidden-xs" onclick="return confirmMessage()"><i class="fa fa-trash-o"></i></a>
                                        @endauth
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Услуги не найдены</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

            @if($services->hasPages())
                <div class="block_footer">
                    <div class="pagination-block">
                        {{ $services->links() }}
                    </div>
                </div>
            @endif

        </section>
    </div>
@endsection
