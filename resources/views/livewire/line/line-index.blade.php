<div>
    {{-- Imagen principal  --}}
    <x-front.front-image>
        <x-slot name="url">{{ __('img/frontbanner/principal.png') }}</x-slot>
        <x-slot name="title">{{ __('Lineas de Investigación') }}</x-slot>
    </x-front.front-image>


    {{-- Seccion de informacion lineas --}}
    <x-front.front-lines>
        <x-slot name="title">{{ __('Nuestras Lineas de Investigación') }}</x-slot>
    </x-front.front-lines>

    {{-- Seccion de informacion banner --}}
    <x-front.front-banner>
        <x-slot name="url">{{ asset('img/frontbanner/ucab.png') }}</x-slot>
    </x-front.front-banner>

    {{-- Iconos azules --}}
    <x-front.front-big-icons />

    {{-- Testimonials Front --}}
    <x-front.front-testimonials/>
</div>
