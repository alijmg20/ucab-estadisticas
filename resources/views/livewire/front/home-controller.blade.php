<div>
    <x-front.front-carrusel />

        {{-- Seccion de Informacion --}}
    <div id="section-information" class="container mt-4">
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                <h1
                    class="mb-8 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-3xl dark:text-white">
                    ¿Que es el Centro de Estudios Regionales?</h1>
                <p class="mb-8 text-lg font-normal text-gray-500 lg:text-lg sm:px-16 lg:px-48 dark:text-gray-400">
                    El Centro de Estudios Regionales Joseph Gumilla es una organización de carácter multidisciplinario e
                    interdisciplinario, adscrito al Vicerrectorado de Extensión en Guayana y a la Facultad de Ciencias
                    Económicas y Sociales de la Universidad Católica Andrés Bello. A través de nuestras líneas de
                    investigación, estudiamos problemas relacionados con la interacción humana en espacios regional,
                    intrarregional e interregional, atendiendo criterios naturales, político-territoriales, económicos,
                    sociales, educativos y culturales.</p>

                <h1
                    class="mb-2 sm:px-16 lg:px-48 text-2xl font-bold tracking-tight leading-none text-gray-900 md:text-2xl lg:text-2xl dark:text-white">
                    Objetivo general</h1>
                <p class="mb-8 text-lg font-normal text-gray-500 lg:text-lg sm:px-16 lg:px-48 dark:text-gray-400">
                    Propiciar, promover, diseñar y coordinar líneas de investigación orientadas, fundamentalmente, al
                    estudio de problemas relacionados con la interacción humana en el espacio, cuyo carácter regional,
                    intrarregional e interregional pueda definirse atendiendo a criterios naturales,
                    político-territoriales, económicos, sociales, educativos o culturales.</p>
            </div>
        </section>
    </div>
        {{-- Seccion de informacion lineas --}}
    <x-front.front-lines>
        <x-slot name="title">{{ __('Algunas de nuestras Lineas de Investigación') }}</x-slot>
        <x-slot name="needButton">{{'true'}}</x-slot>
        <x-slot name="titleButton">{{__('Conoce Nuestras lineas de Investigación')}}</x-slot>
    </x-front.front-lines>

    {{-- Seccion de informacion banner --}}
    <x-front.front-banner>
        <x-slot name="url">{{asset('img/frontbanner/ucab.png')}}</x-slot>
    </x-front.front-banner>

</div>
