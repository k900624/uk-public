@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.menu.index' => $heading,
            'admin.menu.create' => $title,
        ]
     ])
    @endbreadcrumbs
@endsection

@section('after-scripts')
    <script>
        $(document).ready(function() {
            $wrapper = $('.js-fields-init');

            function pageLink($wrapper) {
                var $val = $wrapper.find('.js-field-value-page-link select').val();
                $wrapper.find('.js-field-value-page-link input').val($val);

                return $wrapper;
            }

            pageLink($wrapper);

            $wrapper.find('.js-field-value-page-link select').change(function() {
                pageLink($wrapper);
            });

            $wrapper.find('.js-field-select').change(function() {
                $wrapper.find('.js-field-value input').attr('disabled', 'disabled');
                $wrapper.find('.js-field-value select').attr('disabled', 'disabled');
                $wrapper.find('.js-field-value').removeClass('hide').addClass('hide');

                switch($(this).val()) {
                    case 'external_link':
                        $wrapper.find('.js-field-value-external-link input').removeAttr('disabled');
                        $wrapper.find('.js-field-value-external-link').removeClass('hide');
                        break;

                    case 'internal_link':
                        $wrapper.find('.js-field-value-internal-link input').removeAttr('disabled');
                        $wrapper.find('.js-field-value-internal-link').removeClass('hide');
                        break;

                    default: // page_link
                        $wrapper.find('.js-field-value-page-link select').removeAttr('disabled');
                        $wrapper.find('.js-field-value-page-link input').removeAttr('disabled');
                        $wrapper.find('.js-field-value-page-link').removeClass('hide');
                        pageLink($wrapper);
                }
            });
        });
    </script>
@endsection

@section('content')
    <form action="{{ $action }}" class="validate" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        @if($menu->id)
            {{ method_field('PATCH')}}
        @endif
        {{ csrf_field() }}
        <div class="col-md-8">
            <section class="block">
                <header class="block_header">
                    <h2><i class="fa fa-edit"></i> Основные данные <small>( * обязательно для заполнения)</small></h2>
                </header>
                <div class="block_body">

                    <fieldset>

                        <div class="form-group">
                            <label for="title" class="control-label">Заголовок <span class="required">*</span></label>
                            <input type="text" name="title" value="{{ old('title', $menu->title) }}" id="title" class="form-control" required="">
                        </div>

                        <div class="form-group">
                            <label>Ссылка</label>

                            <div class="row js-fields-init">
                                <div class="col-sm-3">
                                    <select name="type" class="form-control js-field-select">
                                        <option value="page_link"{{ ($menu->type == 'page_link') ? ' selected=""' : '' }}>Страница</option>
                                        <option value="internal_link"{{ ($menu->type == 'internal_link') ? ' selected=""' : '' }}>Внутренняя</option>
                                        <option value="external_link"{{ ($menu->type == 'external_link') ? ' selected=""' : '' }}>Внешняя</option>
                                    </select>
                                </div>
                                <div class="col-sm-9">

                                    <!-- external link input -->
                                    <div class="js-field-value js-field-value-external-link{{ ($menu->type != 'external_link') ? ' hide' : '' }}">
                                        <input type="url" name="link" value="{{ old('link', $menu->link) }}" class="form-control" placeholder="Внешняя ссылка (напр: http://example.com/your-desired-page)"@php disabled($menu->type != 'external_link') @endphp>
                                    </div>

                                    <!-- internal link input -->
                                    <div class="js-field-value js-field-value-internal-link{{ ($menu->type != 'internal_link') ? ' hide' : '' }}">
                                        <input type="text"
                                               name="link"
                                               value="{{ old('link', $menu->link) }}"
                                               class="form-control"
                                               placeholder="Внутренняя ссылка (напр: /page/about)"
                                               @php disabled($menu->type != 'internal_link') @endphp>
                                    </div>

                                    <!-- page alias input -->
                                    <div class="js-field-value js-field-value-page-link{{ isset($menu->type) ? (($menu->type != 'page_link') ? ' hide' : '') : '' }}">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <select class="form-control" name="page"@php disabled($menu->type != 'page_link') @endphp>
                                                    @foreach($pages as $page)
                                                        <option value="/page/{{ $page->alias }}">{{ $page->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="link" value="{{ old('link', $menu->link) }}" class="form-control"@php disabled($menu->type != 'page_link') @endphp>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </fieldset>
                    
                    <div class="form-actions">
                        <input type="hidden" name="group_id" value="{{ $group_menu->id }}">
                        <input type="submit" name="submit" value="Сохранить" class="btn btn-success">
                        <a class="btn btn-default" href="{{ route('admin.menu.index') }}">Отмена</a>
                    </div>

                </div>
            </section>
        </div>

        <div class="col-md-4">
            <section class="block">

                <header class="block_header">
                    <h2><i class="fa fa-cog"></i> Дополнительно</h2>
                </header>

                <div class="block_body">

                    <fieldset>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="hidden" name="published" value="0">
                                    @isset($menu->published)
                                        <input type="checkbox" name="published" value="1"@php checked($menu->published == '1') @endphp>
                                    @else
                                        <input type="checkbox" name="published" value="1" checked="">
                                    @endisset
                                    Опубликовать
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="parent_id">Родительский пункт меню</label>

                            <select class="form-control" name="parent_id" id="select_parent">
                                <option value="0">-- Не выбран --</option>
                                @foreach($parents as $item)

                                    {{-- Запрещаем выбор текущей категории и ее дочерних --}} 
                                    @if($menu->id && $menu->id == $item->id) @continue @endif

                                    <option value="{{ $item->id }}"
                                        @if($menu->parent_id && $menu->parent_id == $item->id) selected="" @endif
                                    >{{ $item->title }}</option>

                                    @if(count($item->children))
                                        @foreach ($item->children as $childMenu)
                                            {{-- Запрещаем выбор текущей категории и ее дочерних --}}
                                            @if($menu->id && $menu->id == $childMenu->id) @continue @endif
                                            @include('admin.menu.includes.form_child', ['child_menu' => $childMenu, 'level' => 1])
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="group_name">Группа меню</label>
                            <input type="text" name="group_name" value="{{ $group_menu->title }}" id="group_name" class="form-control" required="" disabled="">
                        </div>

                        <div class="form-group">
                            <label for="ordering">Порядок</label>
                            <input type="text" name="ordering" value="{{ old('ordering', $menu->ordering) }}" id="ordering" class="form-control">
                        </div>

                    </fieldset>
                </div>

            </section>
        </div>
    </form>
@endsection
