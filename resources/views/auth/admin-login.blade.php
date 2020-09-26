@extends('layouts.admin.login')

@section('title', 'Вход в административную панель')

@section('after-styles')
    <link href="{{ asset(mix('css/modules/login.min.css')) }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-login">
        <section class="block @if($message) animated shake @endif">
            <div class="block-inner">
                <div class="block_header">
                    <h2>Вход в админ-панель</h2>
                </div>
                @if($message) <div class="alert alert-danger">{{ $message }}</div> @endif
                <form action="{{ route('admin.login.submit') }}" method="post" accept-charset="utf-8">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control" required="">
                        <label for="email">Email</label>
                        @if($errors->has('email'))
                            <span class="help-block text-danger">{{$errors->first('email')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control" required="" minlength="8">
                        <label for="password">Пароль</label>
                        @if($errors->has('password'))
                            <span class="help-block text-danger">{{$errors->first('password')}}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Войти</button>
                </form>
                <p class="to-site"><a href="{{ url('/') }}">Перейти на главную</a></p>
            </div>
        </section>
    </div>
@endsection