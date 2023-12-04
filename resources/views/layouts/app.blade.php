<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon"  type="image/png" href="{{asset('/img/logos/favicon.png')}}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen dark:bg-gray-900">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            {{-- Seccion de footer --}}
            {{-- <x-front.front-footer/> --}}
        </div>

        <script type="text/javascript" src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/sweetalert2/sweetalert2@11.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
        <script src="{{ asset('vendor/toastr/toastr.js') }}"></script>
        <script src="{{ asset('js/show_alerts.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        <script src="{{ asset('js/graphics.js') }}"></script>
        <script src="{{ asset('js/wordcloud2.js') }}"></script>
        {{-- <script src="{{ asset('vendor/d3/d3.min.js') }}"></script> --}}
        <script src="{{ asset('vendor/highcharts/highcharts.js') }}"></script>
        <script src="{{ asset('vendor/highcharts/exporting.js') }}"></script>
        <script src="{{ asset('vendor/highcharts/export-data.js') }}"></script>
        <script src="{{ asset('vendor/wordcloud2/wordcloud2.js') }}"></script>
        <script src="{{ asset('vendor/highcharts/accessibility.js') }}"></script>
        @stack('modals')
        @livewireScripts
    </body>
</html>
