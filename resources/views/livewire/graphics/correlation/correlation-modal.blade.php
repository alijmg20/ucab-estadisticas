<div>

    <x-button class="bg-green-600" wire:click="openModal">Nueva</x-button>

    <x-dialog-modal id="CorrelationModal" wire:model='openCorrelation'>
        <x-slot name="title">
            <div class="container">
                {{ $correlation ? 'Editar Correlación' : 'Nueva Correlación' }}
                <span wire:click='closeModal' class="float-right text-gray-500 text-2xl cursor-pointer">&times;</span>
                <!-- Botón de cierre -->
            </div>
        </x-slot>

        <x-slot name="content">

            <div class="container mt-4">
                <x-label class="mb-4" value="Nombre de la correlación" />
                <x-input id="name" wire:model='name' type="text" class="w-full" />
                <x-input-error for="name" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" for="variables" value="Selecciona la variable para las filas" />
                <x-select-dropdown class="w-full" wire:model.def='variables.0'>
                    <option value="">selecciona una opción</option>
                    @foreach ($variablesList as $variable)
                        <option value="{{ $variable->id }}">{{ $variable->name }}</option>
                    @endforeach
                </x-select-dropdown>
                <x-input-error for="variables.0" class="mt-2" />
                {{-- <div>variables {{var_Export($variables)}}</div> --}}
            </div>
            <div class="container mt-4">
                <x-label class="mb-4" for="variables" value="Selecciona la variable para las columnas" />
                <x-select-dropdown class="w-full" wire:model.def='variables.1'>
                    <option value="">selecciona una opción</option>
                    @foreach ($variablesList as $variable)
                        <option value="{{ $variable->id }}">{{ $variable->name }}</option>
                    @endforeach
                </x-select-dropdown>
                <x-input-error for="variables.1" class="mt-2" />
                {{-- <div>variables {{var_Export($variables)}}</div> --}}
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button class="mr-2" wire:click="closeModal()">
                Cancelar
            </x-secondary-button>
            @if ($correlation)
                <x-primary-button wire:click='update()' wire:loading.attr='disabled' wire:target="update"
                    class="bg-blue-500 disabled:opacity-25">
                    actualizar
                </x-primary-button>
            @else
                <x-primary-button wire:click='save()' wire:loading.attr='disabled' wire:target="save"
                    class="bg-blue-500 disabled:opacity-25">
                    Crear
                </x-primary-button>
            @endif
        </x-slot>
    </x-dialog-modal>

</div>
