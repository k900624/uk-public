@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.users.roles.index'  => $heading,
            'admin.users.roles.create' => $title,
        ]
    ])
    @endbreadcrumbs
@endsection

@section('after-styles')
    <style>
        .permissions ul {
            margin-left: 40px;
        }
    </style>
@endsection

@section('after-scripts')
    <script>
       $(document).ready(function() {
            
            $('.permission-group').on('change', function(){
                $(this).parents('.checkbox').siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
            });

            $('.permission-select-all').on('click', function(){
                $('ul.permissions').find("input[type='checkbox']").prop('checked', true);
                return false;
            });

            $('.permission-deselect-all').on('click', function(){
                $('ul.permissions').find("input[type='checkbox']").prop('checked', false);
                return false;
            });

            function parentChecked(){
                $('.permission-group').each(function(){
                    var allChecked = true;
                    $(this).parents('.checkbox').siblings('ul').find("input[type='checkbox']").each(function(){
                        if( ! this.checked) allChecked = false;
                    });
                    $(this).prop('checked', allChecked);
                });
            }

            parentChecked();

            $('.the-permission').on('change', function(){
                parentChecked();
            });
        });
    </script>
@endsection

@section('content')
    <form action="{{ $action }}" class="validate" method="post" accept-charset="utf-8">
        @if($role->id)
            {{ method_field('PATCH')}}
        @endif
        {{ csrf_field() }}
        <div class="col-md-12">
            <section class="block">
                <header class="block_header">
                    <h2><i class="fa fa-edit"></i> Основные данные <small>( * обязательно для заполнения)</small></h2>
                </header>
                <div class="block_body">

                    <fieldset>
                        <div class="form-group">
                            <label for="name">Название <span class="required">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $role->name) }}" id="name" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label for="display_name">Описание <span class="required">*</span></label>
                            <input type="text" name="display_name" value="{{ old('display_name', $role->display_name) }}" id="display_name" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label for="description">Права доступа</label>
                            <div class="mt-10">
                                <a href="#" class="permission-select-all">Выбрать все</a> / <a href="#" class="permission-deselect-all">Отменить выделение</a>
                            </div>
                            <ul class="permissions row">
                                @foreach($permissions as $table => $permission)
                                    <li class="col-md-3">
                                        <div class="checkbox">
                                            <label for="{{ $table }}">
                                                <input type="checkbox" id="{{ $table }}" class="permission-group">
                                                {{ title_case(str_replace('_', ' ', $table)) }}
                                            </label>
                                        </div>
                                        
                                        <ul>
                                            @foreach($permission as $perm)
                                                <li class="checkbox">
                                                    <label for="permission-{{ $perm->id }}">
                                                        <input type="checkbox"
                                                               id="permission-{{ $perm->id }}"
                                                               name="permissions[{{ $perm->id }}]"
                                                               class="the-permission"
                                                               value="{{ $perm->id }}" @if(in_array($perm->key, $role_permissions)) checked="" @endif>
                                                        {{ title_case(str_replace('_', ' ', $perm->key)) }}
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </fieldset>

                    <div class="form-actions">
                        <input type="submit" name="submit" value="Сохранить" class="btn btn-success">
                        <a class="btn btn-default" href="{{ route('admin.users.roles.index') }}">Отмена</a>
                    </div>

                </div>
            </section>

        </div>
    </form>
@endsection
