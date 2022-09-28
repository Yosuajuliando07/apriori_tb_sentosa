<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">

    @if (Request::is('pola-penjualan-produk-hasil-perhitungan'))
        <title> {{ $title }} - {{ config('app.name') }}</title>
    @else
        <title>@yield('title') - {{ config('app.name') }}</title>
    @endif

    {{-- <title> {{ $title }} - {{ config('app.name') }}</title> --}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/vendors/images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/vendors/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/vendors/images/favicon-16x16.png') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/styles/style.css') }}">
    @stack('css')

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    {{-- <script>
        window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
    </script> --}}
    {{-- https://laravel-livewire.com/docs/2.x/installation#configuring-the-asset-base-url --}}
    @livewireStyles
</head>

<body>
    {{-- @if (Request::is('apriori-hasil'))
        <div class="pre-loader">
            <div class="pre-loader-box">
                <div class="loader-logo"><img src="{{ asset('assets/vendors/images/deskapp-logo.svg') }}"
                        alt="">
                </div>
                <div class='loader-progress' id="progress_div">
                    <div class='bar' id='bar1'></div>
                </div>
                <div class='percent' id='percent1'>0%</div>
                <div class="loading-text">
                    Loading...
                </div>
            </div>
        </div>
    @endif --}}


    {{-- Header --}}
    @include('layouts.komponen.header')

    {{-- Sidebar --}}
    @include('layouts.komponen.sidebar')

    {{-- Content --}}
    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        @yield('content')
    </div>
    <!-- js -->
    {{-- Include SweetAlert 2 View
    sumber : https://realrashid.github.io/sweet-alert/config --}}
    @include('sweetalert::alert')

    <script src="{{ asset('assets/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('assets/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('assets/vendors/scripts/layout-settings.js') }}"></script>
    @stack('js')
    {{-- @yield('livewire-js') --}}
    @livewireScripts
</body>

</html>
