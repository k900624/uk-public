@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.faq.index'  => $heading,
            'admin.faq.create' => $title,
        ]
    ])
    @endbreadcrumbs
@endsection

@section('after-scripts')
    <script src="{{ url('vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>

    @include('admin/partials/tinymce')
@endsection

@section('content')
    <form action="{{ $action }}" class="validate" method="post" accept-charset="utf-8">
        @if($faq->id)
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
                            <label for="question">Вопрос <span class="required">*</span></label>
                            <textarea name="question" rows="3" id="question" class="form-control">{{ old('question', html_decode($faq->question)) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="answer">Ответ <span class="required">*</span></label>
                            <textarea name="answer" rows="16" id="answer" class="form-control wysiwyg" required="">{{ old('answer', html_decode($faq->answer)) }}</textarea>
                        </div>

                    </fieldset>

                    <div class="form-actions">
                        <input type="submit" name="submit" value="Сохранить" class="btn btn-success">
                        <a class="btn btn-default" href="{{ route('admin.faq.index') }}">Отмена</a>
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
                                @isset($faq->published)
                                    <input type="checkbox" name="published" value="1"@php checked($faq->published == '1') @endphp>
                                @else
                                    <input type="checkbox" name="published" value="1" checked="">
                                @endisset
                                Опубликовано
                            </label>
                        </div>

                        <div class="form-group">
                            <label>Дата создания</label>
                            <p class="form-control">{{ $faq->created_at ? $faq->created_at : $created_at ?? '' }}</p>
                        </div>

                        <div class="form-group">
                            <label for="cat_id">Категория</label>
                            <select id="cat_id" name="cat_id" tabindex="-1" class="form-control" required="">
                                <option value="0">-- Выбрать категорию --</option>
                                @foreach($categories as $category)

                                    @isset($faq->cat_id)
                                        <option value="{{ $category->id }}"@php selected($category->id == $faq->cat_id) @endphp>
                                            {{ $category->title }}
                                        </option>
                                    @elseif($selectCatId)
                                        <option value="{{ $category->id }}"@php selected($category->id == $selectCatId) @endphp>
                                            {{ $category->title }}
                                        </option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endisset

                                @endforeach
                            </select>
                        </div>

                    </fieldset>

                </div>
            </section>
        </div>
    </form>
@endsection