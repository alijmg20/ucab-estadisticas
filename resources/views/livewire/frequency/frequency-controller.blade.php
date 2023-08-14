<div wire:init='loadFrequencies()'>
    <div class="inline-block w-full shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 flex flex-items-center">
            <div class="flex items-center">
                <span class="mr-2 text-gray-700 dark:text-gray-400">Mostrar</span>
                <x-select-dropdown class="mx-2" wire:model.def='cantFrequency'>
                    @foreach ($entrysFrequency as $entry)
                        <option value="{{ $entry }}">{{ $entry }}</option>
                    @endforeach
                </x-select-dropdown>
                <span class="ml-2 mr-2 text-gray-700 dark:text-gray-400">Entradas</span>
            </div>
            <x-input placeholder="Buscar" class="flex-1 mr-4" type="text" wire:model='searchFrequency'></x-input>
            @livewire('frequency.frequency-modal')
        </div>
        <x-table>
            <x-slot name="headers">
                <th class="px-4 py-3">
                    Nombre
                </th>
                <th class="px-4 py-3">
                    Valor
                </th>
                <th class="px-4 py-3" >
                    Posición
                </th>
                <th class="px-4 py-3">
                    Acciones
                </th>
            </x-slot>
            <x-slot name="body">
                @if ($frequencies && count($frequencies) == 0)
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center">
                            <div class="container mt-4 mb-4">
                                <x-alert-loading-danger>
                                    <x-slot name="title">¡No hay Frecuencias disponibles!</x-slot>
                                    <x-slot name="subtitle">Vuelva a cargar el proyecto en el sistema</x-slot>
                                </x-alert-loading-danger>
                            </div>
                        </td>
                    </tr>
                @elseif ($frequencies && count($frequencies))
                    @foreach ($frequencies as $frequency)
                        <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <td class="prose truncate px-4 py-3">{{ $frequency->name }}</td>
                            <td class="prose truncate px-4 py-3">{{ $frequency->value }}</td>
                            <td class="px-4 py-3 text-xs">
                                <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                    {{ $frequency->position }}
                                </span>
                              </td>
                            {{-- <td class="cursor-pointer px-4 py-3 text-sm">{{ $frequency->status == 1 ? 'No Publicado' : 'Publicado' }}</td> --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    @if($frequency->position > 1)
                                    <button wire:click='upPosition({{$frequency->id}})'
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        aria-label="chevron-up">
                                        <i class="fas fa-chevron-up"></i>
                                    </button>
                                    @endif
                                    @if($frequency->position < $cantfrequencies)
                                    <button wire:click='downPosition({{$frequency->id}})'
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        aria-label="chevron-down">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                    @endif
                                    <button wire:click='$emitTo("frequency.frequency-modal","edit",{{ $frequency->id }})'
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button wire:click='$emit("frequencyDelete",{{ $frequency->id }})'
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
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
    <script></script>
</div>
