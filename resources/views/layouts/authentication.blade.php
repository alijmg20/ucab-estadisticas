<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon"  type="image/png" href="{{asset('/img/logos/favicon.png')}}">
        <title>{{ config('app.name', 'Iniciar Sesion') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{asset('vendor/toastr/toastr.min.css')}}">
        @livewireStyles
    </head>
    <body class="font-inter antialiased bg-slate-100 text-slate-600">

        <main class="bg-white">

            <div class="relative flex">

                <!-- Content -->
                <div class="w-full">

                    <style>
                        .background-image {
                            background-size: cover;
                            background-position: center center;
                        }
                        
                        .content-shadow {
                            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);
                            border-radius: 0.5rem;
                        }
                    </style>

                    <div style="background-image: url({{asset('/img/login/imagenfondo.png')}});" class="min-h-screen h-full flex flex-col after:flex-1 background-image">

                        <!-- Header -->
                        <div class="flex-1">
                            <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                                <!-- Logo -->
                                <a class="block" href="/">
                                    <figure>
                                        {{-- <img src="{{asset('images/icons/icon-72x72.png')}}" alt=""> --}}
                                    </figure>
                                </a>
                            </div>
                        </div>
                    
                        <div class="w-full max-w-md mx-auto px-4 py-8 content-shadow bg-white">
                        
                            <a href="/">
                                <div class="mx-auto">
                                    <img src="{{ asset('img/logos/LogoUCAB.png') }}" alt="Logo de la empresa" class="w-16rem mx-auto">
                                </div>
                            </a>

                           @if (isset($slot))
                           {{ $slot }}
                               
                           @else
                            @yield('content')
                           @endif 
                        
                        </div>
                    
                    </div>

                </div>

                <!-- Image -->
                {{-- <div class="hidden md:block absolute top-0 bottom-0 right-0 md:w-1/2" aria-hidden="true">
                    <img class="object-cover object-center w-full h-full" src="{{ asset('img/frontbanner/principal.png') }}" width="760" height="1024" alt="Authentication image" />
                    <img class="absolute top-1/4 left-0 -translate-x-1/2 ml-8 hidden lg:block " src="{{ asset('img/auth-decoration.png') }}" width="218" height="224" alt="Authentication decoration" />
                </div> --}}

            </div>

        </main>   
        <script src="{{asset('js/show_alerts.js')}}"></script>
        <script src="{{asset('vendor/toastr/toastr.js')}}"></script>
        @livewireScripts     
    </body>
</html>
