@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.settings.index' => $heading,
        ]
    ])
    @endbreadcrumbs
@endsection

@section('content')

@include('admin.system.settings.includes.sidebar')

    <form action="{{ route('admin.settings.update') }}" class="form-horizontal validate" method="post" accept-charset="utf-8">
        <div class="col-md-9">

            {{ csrf_field() }}

            <section class="block">
                <header class="block_header">
                    <h2>Основные данные</h2>
                </header>
                <div class="block_body">

                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-general" data-toggle="tab">Общие</a></li>
                        <li><a href="#tab-seo" data-toggle="tab">SEO</a></li>
                        <li><a href="#tab-contacts" data-toggle="tab">Контакты</a></li>
                        <li><a href="#tab-keys" data-toggle="tab">Ключи</a></li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane fade in active" id="tab-general">
                            @include('admin.system.settings.includes.form', ['settings' => $generals, 'type' => 'generals'])
                        </div>
                        <div class="tab-pane fade" id="tab-seo">
                            @include('admin.system.settings.includes.form', ['settings' => $seo, 'type' => 'seo'])
                        </div>
                        <div class="tab-pane fade" id="tab-contacts">
                            @include('admin.system.settings.includes.form', ['settings' => $contacts, 'type' => 'contacts'])
                        </div>
                        <div class="tab-pane fade" id="tab-keys">
                            @include('admin.system.settings.includes.form', ['settings' => $keys, 'type' => 'keys'])
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="submit" name="submit" value="Сохранить" class="btn btn-success">
                    </div>

                </div>

            </section>

        </div>
    </form>

@endsection