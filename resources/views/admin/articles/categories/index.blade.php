@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.categories.index' => $heading,
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
                <div class="action">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-default btn-xs"><span class="hidden-xs">Добавить</span> <i class="fa fa-plus"></i></a>
                </div>
            </header>
            <div class="block_body">

                <table class="table table-striped table-condensed">
                    <thead class="hidden-xs">
                        <tr>
                            <th>Название</th>
                            <th class="hidden-sm">Кол-во статей</th>
                            <th>Порядок</th>
                            <th>Статус</th>
                            <th class="col-action">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($categories as $category)

                        @php $published = ($category->published)
                            ? '<a href="'. route('admin.categories.deactivate', $category->id) .'"
                                title="Отключить категорию"
                                onclick="return confirmMessage(\'Вы подтверждаете отключение? Категория и все дочерние категории будут недоступны пользователям!\')">
                                    <span class="label label-success">Вкл.</span>
                                </a>'
                            : '<a href="'. route('admin.categories.activate', $category->id) .'"
                                title="Активировать категорию"
                                onclick="return confirmMessage(\'Вы подтверждаете включение? Категория будет доступна пользователям!\')">
                                    <span class="label label-grey">Выкл.</span>
                                </a>'
                        @endphp

                        <tr>
                            <td>
                                <a href="{{ route('admin.categories.edit', $category->id) }}" title="Редактировать">
                                    <strong>{{ $category->title }}</strong>
                                </a>
                            </td>
                            <td class="hidden-sm hidden-xs" title="Сумма кол-ва статей дочерних категорий">
                                @if($category->atriclesCount > 0)
                                    <span class="badge badge-default">{{ $category->atriclesCount }}</span>
                                @else
                                    <span class="badge badge-outline-default">0</span>
                                @endif
                            </td>
                            <td class="hidden-xs text-center">
                                <div class="order-contenteditable js-order-contenteditable"
                                     data-id="{{ $category->id }}"
                                     data-object="categories"
                                     contenteditable=""
                                     title="Кликните, чтобы редактировать">
                                    {{ $category->ordering }}
                                </div>
                            </td>
                            <td class="hidden-xs text-center">{!! $published !!}</td>
                            <td class="col-action">
                                <div class="btn-group">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                       class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                                    @php $class = ($category->atriclesCount > 0 || count($category->children)) ? ' disabled' : '' @endphp
                                    <a href="{{ route('admin.categories.delete', $category->id) }}"
                                       class="btn btn-sm btn-danger hidden-xs{{$class}}"
                                       onclick="return confirmMessage()"><i class="fa fa-trash-o"></i></a>
                                </div>
                            </td>
                        </tr>

                        @if(count($category->children))
                            @foreach ($category->children as $childCategory)
                                @php $childCategory->atriclesCount = $categoryRepo->getCategoryArticlesCount($childCategory->id, $childCategory->parent_id) @endphp
                                @include('admin.articles.categories.includes.index_child', ['child_category' => $childCategory, 'level' => 1])
                            @endforeach
                        @endif
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Категории не найдены</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

            </div>
        </section>
    </div>
@endsection
