@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.pages.index' => $heading,
            'admin.pages.create' => $title,
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
    <script>
        $(document).ready(function() {
            $('.datetimepicker').datetimepicker({pickDate: true, pickTime: true});
        });
    </script>

    @include('admin/partials/tinymce')

@endsection

@section('content')

    <form action="{{ $action }}" class="validate" method="post" accept-charset="utf-8">
        @if($page->id)
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
                            <input type="text" name="title" value="{{ old('title', $page->title) }}" id="title" class="form-control" required="">
                        </div>

                        <div class="form-group">
                            <label for="alias">Постоянная ссылка (ЧПУ URL)</label>
                            <div class="input-group">
                                <input type="text" name="alias" value="{{ old('alias', $page->alias) }}" id="alias" data-table="content" data-id="{{ $page->id }}" class="form-control js-check-unique-alias">
                                <span class="input-group-btn">
                                    @isset($page->id))
                                        <button class="btn btn-inverse" type="button" onclick="transliteTitle('#title', '#alias', {{ $page->id }});" id="auto-alias">Генерировать</button>
                                    @else
                                        <button class="btn btn-inverse" type="button" onclick="transliteTitle('#title', '#alias', {{ $autoIncrement }});" id="auto-alias">Генерировать</button>
                                    @endisset
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="fulltext">Текст<span class="required">*</span></label>
                            <textarea name="fulltext" rows="16" id="fulltext" class="form-control wysiwyg" required="">{{ old('fulltext', html_decode($page->fulltext)) }}</textarea>
                        </div>
                    </fieldset>
                    <div class="form-actions">
                        <input type="submit" name="submit" value="Сохранить" class="btn btn-success">
                        <a class="btn btn-default" href="{{ route('admin.pages.index') }}">Отмена</a>
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
                                @isset($page->published)
                                    <input type="checkbox" name="published" value="1"@php checked($page->published == '1') @endphp>
                                @else
                                    <input type="checkbox" name="published" value="1" checked="">
                                @endisset
                                Опубликовано
                            </label>
                        </div>

                        <div class="form-group">
                            <label>Дата создания</label>
                            <div class="datetimepicker input-group date">
                                <input data-date-format="YYYY-MM-DD HH:mm:ss" value="{{ old('created_at', $page->created_at ) }}" type="text" class="form-control" name="created_at">
                                <span class="input-group-addon" style="cursor: pointer;"><span class="fa-calendar fa"></span></span>
                            </div>
                        </div>
                        @isset($page->updated_at)
                            <div class="form-group">
                                <label>Дата изменения</label>
                                <div class="datetimepicker input-group date">
                                    <input data-date-format="YYYY-MM-DD HH:mm:ss" value="{{ old('updated_at', $page->updated_at) }}" type="text" class="form-control" name="updated_at">
                                    <span class="input-group-addon" style="cursor: pointer;"><span class="fa-calendar fa"></span></span>
                                </div>
                            </div>
                        @endisset

                        <br>
                        <h5>Мета</h5>
                        <hr>

                        <div class="form-group">
                            <label for="metakey">Мета-теги</label>
                            <textarea name="metakey" rows="3" id="metakey" class="form-control">{{ old('metakey', $page->metakey) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="metadesc">Мета-описание</label>
                            <textarea name="metadesc" rows="3" id="metadesc" class="form-control">{{ old('metadesc', $page->metadesc) }}</textarea>
                        </div>

                    </fieldset>

                </div>
            </section>
        </div>
    </form>
@endsection