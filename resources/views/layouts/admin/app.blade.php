@php

    /**
     * @author SillexLab (sillexlab@gmail.com)
     * @copyright 2020
     */

@endphp

<!doctype html>
<html prefix="og: http://ogp.me/ns#" lang="{{ app()->getLocale() }}" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Панель администрирования</title>
    <meta name="author" content="Baluev Roman (sillexlab@gmail.com)">
    <meta name="robots" content="none">
    <noscript><meta http-equiv="refresh" content="0; URL={{ route('badBrowser') }}"></noscript>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicons/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicons/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/favicons/apple-touch-icon-precomposed.png') }}">

    @yield('before-styles')
    <link href="{{ asset(mix('css/admin/vendor.min.css')) }}" rel="stylesheet">
    <link href="{{ asset(mix('css/admin/app.min.css')) }}" rel="stylesheet">
    @yield('after-styles')

    <script>
        const $siteUrl      = '{{ url("/") }}',
            $adminUrl       = '{{ url("admin") }}',
            $csrfToken      = '{{ csrf_token() }}',
            $quickFeedState = false,
            $lang = {
                loading       : 'Идет загрузка...',
                confirmDelete : 'Вы подтверждаете удаление?'
            };
        var $uri = '{!! Request::server("REQUEST_URI") !!}';
    </script>
</head>
<body class="js-body-admin">

    <div class="l-wrapper">

        @include('layouts.admin.includes.header')

        @include('layouts.admin.includes.sidebar')
        
        <main class="l-container @isset($_COOKIE['hideSidebarState'])) {{ $_COOKIE['hideSidebarState'] == 1 ? ' is_hidden' : '' }}@endisset">

            <div class="l-content">
                <article class="content">
                    @hasSection('heading')
                    <header class="content_header">
                        <h1 class="content_title">@yield('heading')</h1>
                        @yield('breadcrumbs')
                    </header>
                    @endif
                    <div class="row">
                        @include('layouts.admin.includes.messages')
                        
                        @yield('content')
                    </div>
                </article>
            </div>

        </main>

    </div>

    @yield('before-scripts')
    <script src="{{ asset('js/admin/vendor.min.js') }}"></script>
    <script src="{{ asset('js/admin/app.min.js') }}"></script>
    @yield('after-scripts')

</body>
</html>
