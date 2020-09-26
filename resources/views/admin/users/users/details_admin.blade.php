@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.users.index'     => 'Пользователи',
            'admin.users.show'      => $title,
        ]
    ])
    @endbreadcrumbs
@endsection

@section('after-scripts')

@endsection

@section('content')
<div class="col-md-10 col-md-offset-1">
    <section class="block">
        <header class="block_header">
            <h2><i class="fa fa-edit"></i> Основные данные</h2>
        </header>
        <div class="block_body">
            
            <table class="table table-striped">
                <tr>
                    <th>ФИО</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Роль</th>
                    <td>{{ $user->role_display_name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><a href="javascript:;" class="js-modal" data-remote="{{ route('admin.feedback.ajax_send_email') }}" data-email="{{ $user->email }}">{{ $user->email }}</a></td>
                </tr>
            </table>

            <div class="form-actions">
                <a class="btn btn-primary" href="{{ route('admin.users.edit', $user->user_id) }}">Редактировать</a>
                <a class="btn btn-default" href="{{ url()->previous() }}">Назад</a>
            </div>
        </div>
    </section>
</div>
@endsection
