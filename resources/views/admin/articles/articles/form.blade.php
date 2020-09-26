@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.articles.index'  => $heading,
            'admin.articles.create' => $title,
        ]
     ])
    @endbreadcrumbs
@endsection

@section('after-scripts')
    <script src="{{ url('vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ url('vendor/moment.js') }}"></script>
    <script src="{{ url('vendor/select2/dist/js/select2.min.js') }}"></script>
    <link href="{{ url('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ url('vendor/select2-bootstrap/dist/select2-bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ url('vendor/bootstrap-datetimepicker/locale/ru.js') }}"></script>
    <script src="{{ url('vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <link href="{{ url('vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
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
            $('#tags').select2({tags: [], theme: 'bootstrap'});
            $('.datetimepicker').datetimepicker({pickDate: true, pickTime: true});
        });
    </script>

    @include('admin/partials/tinymce')

@endsection

@section('content')
    <form action="{{ $action }}" class="validate" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        @if ($article->id)
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
                            <label for="title">Заголовок <span class="required">*</span></label>
                            <input type="text" name="title" value="{{ old('title', $article->title) }}" id="title" class="form-control" required="">
                        </div>

                        <div class="form-group">
                            <label for="alias">Постоянная ссылка (ЧПУ URL)</label>
                            <div class="input-group">
                                <input type="text" name="alias" value="{{ old('alias', $article->alias) }}" id="alias" data-table="content" data-id="{{ $article->id }}" class="form-control js-check-unique-alias">
                                <span class="input-group-btn">
                                    @isset($article->id))
                                        <button class="btn btn-inverse" type="button" onclick="transliteTitle('#title', '#alias', {{ $article->id }});" id="auto-alias">Генерировать</button>
                                    @else
                                        <button class="btn btn-inverse" type="button" onclick="transliteTitle('#title', '#alias', {{ $autoIncrement }});" id="auto-alias">Генерировать</button>
                                    @endisset
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Изображение</label>
                            <div class="imageupload">
                                <div class="file-tab">

                                    @if ( ! empty($article->image))
                                        <img src="{{ ImageThumb::get($article->image, 'articles', '350') }}" alt="" class="thumbnail">
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
                            <label for="introtext">Краткое описание</label>
                            <textarea name="introtext" rows="3" id="introtext" class="form-control">{{ old('introtext', html_decode($article->introtext)) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="fulltext">Текст <span class="required">*</span></label>
                            <textarea name="fulltext" rows="16" id="fulltext" class="form-control wysiwyg" required="">{{ old('fulltext', html_decode($article->fulltext)) }}</textarea>
                        </div>

                    </fieldset>

                    <div class="form-actions">
                        <input type="submit" name="submit" value="Сохранить" class="btn btn-success">
                        <a class="btn btn-default" href="{{ route('admin.articles.index') }}">Отмена</a>
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
                        <div class="checkbox">
                            <label>
                                <input type="hidden" name="published" value="0">
                                @isset($article->published)
                                    <input type="checkbox" name="published" value="1"@php checked($article->published == '1') @endphp>
                                @else
                                    <input type="checkbox" name="published" value="1" checked="">
                                @endisset
                                Опубликовано
                            </label>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="hidden" name="enable_comments" value="0">
                                @isset($article->enable_comments)
                                    <input type="checkbox" name="enable_comments" value="1"@php checked($article->enable_comments == 1) @endphp>
                                @else
                                    <input type="checkbox" name="enable_comments" value="1" checked="">
                                @endisset
                                Разрешить комментарии
                            </label>
                        </div>

                        <div class="form-group">
                            <label>Дата создания</label>
                            <div class="datetimepicker input-group date">
                                <input data-date-format="YYYY-MM-DD HH:mm:ss"
                                       value="{{ old('created_at', $article->created_at ) }}"
                                       type="text" class="form-control" name="created_at">
                                <span class="input-group-addon" style="cursor: pointer;"><span class="fa-calendar fa"></span></span>
                            </div>
                        </div>
                        @isset($article->updated_at)
                            <div class="form-group">
                                <label>Дата изменения</label>
                                <div class="datetimepicker input-group date">
                                    <input data-date-format="YYYY-MM-DD HH:mm:ss" value="{{ old('updated_at', $article->updated_at) }}" type="text" class="form-control" name="updated_at">
                                    <span class="input-group-addon" style="cursor: pointer;"><span class="fa-calendar fa"></span></span>
                                </div>
                            </div>
                        @endisset

                        <br>
                        <h5>Параметры новости</h5>
                        <hr>

                        <div class="form-group">
                            <label for="cat_id">Категория <span class="required">*</span></label>
                            <select id="cat_id" name="cat_id" tabindex="-1" class="form-control" required="">
                                <option value="">-- Выбрать категорию --</option>
                                @foreach($categories as $category)

                                    @isset($article->cat_id)
                                        <option value="{{ $category->id }}"@php selected($category->id == $article->cat_id) @endphp>{{ $category->title }}</option>
                                    @elseif($selectCatId)
                                        <option value="{{ $category->id }}"@php selected($category->id == $selectCatId) @endphp>{{ $category->title }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endisset

                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="tags">Теги новости</label>
                            <select id="tags" name="tags[]" multiple="" class="form-control" placeholder="Выберите теги">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag['title'] }}" @if(isset($tag['selected'])) selected="" @endif>
                                        {{ $tag['title'] }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="help-block">Напишите или выберите Тег из списка и нажмите "Enter", чтобы добавить его</span>
                        </div>

                    </fieldset>

                </div>
            </section>
        </div>
    </form>
@endsection
