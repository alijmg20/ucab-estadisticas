<div>
        {{-- Imagen principal  --}}
        <x-front.front-image>
            <x-slot name="url">{{ __('img/frontbanner/principal.png') }}</x-slot>
            <x-slot name="title">{{ $line->name }}</x-slot>
        </x-front.front-image>
    
        <h1
            class="mb-8 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-3xl dark:text-white">
            {{ $line->name }}</h1>
    
        <div class="container">
            <div class="flex flex-wrap">
                <div class="w-full sm:w-full lg:w-3/5">
                    <img src="{{ App\Helpers\Tools::StorageUrl($line->image->url) }}" alt="Foto del producto" class="cursor-pointer w-full">
                </div>
                <div class="w-full sm:w-full lg:w-2/5 px-4">
                    <p>{!! $line->description !!}</p>
                </div>
            </div>
        </div>
    
        <h1
            class="mt-8 mb-8 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-3xl dark:text-white">
            {{ __('Proyectos de ') }}{{ $line->name }}</h1>
            <div class="container mx-auto">
                @foreach($projects as $project)
                    <a href="{{route('projects.show',compact('project'))}}">
                    <div class="grid grid-cols-1 md:grid-cols-2 py-8 mt-8 mb-8 border-b border-gray-300">
                        <div class="overflow-hidden shadow-md">
                            <img src="{{ App\Helpers\Tools::StorageUrl($project->image->url) }}" alt="Imagen del producto"
                                class="w-full h-auto md:h-full">
                        </div>
                        <div
                            class="rounded-md overflow-hidden shadow-md flex flex-col justify-center px-4 py-8 md:px-8 md:py-12 bg-white">
                            <div class="text-center">
                                <h3 class="text-3xl font-bold mb-4">{{ $project->name }}</h3>
                            </div>
                            <p class="text-gray-600 text-lg mb-6 text-left truncate-2">{{ strip_tags($project->description) }}</p>
                            <p class="text-gray-900 text-base text-left font-bold mt-4">{{__('Encargado del proyecto: ')}} {{ $project->user->name }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
                <div class="mt-4 mb-4">
                    {{ $projects->links() }}
                </div>
            </div>
    
        {{-- Seccion de informacion lineas --}}
        <x-front.front-lines :same="$line->id">
            <x-slot name="title">{{ __('Algunas de nuestras Lineas de Investigación') }}</x-slot>
            <x-slot name="needButton">{{'true'}}</x-slot>
            <x-slot name="titleButton">{{__('Conoce Nuestras lineas de Investigación')}}</x-slot>
        </x-front.front-lines>
</div>
