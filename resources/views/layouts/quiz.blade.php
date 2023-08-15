<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('/img/logos/favicon.png') }}">
    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/tailwind.output.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('css')
    <!-- Styles -->
    @livewireStyles
</head>

<body class="bg-gray-100">

    {{$slot}}

    @stack('modals')
    @stack('js')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/init-alpine.js') }}"></script>
    <script src="{{ asset('js/focus-trap.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/graphics.js') }}"></script>
    <script src="{{ asset('vendor/toastr/toastr.js') }}"></script>
    <script src="{{ asset('js/show_alerts.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2@11.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <script src="{{ asset('vendor/highcharts/highcharts.js') }}"></script>
    <script src="{{ asset('vendor/highcharts/exporting.js') }}"></script>
    <script src="{{ asset('vendor/highcharts/export-data.js') }}"></script>
    <script src="{{ asset('vendor/highcharts/accessibility.js') }}"></script>
    @livewireScripts
</body>

</html>
