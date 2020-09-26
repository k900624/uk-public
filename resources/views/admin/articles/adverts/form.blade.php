@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.adverts.index'  => $heading,
            'admin.adverts.create' => $title,
        ]
     ])
    @endbreadcrumbs
@endsection

@section('after-scripts')
    <script src="{{ url('vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ url('vendor/moment.js') }}"></script>
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
                        <input type="hidden" name="cat_id" value="2">
                        <input type="submit" name="submit" value="Сохранить" class="btn btn-success">
                        <a class="btn btn-default" href="{{ route('admin.adverts.index') }}">Отмена</a>
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

                    </fieldset>

                </div>
            </section>
        </div>
    </form>
@endsection
