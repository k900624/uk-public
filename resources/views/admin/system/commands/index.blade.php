@extends('layouts.admin.app')

@section('heading', $heading)
@section('title', $title)

@section('breadcrumbs')
    @breadcrumbs([
        'breadcrumbs' => [
            'admin.dashboard.index' => 'Главная',
            'admin.commands.index' => $heading,
        ]
    ])
    @endbreadcrumbs
@endsection

@section('after-styles')
    <style>
        .command-list {
            display: flex;
            flex-wrap: wrap;
        }
        .command-list .command {
            padding: 10px;
            border: 1px solid #f1f1f1;
            border-radius: 4px;
            border-bottom: 2px solid #f5f5f5;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            padding-top: 30px;
            padding-right: 52px;
            flex: 1;
            min-width: 275px;
            margin: 10px;
            margin-left: 0;
            font-family: Open Sans,sans-serif;
            color: #76838f;
            font-size: 14px;
        }
        .command-list .command.more_args {
            padding-bottom: 40px;
        }
        .command-list code {
            color: #549DEA;
            padding: 4px 7px;
            font-weight: normal;

            background: #f3f7ff;
            border: 0;
            position: absolute;
            top: 0;
            left: 0;
            border-bottom-left-radius: 0;
            border-top-right-radius: 0;
        }
        .command-list .command i {
            position: absolute;
            right: 5px;
            top: 5px;
            font-size: 30px;
            background-color: #76838f;
            color: #fff;
            padding: 2px 5px;
            border-radius: 3px;
        }
        .command-list .command .cmd_form {
            display: none;
            position: absolute;
            bottom: 0px;
            left: 0px;
            width: 100%;
        }
        .cmd_form input[type="text"], .cmd_form input[type="submit"] {
            width: 30%;
            float: left;
            margin: 0px;
            font-size: 12px;
        }
        .cmd_form input[type="text"] {
            line-height: 30px;
            padding-top: 0px;
            padding-bottom: 0px;
            height: 30px;
            border-top-right-radius: 0px;
            border-bottom-right-radius: 0px;
            border-top-left-radius: 0px;
            padding-left: 5px;
            font-size: 12px;
            width: 70%;
        }
        .cmd_form input[type="submit"] {
            border-top-right-radius: 0px;
            border-bottom-left-radius: 0px;
            border-top-left-radius: 0px;
            font-size: 10px;
            padding-left: 7px;
            padding-right: 7px;
            height: 30px;
        }
    </style>
@endsection

@section('after-scripts')
    <script>
        $(document).ready(function(){
            $('.command').click(function(){
                $(this).find('.cmd_form').slideDown();
                $(this).addClass('more_args');
                $(this).find('input[type="text"]').focus();
            });

            // $('.close-output').click(function(){
            //     $('.js-command-list pre').slideUp();
            // });
        });
    </script>
@endsection

@section('content')

    @include('admin.system.settings.includes.sidebar')

    <div class="col-md-9">
        <section class="block">

            <header class="block_header">
                <h2>
                    {{ $title }}
                </h2>
            </header>

            <div class="block_body">

                @if($artisan_output)
                    <p class="alert alert-success">
                        <span class="art_out">Выполнена команда Artisan:</span> {{ trim(trim($artisan_output, '"')) }}
                    </p>
                @endif

                <div class="js-command-list command-list">
                @foreach($commands as $command)
                    <div class="command" data-command="{{ $command->name }}">
                        <code>php artisan {{ $command->name }}</code>
                        <small>{{ $command->description }}</small><i class="fa fa-terminal"></i>
                        <form action="{{ route('admin.commands.index') }}" class="cmd_form" method="post">
                            <div class="flex">
                                {{ csrf_field() }}
                                <input type="text" name="args" autofocus class="form-control" placeholder="Дополнительные аргументы?">
                                <input type="submit" class="btn btn-primary pull-right delete-confirm"
                                       value="Запустить команду">
                                <input type="hidden" name="command" id="hidden_cmd" value="{{ $command->name }}">
                            </div>
                        </form>
                    </div>
                @endforeach
                </div>

            </div>

        </section>
    </div>
@endsection
