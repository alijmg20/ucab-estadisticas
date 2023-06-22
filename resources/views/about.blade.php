<x-app-layout>
    <h1
        class="mb-8 mt-8 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-3xl dark:text-white">
        Sobre Nosotros</h1>

        <div class="container mb-8">
            <div class="flex flex-wrap items-center"> <!-- Agregando la clase 'items-center' -->
                <div class="w-full sm:w-full lg:w-3/5">
                    <img src="{{ asset('img/frontbanner/ucab.png') }}" alt="Foto del producto"
                        class="cursor-pointer w-full">
                </div>
                <div class="w-full sm:w-full lg:w-2/5 px-4">
                    <h1
                    class="mb-8 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-3xl dark:text-white">
                    ¿Que es el Centro de Estudios Regionales?</h1>

                    <p class="mb-4 text-lg font-normal text-gray-800 lg:text-lg dark:text-gray-400">
                        El centro de Estudios Regionales es un centro de investigación de carácter multidisciplinario e interdisciplinario, adscrito al
                        Vicerrectorado de la Extensión Guayana y a la Facultad de Ciencias Económicas y Sociales de la
                        Universidad Católica Andrés Bello.
                    </p>
                    <p class="mb-4 text-lg font-normal text-gray-800 lg:text-lg dark:text-gray-400">
                        Somos un espacio dedicado a la generación y transferencia de conocimientos orientados al estudio de
                        problemas sociales, económicos, culturales, políticos y ambientales, que impactan la vida de los
                        ciudadanos en la Región Guayana
                    </p>
                </div>
            </div>
        </div>
        

    <h1
        class="mb-4 mt-4 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-3xl dark:text-white">
        Objetivos</h1>

    <div id="section-information" class="container mt-4">
        <section class="bg-white dark:bg-gray-900">
            <div class=" px-4 mx-auto max-w-screen-xl">

                <p class="mb-4 text-lg font-normal text-gray-800 lg:text-lg sm:px-16 dark:text-gray-400">
                    Coordinar las líneas de investigación y los proyectos orientados al estudio social, económico,
                    cultural, político y ambiental de la Región Guayana.</p>

                <p class="mb-4 text-lg font-normal text-gray-800 lg:text-lg sm:px-16 dark:text-gray-400">
                    Difundir el conocimiento producido sobre el desarrollo regional mediante publicaciones, y eventos
                    académicos y no académicos.</p>

                <p class="mb-4 text-lg font-normal text-gray-800 lg:text-lg sm:px-16 dark:text-gray-400">
                    Establecer vínculos con otros centros, institutos, organismos y organizaciones nacionales e
                    internacionales, para la ejecución de proyectos en colaboración.</p>
                <p class="mb-4 text-lg font-normal text-gray-800 lg:text-lg sm:px-16 dark:text-gray-400">
                    Promover la investigación entre los estudiantes y docentes de las escuelas de pregrado y postgrado
                    de la Universidad, apoyando en los procesos investigativos.</p>
            </div>
        </section>
    </div>

    {{-- Seccion de informacion banner --}}
    <x-front.front-banner>
        <x-slot name="url">{{asset('img/frontbanner/ucab.png')}}</x-slot>
    </x-front.front-banner>
    

</x-app-layout>
