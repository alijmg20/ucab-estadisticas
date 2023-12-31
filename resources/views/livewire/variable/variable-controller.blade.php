<div wire:init='loadVariables()'>
    <div class="inline-block w-full shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 flex flex-items-center">
            <div class="flex items-center">
                <span class="mr-2 text-gray-700 dark:text-gray-400">Mostrar</span>
                <x-select-dropdown class="mx-2" wire:model.def='cantVariable'>
                    @foreach ($entrysVariable as $entry)
                        <option value="{{ $entry }}">{{ $entry }}</option>
                    @endforeach
                </x-select-dropdown>
                <span class="ml-2 mr-2 text-gray-700 dark:text-gray-400">Entradas</span>
            </div>
            <x-input placeholder="Buscar" class="flex-1 mr-4" type="text" wire:model='searchVariable'></x-input>
            @livewire('variable.variable-modal')
        </div>
        <x-table>
            <x-slot name="headers">
                <th class="px-4 py-3">
                    Selección
                </th>
                <th class="cursor-pointer px-4 py-3" wire:click='order("id")'>
                    ID
                    {{-- SORT --}}
                    @if ($sortVariable == 'id')
                        @if ($directionVariable == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right"></i>
                        @endif
                    @else
                        <i class="fas fa-sort float-right"></i>
                    @endif
                </th>
                <th class="cursor-pointer px-4 py-3" wire:click='order("name")'>
                    Nombre
                    {{-- SORT --}}
                    @if ($sortVariable == 'name')
                        @if ($directionVariable == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right"></i>
                        @endif
                    @else
                        <i class="fas fa-sort float-right"></i>
                    @endif
                </th>
                <th class="cursor-pointer px-4 py-3" wire:click='order("type_name")'>
                    tipo
                    {{-- SORT --}}
                    @if ($sortVariable == 'type_name')
                        @if ($directionVariable == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right"></i>
                        @endif
                    @else
                        <i class="fas fa-sort float-right"></i>
                    @endif
                </th>
                <th class="px-4 py-3">
                    Acciones
                </th>
            </x-slot>
            <x-slot name="body">
                @if ($variables && count($variables) == 0)
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
                @elseif ($variables && count($variables))
                    @foreach ($variables as $var)
                        <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <td>
                                <div class="flex justify-center items-center">
                                 <input id="default-checkbox-{{ $var->id }}" type="checkbox" value="" @if ($var->status == 2) checked @endif wire:click="status({{ $var->id }})" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                            </td>
                            <td class="px-6 py-3 text-sm">{{ $var->id }}</td>
                            <td class="prose truncate px-4 py-3">{{ $var->name }}</td>
                            <td class="cursor-pointer px-4 py-3 text-sm">
                                {{ $var->type_name }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <button wire:click='$emitTo("variable.variable-modal","edit",{{ $var->id }})'
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button wire:click='$emit("variableDelete",{{ $var->id }})'
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
        @if ($variables && count($variables) && $variables->hasPages())
            <div class="px-6 py-3">
                {{ $variables->links() }}
            </div>
        @endif
    </div>
</div>
