@extends('layouts.authentication')
@section('title', 'Clic Cloud | Login')


@section('content')
    <style>
        body{
            background: #22252A;
        }
    </style>

    {{-- tenimos problemas cuando se manejaban las dos sesiones 
    dentro del mismo navegador, por eso creamos nuestro login 
    y no utilizamos el que iene por defecto --}}
    @livewire('auth.login-propio')

@endsection
