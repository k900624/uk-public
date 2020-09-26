@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.services.index'  => $heading,
            'admin.services.create' => $title,
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
    <form action="{{ $action }}" class="validate" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        @if ($service->id)
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
                            <input type="text" name="title" value="{{ old('title', $service->title) }}" id="title" class="form-control" required="">
                        </div>

                        <div class="form-group">
                            <label for="description">Описание <span class="required">*</span></label>
                            <textarea name="description" rows="16" id="description" class="form-control wysiwyg" required="">{{ old('fulltext', html_decode($service->description)) }}</textarea>
                        </div>

                    </fieldset>

                    <div class="form-actions">
                        <input type="submit" name="submit" value="Сохранить" class="btn btn-success">
                        <a class="btn btn-default" href="{{ route('admin.services.index') }}">Отмена</a>
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
                                @isset($service->published)
                                    <input type="checkbox" name="published" value="1"@php checked($service->published == '1') @endphp>
                                @else
                                    <input type="checkbox" name="published" value="1" checked="">
                                @endisset
                                Опубликовано
                            </label>
                        </div>

                        <div class="form-group">
                            <label>Дата создания</label>
                            <div class="datetimepicker input-group date">
                                <input data-date-format="YYYY-MM-DD HH:mm:ss"
                                       value="{{ old('created_at', $service->created_at ) }}"
                                       type="text" class="form-control" name="created_at">
                                <span class="input-group-addon" style="cursor: pointer;"><span class="fa-calendar fa"></span></span>
                            </div>
                        </div>
                        @isset($service->updated_at)
                            <div class="form-group">
                                <label>Дата изменения</label>
                                <div class="datetimepicker input-group date">
                                    <input data-date-format="YYYY-MM-DD HH:mm:ss" value="{{ old('updated_at', $service->updated_at) }}" type="text" class="form-control" name="updated_at">
                                    <span class="input-group-addon" style="cursor: pointer;"><span class="fa-calendar fa"></span></span>
                                </div>
                            </div>
                        @endisset

                        <br>
                        <h5>Параметры услуги</h5>
                        <hr>

                        <div class="form-group">
                            <label for="group_id">Группа <span class="required">*</span></label>
                            <select id="group_id" name="group_id" tabindex="-1" class="form-control" required="">
                                <option value="">-- Выбрать группу --</option>
                                @foreach($servicesGroups as $group)

                                    @isset($service->group_id)
                                        <option value="{{ $group->id }}"@php selected($group->id == $service->group_id) @endphp>{{ $group->title }}</option>
                                    @elseif($selectGroup)
                                        <option value="{{ $group->id }}"@php selected($group->id == $selectGroup) @endphp>{{ $group->title }}</option>
                                    @else
                                        <option value="{{ $group->id }}">{{ $group->title }}</option>
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
