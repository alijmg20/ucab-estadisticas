<div>
    <x-dialog-modal maxWidth="8xl" id="ScoreModal" wire:model='openScore'>
        <x-slot name="title">
            <div class="">
                Puntaje de las opciones
                <span wire:click='closeModal()' class="float-right text-gray-500 text-2xl cursor-pointer">&times;</span>
                <!-- Botón de cierre -->
            </div>
        </x-slot>

        <x-slot name="content">
            <x-input-error for="ScoreEmpty" class="mt-4 w-full" />
            <div class="container mt-4">
                <div class="inline-block w-full shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 flex flex-items-center">
                        <div class="flex items-center">
                            <span class="mr-2 text-gray-700 dark:text-gray-400">Mostrar</span>
                            <x-select-dropdown class="mx-2" wire:model.def='cantFrequencies'>
                                @foreach ($entrysFrequencies as $entry)
                                    <option value="{{ $entry }}">{{ $entry }}</option>
                                @endforeach
                            </x-select-dropdown>
                            <span class="ml-2 mr-2 text-gray-700 dark:text-gray-400">Entradas</span>
                        </div>
                        <x-input placeholder="Buscar" class="flex-1 mr-4" type="text"
                            wire:model='searchFrequencies'></x-input>
                    </div>
                    <x-table>
                        <x-slot name="headers">
                            <th class="cursor-pointer px-4 py-3" wire:click='order("name")'>
                                Nombre
                                {{-- SORT --}}
                                @if ($sortFrequencies == 'name')
                                    @if ($directionFrequencies == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif
                            </th>
                            <th class="cursor-pointer px-4 py-3">
                                Puntaje
                            </th>
                        </x-slot>
                        <x-slot name="body">
                            @if ($frequencies && count($frequencies) == 0)
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">
                                        <div class="container mt-4 mb-4">
                                            <x-alert-loading-danger>
                                                <x-slot name="title">¡No hay frecuencias disponibles!</x-slot>
                                                <x-slot name="subtitle">Vuelva a cargar el proyecto en el
                                                    sistema</x-slot>
                                            </x-alert-loading-danger>
                                        </div>
                                    </td>
                                </tr>
                            @elseif ($frequencies && count($frequencies))
                                @foreach ($frequencies as $freq)
                                    <tr
                                        class="text-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <td class="prose truncate px-4 py-3">{{ $freq->name }}</td>
                                        <td class=" px-4 py-3">
                                            <input
                                            min="0"
                                            wire:model='frequenciesValues.{{$freq->id}}' type="number" id="visitors" class="w-full bg-gray-50 
                                            border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                                            block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
                                            dark:placeholder-gray-400 dark:text-white 
                                            dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="">
                                            <x-input-error for="frequenciesValues.{{$freq->id}}" class="mt-2 w-full" />
                                        </td>
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
                    @if ($frequencies && count($frequencies) && $frequencies->hasPages())
                        <div class="px-6 py-3">
                            {{ $frequencies->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class="mr-2" wire:click="closeModal()">
                Cancelar
            </x-secondary-button>
            <x-primary-button wire:click='update()' wire:loading.attr='disabled' wire:target="update"
                class="bg-blue-500 disabled:opacity-25">
                actualizar
            </x-primary-button>
        </x-slot>
    </x-dialog-modal>

</div>
