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
                            <label class="col-sm-3 control-label" for="name">ФИО собственника</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" id="name" class="form-control" required="" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label pt-0" style="margin-top: -7px" for="main">Ответственное лицо <br><small>(с правом голоса)</small></label>
                            <div class="col-sm-9">
                                <input type="hidden" name="main" value="off">
                                @isset($user->main)
                                    <input type="checkbox" name="main" onclick="return confirmMessage('Вы уверены, что хотите сменить ответственное лицо?')" value="on"@php checked($user->main == 'on') @endphp>
                                @else
                                    <input type="checkbox" name="main" value="on" checked="">
                                @endisset
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="address">Адрес</label>
                            <div class="col-sm-9">
                                @if ($user->id)
                                    @foreach ($addresses as $address)
                                        @if (isset($address['selected']) && $address['main'] == 'on')
                                            <p class="form-control-static">{{ $address['title'] }} (№ договора {{ $address['contract_number'] }}, собственник {{ $address['username'] }})</p>
                                        @endif
                                    @endforeach
                                @else
                                    <select id="address" name="area_id" class="form-control" placeholder="Выберите адрес">
                                        <option value="0">-- Выберите адрес участка --</option>
                                        @foreach ($addresses as $address)
                                            <option value="{{ $address['area_id'] }}" @if (isset($address['selected']) && $address['main'] == 'on') selected="" @endif>
                                                {{ $address['title'] }} (№ договора {{ $address['contract_number'] }}, собственник {{ $address['username'] }})
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
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
                            <label class="col-sm-3 control-label" for="phone2">Телефон <small>для экстренной связи</small></label>
                            <div class="col-sm-3">
                                <input type="text" name="phone2" value="{{ old('phone2', $user->phone2) }}" id="phone2" class="form-control" required="" autocomplete="off">
                            </div>
                        </div>
                    
                    @if ($user->id)
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="vkontakte">ВКонтакте</label>
                            <div class="col-sm-3">
                                <input type="text" name="vkontakte" value="{{ old('vkontakte', $user->vkontakte) }}" id="vkontakte" class="form-control" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="facebook">Facebook</label>
                            <div class="col-sm-3">
                                <input type="text" name="facebook" value="{{ old('facebook', $user->facebook) }}" id="facebook" class="form-control" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="twitter">Twitter</label>
                            <div class="col-sm-3">
                                <input type="text" name="twitter" value="{{ old('twitter', $user->twitter) }}" id="twitter" class="form-control" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="odnoklassniki">Одноклассники</label>
                            <div class="col-sm-3">
                                <input type="text" name="odnoklassniki" value="{{ old('odnoklassniki', $user->odnoklassniki) }}" id="odnoklassniki" class="form-control" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="telegram">Telegram</label>
                            <div class="col-sm-3">
                                <input type="text" name="telegram" value="{{ old('telegram', $user->telegram) }}" id="telegram" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    @endif

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
                        <input type="hidden" name="role_id" value="2">
                        <input type="submit" name="submit" value="Сохранить" class="btn btn-success">
                        <a class="btn btn-default" href="{{ route('admin.users.index') }}">Отмена</a>
                    </div>

                </div>
            </section>
        </div>
    </form>
@endsection
