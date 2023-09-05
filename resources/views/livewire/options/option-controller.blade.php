<div wire:init='loadOptions()'>
    <div class="inline-block w-full shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 flex flex-items-center">
            <div class="flex items-center">
                <span class="mr-2 text-gray-700 dark:text-gray-400">Mostrar</span>
                <x-select-dropdown class="mx-2" wire:model.def='cantVariableOption'>
                    @foreach ($entrysVariableOption as $entry)
                        <option value="{{ $entry }}">{{ $entry }}</option>
                    @endforeach
                </x-select-dropdown>
                <span class="ml-2 mr-2 text-gray-700 dark:text-gray-400">Entradas</span>
            </div>
            <x-input placeholder="Buscar" class="flex-1 mr-4" type="text" wire:model='searchOption'></x-input>
            @livewire('options.option-modal')
        </div>
        <x-table>
            <x-slot name="headers">
                <th class="px-4 py-3">
                    Nombre
                </th>
                <th class="px-4 py-3">
                    Acciones
                </th>
            </x-slot>
            <x-slot name="body">
                @if ($options && count($options) == 0)
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center">
                            <div class="container mt-4 mb-4">
                                <x-alert-loading-danger>
                                    <x-slot name="title">¡No hay opciones disponibles!</x-slot>
                                    <x-slot name="subtitle">Vuelva a cargar el proyecto en el sistema</x-slot>
                                </x-alert-loading-danger>
                            </div>
                        </td>
                    </tr>
                @elseif ($options && count($options))
                    @foreach ($options as $option)
                        <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <td class="prose truncate px-4 py-3">{{ $option->name }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <button wire:click='$emitTo("options.option-modal","edit",{{ $option->id }})'
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button wire:click='$emit("optionDelete",{{ $option->id }})'
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
        @if ($options && count($options) && $options->hasPages())
            <div class="px-6 py-3">
                {{ $options->links() }}
            </div>
        @endif
    </div>
    <script></script>
</div>
