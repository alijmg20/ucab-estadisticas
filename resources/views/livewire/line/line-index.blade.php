<div>
    {{-- Imagen principal  --}}
    <x-front.front-image>
        <x-slot name="url">{{ __('img/frontbanner/principal.png') }}</x-slot>
        <x-slot name="title">{{ __('Lineas de Investigación') }}</x-slot>
    </x-front.front-image>


    {{-- Seccion de informacion lineas --}}
    @livewire('front.front-lines', 
            [
            'same' => false,
            'title' => 'Nuestras lineas de Investigación',
            'needButton' => false,
            'titleButton' => '',
            ]
        )

    {{-- Seccion de informacion banner --}}
    <x-front.front-banner>
        <x-slot name="url">{{ asset('img/frontbanner/ucab.png') }}</x-slot>
    </x-front.front-banner>

    {{-- Iconos azules --}}
    <x-front.front-big-icons />

    @livewire('front.front-testimonials')
</div>
