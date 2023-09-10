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
                <x-table>
                    <x-slot name="headers">
                        <th class="px-4 py-3">
                            Selección
                        </th>
                        <th class="cursor-pointer px-4 py-3">
                            Nombre
                        </th>
                    </x-slot>
                    <x-slot name="body">
                        @if ($variablesList && count($variablesList) == 0)
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center">
                                    <div class="container mt-4 mb-4">
                                        <x-alert-loading-danger>
                                            <x-slot name="title">¡No hay variables disponibles!</x-slot>
                                            <x-slot name="subtitle">Vuelva a cargar el proyecto en el sistema</x-slot>
                                        </x-alert-loading-danger>
                                    </div>
                                </td>
                            </tr>
                        @elseif ($variablesList && count($variablesList))
                            @foreach ($variablesList as $var)
                                <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <td>
                                        <div class="flex justify-center items-center">
                                            <input id="default-checkbox-{{ $var->id }}" type="checkbox"
                                                value="{{ $var->id }}" @if (in_array($var->id, $variables)) checked @endif
                                                wire:model="variables"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        </div>
                                    </td>
                                    <td class="prose truncate px-4 py-3">{{ $var->name }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center">
                                    <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
                                        role="status">
                                        <span
                                            class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </x-slot>
                </x-table>
                {{-- <div>variables {{var_Export($variables)}}</div> --}}
                @if ($variablesList && count($variablesList) && $variablesList->hasPages())
                    <div class="px-6 py-3">
                        {{ $variablesList->links() }}
                    </div>
                @endif
                <x-input-error for="variables" />
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
