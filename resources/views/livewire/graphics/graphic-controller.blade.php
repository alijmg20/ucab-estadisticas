<div>
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-block w-full shadow rounded-lg overflow-hidden">
            @if (count($variablesActive))
                @foreach ($variablesActive as $variableActive)
                    @livewire('graphics.graphic', ['variable' => $variableActive['id']], key($variableActive['id']))
                @endforeach
            @else
                <div class="container mt-4 mb-4">
                    <x-alert-loading-danger>
                        <x-slot name="title">Variables NO seleccionadas</x-slot>
                        <x-slot name="subtitle">¡Debe seleccionar las variables que desea ver en la pestaña
                            <b>variables!</b>
                        </x-slot>
                    </x-alert-loading-danger>
                </div>
            @endif
        </div>
    </div>
</div>
