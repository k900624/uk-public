@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.menu.index' => $heading,
        ]
     ])
    @endbreadcrumbs
@endsection

@section('content')

    @include('admin.menu.includes.sidebar')

    <div class="col-md-9">
        <section class="block">
            <header class="block_header">
                <h2>
                    {{ $title }}
                </h2>
                <div class="action">
                    <a href="{{ route('admin.menu.create', ['group' => $selectGroupId]) }}" class="btn btn-default btn-xs"><span class="hidden-xs">Добавить</span> <i class="fa fa-plus"></i></a>
                </div>
            </header>
            <div class="block_body">

                <table class="table table-striped table-condensed">
                    <thead class="hidden-xs">
                        <tr>
                            <th width="40%">Название</th>
                            <th>Ссылка</th>
                            <th>Статус</th>
                            <th>Порядок</th>
                            <th class="col-action">Действие</th>
                        </tr>
                    </thead>
                    <tbody>

                    @forelse($menus as $menu)

                        @php $published = ($menu->published)
                            ? '<a href="'. route('admin.menu.deactivate', $menu->id) .'"
                                title="Отключить пункт меню"
                                onclick="return confirmMessage(\'Вы подтверждаете отключение? Пункт меню будет недоступен пользователям!\')"><span class="label label-success">Вкл.</span></a>'
                            : '<a href="'. route('admin.menu.activate', $menu->id) .'"
                                title="Активировать пункт меню"
                                onclick="return confirmMessage(\'Вы подтверждаете включение? Пункт меню будет доступен пользователям!\')"><span class="label label-grey">Выкл.</span></a>'
                        @endphp

                        <tr>
                            <td>
                                <a href="{{ route('admin.menu.edit', $menu->id) }}" title="Редактировать">{{ $menu->title }}</a>
                            </td>
                            <td class="hidden-xs">{{ $menu->link }}</td>
                            <td class="hidden-xs text-center">{!! $published !!}</td>
                            <td class="hidden-xs text-center">
                                <div class="order-contenteditable js-order-contenteditable" data-id="{{ $menu->id }}" data-object="menus" contenteditable="" title="Кликните, чтобы редактировать">
                                    {{ $menu->ordering }}
                                </div>
                            </td>
                            <td class="col-action">
                                <div class="btn-group">
                                    <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="{{ route('admin.menu.delete', $menu->id) }}" class="btn btn-sm btn-danger hidden-xs" onclick="return confirmMessage()">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        
                        @if( ! empty($menu->children))
                            @foreach ($menu->children as $childMenu)
                                @include('admin.menu.includes.index_child', ['child_menu' => $childMenu])
                            @endforeach
                        @endif

                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Пункты меню не найдены</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>

            </div>

        </section>
    </div>
@endsection
