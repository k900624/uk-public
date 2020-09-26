@php

    /**
     * @author SillexLab (sillexlab@gmail.com)
     * @copyright 2019
     */

@endphp

<!doctype html>
<html prefix="og: http://ogp.me/ns#" lang="{{ app()->getLocale() }}" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ config('settings.site_title') }}</title>
    <meta name="author" content="Baluev Roman (sillexlab@gmail.com)">
    <meta name="robots" content="none">
    <noscript><meta http-equiv="refresh" content="0; URL={{ route('badBrowser') }}"></noscript>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicons/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicons/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/favicons/apple-touch-icon-precomposed.png') }}">

    @yield('before-styles')
    <link href="{{ asset(mix('css/admin/vendor.min.css')) }}" rel="stylesheet">
    <link href="{{ asset(mix('css/modules/login.min.css')) }}" rel="stylesheet">
    @yield('after-styles')

</head>
<body class="body-login">

    @yield('content')

</body>
</html>