@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.users.index'  => $heading,
            'admin.users.create' => $title,
        ]
    ])
    @endbreadcrumbs
@endsection

@section('after-scripts')
    <script src="{{ url('vendor/select2/dist/js/select2.min.js') }}"></script>
    <link href="{{ url('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ url('vendor/select2-bootstrap/dist/select2-bootstrap.min.css') }}" rel="stylesheet">
    <script>
        $(document).ready(function() {
            $('#phone').inputmask('mask', {'mask': '+7 (999) 99-99-999'});
            $('#phone2').inputmask('mask', {'mask': '+7 (999) 99-99-999'});
            $('#address').select2({addresses: [], theme: 'bootstrap'});
        });
    </script>
@endsection

@section('content')
    <form action="{{ $action }}" class="validate" method="post" accept-charset="utf-8">
        @if ($user->id)
            {{ method_field('PATCH')}}
        @endif
        {{ csrf_field() }}
        <div class="col-md-10 col-md-offset-1">
            <section class="block">
                <header class="block_header">
                    <h2><i class="fa fa-edit"></i> Профиль <small>(поля обязательны для заполнения)</small></h2>
                </header>
                <div class="block_body form-horizontal">
                    
                    <fieldset>
                        
                        <div class="col-sm-12">
                            <legend class="section">Персональная информация</legend>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name">ФИО</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" id="name" class="form-control" required="" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <legend class="section">Контактная информация</legend>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="email">E-mail</label>
                            <div class="col-sm-3">
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" id="email" class="form-control" required="" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="phone">Телефон</label>
                            <div class="col-sm-3">
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" id="phone" class="form-control" required="" autocomplete="off">
                            </div>
                        </div>
                    
                    @if ($user->id)
                        <div class="col-sm-12">
                            <legend class="section">Сменить пароль</legend>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="password">Новый пароль</label>
                            <div class="col-sm-3">
                                <input type="password" name="password" value="{{ old('password') }}" id="password" class="form-control" autocomplete="off" minlength="8">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="password_confirmation">Подтвердите пароль</label>
                            <div class="col-sm-3">
                                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" id="password_confirmation" class="form-control" autocomplete="off" minlength="8">
                            </div>
                        </div>
                    @endif

                    </fieldset>

                    <div class="form-actions">
                        <input type="hidden" name="role_id" value="1">
                        <input type="submit" name="submit" value="Сохранить" class="btn btn-success">
                        <a class="btn btn-default" href="{{ route('admin.users.index') }}">Отмена</a>
                    </div>

                </div>
            </section>
        </div>
    </form>
@endsection
