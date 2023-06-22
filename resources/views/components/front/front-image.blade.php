<div class="relative h-full mb-8">
    <img src="{{ asset($url) }}" alt="Descripción de la imagen" class="object-cover w-full h-full {{--max-h-600--}}">

    <!-- Overlay para destacar el título -->
    <div class="overlay"></div>

    <!-- Título en el medio de la imagen -->
    <h1 class="absolute inset-0 text-center text-white font-bold uppercase tracking-wider text-4xl z-20 flex justify-center items-center">{{ $title }}</h1>
</div>