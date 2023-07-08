<div wire:init='loadProjectIndex'>
    {{-- Imagen principal  --}}
    <x-front.front-image>
        <x-slot name="url">{{ __('img/projects/portada.png') }}</x-slot>
        <x-slot name="title">{{ __('Proyectos de Investigación del Centro de Estudios Regionales') }}</x-slot>
    </x-front.front-image>

    <div id="projects-index" class="container pb-8 ">
        <h1 class="text-2xl md:text-xl-4 font-semibold mt-4 mb-4 text-gray-600 text-center">
            {{ __('Proyectos de Investigación') }}
        </h1>
        <div class="px-6 pt-4 flex flex-items-center">
            <x-input placeholder="¿Desea buscar un proyecto?" class="flex-1 mr-4" type="text" wire:model='search'>
            </x-input>
        </div>
        <div class="container mx-auto">
            @if ($projects && count($projects))
                @foreach ($projects as $project)
                    <a href="{{ route('projects.show', compact('project')) }}">
                        <div class="grid grid-cols-1 md:grid-cols-2 py-8 mt-8 mb-8 border-b border-gray-300">
                            <div class="overflow-hidden shadow-md">
                                <img src="{{ App\Helpers\Tools::StorageUrl($project->image->url) }}"
                                    alt="Imagen del producto" class="w-full h-auto md:h-full">
                            </div>
                            <div
                                class="rounded-md overflow-hidden shadow-md flex flex-col justify-center px-4 py-8 md:px-8 md:py-12 bg-white">
                                <div class="text-center">
                                    <h3 class="text-3xl font-bold mb-4">{{ $project->name }}</h3>
                                </div>
                                <p class="text-gray-600 text-lg mb-6 text-left truncate-2">
                                    {{ strip_tags($project->description) }}</p>
                                <p class="text-gray-900 text-base text-left font-bold mt-4">
                                    {{ __('Encargado del proyecto: ') }} {{ $project->user->name }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <div class="container mx-auto mt-4 text-center">
                    <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
                        role="status">
                        <span
                            class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                    </div>
                </div>
            @endif
            <div class="mt-4 mb-4">
                @if ($projects && count($projects) && $projects->hasPages())
                    {{ $projects->links() }}
                @endif
            </div>
        </div>
    </div>

    {{-- Testimonials Front --}}
    @livewire('front.front-testimonials')


    {{-- Seccion de informacion lineas --}}
    @livewire('front.front-lines', [
        'same' => false,
        'title' => 'Algunas de nuestras Lineas de Investigación',
        'needButton' => true,
        'titleButton' => 'Conoce Nuestras lineas de Investigación',
    ])
</div>
