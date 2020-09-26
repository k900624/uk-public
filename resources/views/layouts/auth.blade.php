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
    <title>@yield('title') | {{ config('settings.site_title') }}</title>
    <meta name="description" content="@yield('meta_description', config('settings.meta_description'))">
    <meta name="keywords" content="@yield('meta_keywords', config('settings.meta_keywords'))">
    <meta name="author" content="Baluev Roman (sillexlab@gmail.com)">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta name="yandex-verification" content="{{ config('settings.yandex_verification') }}">
    <meta name="google-site-verification" content="{{ config('settings.google_site_verification') }}">
    <meta name="resource-type" content="document">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicons/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicons/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/favicons/apple-touch-icon-precomposed.png') }}">
    <meta name="url" content="{{ url('/') }}">
    @yield('meta')
    <noscript><meta http-equiv="refresh" content="0; URL={{ route('badBrowser') }}"></noscript>

    <!--[if lte IE 11]>
        <meta http-equiv="refresh" content="0; URL={{ route('badBrowser') }}">
    <![endif]-->

    @yield('og')

    @yield('before-styles')
    <link href="{{ asset(mix('css/vendor.min.css')) }}" rel="stylesheet">
    <link href="{{ asset(mix('css/app.min.css')) }}" rel="stylesheet">
    @yield('after-styles')

    <script>
        const $siteUrl     = '{{ url("/") }}',
            $csrfToken     = '{{ csrf_token() }}',
            $language      = '{{ app()->getLocale() }}',
            $googleMapsKey = '{{ config("settings.google_maps_key") }}',
            $lang = {
                loading         : '',
                confirmDelete   : 'Вы подтверждаете удаление?',
                captchaError    : '',
                captchaRequired : '',
                required        : ''
            };
        var $uri = '{!! Request::server("REQUEST_URI") !!}';
    </script>
</head>
<body id="page-top" class="body">

    <div class="l-wrapper">

        <div class="l-middle primary">
            @yield('content')
        </div>

    </div>

    @include('layouts.includes.messages')

</body>
</html>

