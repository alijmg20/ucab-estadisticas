@props(['url'])
<div class="relative banner">
    <img src="{{$url}}" alt="Imagen de proyectos" class="w-full max-h-600 object-cover">
    <div class="absolute inset-0 bg-gray-800 opacity-50"></div> <!-- Layered -->
    <div class="absolute inset-0 flex flex-col justify-center items-center">
      <h1 class="text-white text-2xl text-center lg:text-4xl font-bold mb-2">{{__('Conoce Nuestros Proyectos')}}</h1>
      <h2 class="text-white text-center sm:text-xl text-2xl font-medium mb-4">{{__('Revisa nuestros proyectos de investigación')}}</h2>
      <a href="{{route('projects.index')}}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 flex items-center">
        {{__('Proyectos de investigación')}}
        <i class="fas fa-arrow-right ml-2"></i>
      </a>
    </div>
</div>