<div wire:init='loadProjectShow'>
    @if ($project->image)
        <figure class="grid grid-cols-1">
            <img class="cursor-pointer object-cover object-center w-full h-auto md:h-96"
                src="{{ App\Helpers\Tools::StorageUrl($project->image->url) }}" alt="{{ $project->name }}">
        </figure>
    @endif

    <div id="projects-show" class="container py-8">
        <h1 class="text-2xl md:text-xl-4 font-semibold mt-4 mb-4 text-gray-600 text-center">
            {{ $project->name }}
        </h1>

        <div class="grid gap-3">
            {{-- Contenido Principal --}}
            <div class="mt-4 project-content sm:px-16 lg:px-48">
                <div class="project-description text-lg mb-2 mt-4">
                    <div class="description text-gray-500">
                        {!! $project->description !!}
                    </div>
                </div>
            </div>
            <div class="mt-4 project-team">
                <div class="bg-white py-12 md:py-12">
                    <div class="mx-auto grid max-w-7xl gap-y-20 gap-x-8 px-6 lg:px-8 xl:grid-cols-3">
                        <div class="max-w-2xl">
                            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                                {{ __('Equipo del proyecto') }}
                            </h2>
                            <p class="mt-6 text-lg leading-8 text-gray-600">
                                {{ __('Conoce las personas participantes del proyecto') }}</p>
                        </div>
                        <ul role="list" class="grid gap-x-8 gap-y-12 sm:grid-cols-2 sm:gap-y-16 xl:col-span-2">
                            @if ($project->users && count($project->users))
                                @foreach ($project->users as $user)
                                    <li>
                                        <div class="flex items-center gap-x-6">
                                            @if ($user->profile_photo_path)
                                                <img class="h-16 w-16 rounded-full"
                                                    src="{{ App\Helpers\Tools::StorageUrl($user->profile_photo_path) }}"
                                                    alt="">
                                            @else
                                                <img class="h-16 w-16 rounded-full"
                                                    src="{{ asset('img/user-def.png') }}" alt="">
                                            @endif

                                            <div>
                                                <h3
                                                    class="text-base font-semibold leading-7 tracking-tight text-gray-900">
                                                    {{ $user->name }}</h3>
                                                <p class="text-sm font-semibold leading-6 text-indigo-600">
                                                    {{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </li>
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
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="mb-4 mt-4 font-semibold">
            {{-- Contenido secundario --}}
            <aside class="mt-4 mb-4 project-files">
                @livewire('front.front-controller-files', ['project' => $project])
            </aside>
            <aside class="mt-4 project-related">
                <h1 class="text-2xl md:text-xl-4 font-semibold mb-4 text-gray-600 text-center">
                    {{ __('Más proyectos de la Línea de Investigación ') }} {{ $project->line->name }}
                </h1>
                <div class="mt-8 similar-project-list">
                    @if ($similars && count($similars) == 0)
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center">
                                    <div class="container mt-4 mb-4">
                                        <x-alert-loading-danger>
                                            <x-slot name="title">¡No existen mas proyectos</x-slot>
                                            <x-slot name="subtitle"></x-slot>
                                        </x-alert-loading-danger>
                                    </div>
                                </td>
                            </tr>
                        @elseif ($similars && count($similars))
                        <ul class=" grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                            @foreach ($similars as $similar)
                                <li class="mb-4 w-70 md:w-80">
                                    <a href="{{ route('projects.show', $similar) }}">
                                        @if ($similar->image)
                                            <img class="p-4 mb-4 w-70 md:w-80 h-16-25"
                                                src="{{ App\Helpers\Tools::StorageUrl($similar->image->url) }}"
                                                alt="{{ $similar->name }}">
                                        @else
                                            <img class="mb-4 w-70 md:w-80 h-16-25"
                                                src="{{ asset('img/notfound.svg') }}" alt="{{ $similar->name }}">
                                        @endif
                                    </a>
                                    <div class="description text-gray-500 truncate-2">
                                        {!! strip_tags($similar->description) !!}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="container mx-auto mt-4 text-center">
                            <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
                                role="status">
                                <span
                                    class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="mt-4 mb-4">
                    @if ($similars && count($similars) && $similars->hasPages())
                        {{ $similars->links() }}
                    @endif
                </div>
            </aside>
        </div>
    </div>
    {{-- Seccion de informacion lineas --}}
    @livewire('front.front-lines', [
        'same' => false,
        'title' => 'Algunas de nuestras Lineas de Investigación',
        'needButton' => true,
        'titleButton' => 'Conoce Nuestras lineas de Investigación',
    ])

    {{-- Seccion de informacion banner --}}
    <x-front.front-banner>
        <x-slot name="url">{{ asset('img/frontbanner/ucab.png') }}</x-slot>
    </x-front.front-banner>

</div>
