<div wire:init='loadgraphic'>
    <div class="container mx-auto px-8 sm:px-8">
        <h1 class="mt-4 text-3xl text-center dark:text-gray-400">
            #{{$file->id}} {{ $file->name }}
        </h1>
    </div>
    <div id="graphics-show" class="px-6 py-6">
        @if (count($variablesActive))
            <div class="grid grid-cols-3 gap-4 font-mono text-white text-sm text-center font-bold leading-6">
                @foreach ($variablesActive as $variableActive)
                    @livewire('front.front-graphic', ['variable' => $variableActive['id'], 'selection' => random_int(1, 6)], key($variableActive['id']))
                @endforeach
            </div>
        @else
            <div style="display: none">@livewire('front.front-graphic', ['variable' => 0, 'selection' => random_int(1, 6)])</div>
            <div class="container mt-4 mb-4">
                <x-alert-loading-danger>
                    <x-slot name="title">NO se muestran variables seleccionadas</x-slot>
                    <x-slot name="subtitle">¡las variables No estan disponibles!
                    </x-slot>
                </x-alert-loading-danger>
            </div>
        @endif
    </div>
</div>
