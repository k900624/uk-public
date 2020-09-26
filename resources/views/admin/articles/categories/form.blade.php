@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.categories.index' => $heading,
            'admin.categories.create' => $title,
        ]
     ])
    @endbreadcrumbs
@endsection

@section('after-scripts')
    <script src="{{ asset('vendor/bootstrap-imageupload/js/bootstrap-imageupload.js') }}"></script>
    <link href="{{ asset('vendor/bootstrap-imageupload/css/bootstrap-imageupload.min.css') }}" rel="stylesheet">
    <script>
        $(document).ready(function() {
            $('.imageupload').imageupload({
                allowedFormats: ['jpg', 'jpeg', 'png', 'gif', 'bmp'],
                maxWidth: '100%',
                maxHeight: '300px',
                maxFileSizeKb: 5120
            });
        });
    </script>
@endsection

@section('content')
    <form action="{{ $action }}" class="validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        @if($category->id)
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
                            <label for="title">Название категории <span class="required">*</span></label>
                            <input type="text" name="title" value="{{ old('title', $category->title) }}" id="title" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label for="alias">Постоянная ссылка (ЧПУ URL)</label>
                            <input type="text" name="alias" value="{{ old('alias', $category->alias) }}" id="alias" data-table="categories" data-id="{{ $category->id }}" class="form-control js-check-unique-alias">
                            <span class="help-block">Ссылка в адресной строке браузера, если не указать, генерируется автоматически</span>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание категории</label>
                            <textarea name="description" rows="5" id="description" class="form-control">{{ old('description', $category->description) }}</textarea>
                        </div>
                    </fieldset>
                    <div class="form-actions">
                        <input type="submit" name="submit" value="Сохранить" class="btn btn-success">
                        <a class="btn btn-default" href="{{ route('admin.categories.index') }}">Отмена</a>
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
                                    @isset($category->published)
                                        <input type="checkbox" name="published" value="1"@php checked($category->published == '1') @endphp>
                                    @else
                                        <input type="checkbox" name="published" value="1" checked="">
                                    @endisset
                                    Опубликовано
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="parent_id">Родительская категория</label>
                            <select id="parent_id" name="parent_id" class="form-control">
                                <option value="0">-- Выбрать категорию --</option>
                                @foreach($parents as $item)
                                    {{-- Запрещаем выбор текущей категории и ее дочерних --}}
                                    @if($category->id && $category->id == $item->id) @continue @endif

                                    <option value="{{ $item->id }}"
                                            @if($category->parent_id && $category->parent_id == $item->id) selected="" @endif
                                    >{{ $item->title }}</option>

                                    @if(count($item->children))
                                        @foreach ($item->children as $childCategory)
                                            {{-- Запрещаем выбор текущей категории и ее дочерних --}}
                                            @if($category->id && $category->id == $childCategory->id) @continue @endif
                                            @include('admin.articles.categories.includes.form_child', ['child_category' => $childCategory, 'level' => 1])
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Изображение</label>
                            <div class="imageupload">
                                <div class="file-tab">

                                    @if( ! empty($category->image))
                                        <img src="{{ url('storage/'. $category->image) }}" alt="" class="thumbnail">
                                        <label class="btn btn-primary btn-file btn-xs">
                                            <span>Сменить</span>
                                            <input type="file" name="imageForm">
                                        </label>
                                        <button type="button"
                                                class="btn btn-danger btn-xs"
                                                style="display: inline-block;">Удалить</button>
                                        <input type="hidden" name="imageLoaded" value="true">
                                    @else
                                        <label class="btn btn-primary btn-file btn-xs">
                                            <span>Выбрать</span>
                                            <input type="file" name="imageForm">
                                        </label>
                                        <input type="hidden" name="imageLoaded" value="false">
                                        <button type="button" class="btn btn-danger btn-xs">Удалить</button>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="metakey">Мета-теги</label>
                            <textarea name="metakey" rows="3" id="metakey" class="form-control">{{ old('metakey', $category->metakey) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="metadesc">Мета-описание</label>
                            <textarea name="metadesc" rows="3" id="metadesc" class="form-control">{{ old('metadesc', $category->metadesc) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="ordering">Порядок</label>
                            <input type="text" name="ordering" value="{{ old('ordering', $category->ordering) }}" id="ordering" class="form-control">
                        </div>

                    </fieldset>
                 </div>
            </section>
        </div>
    </form>

@endsection
