<div>
    <x-dialog-modal :maxWidth="'8xl'" id="VariableTypeModal" wire:model='openVariableTypeModal'>
        <x-slot name="title">
            <div class="container">
                {{ 'Configurar variables ' }} <i class="fas fa-cog"></i>
                @if ($file)
                    {{ $file->name }}
                @endif
            </div>
        </x-slot>

        <x-slot name="content">
            <x-input-error for="VariablesEmpty" class="mt-4 w-full" />
            <div class="container mt-4">
                <div class="inline-block w-full shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 flex flex-items-center">
                        <div class="flex items-center">
                            <span class="mr-2 text-gray-700 dark:text-gray-400">Mostrar</span>
                            <x-select-dropdown class="mx-2" wire:model.def='cantVariableType'>
                                @foreach ($entrysVariableType as $entry)
                                    <option value="{{ $entry }}">{{ $entry }}</option>
                                @endforeach
                            </x-select-dropdown>
                            <span class="ml-2 mr-2 text-gray-700 dark:text-gray-400">Entradas</span>
                        </div>
                        <x-input placeholder="Buscar" class="flex-1 mr-4" type="text"
                            wire:model='searchVariableType'></x-input>
                    </div>
                    <x-table>
                        <x-slot name="headers">
                            <th class="cursor-pointer px-4 py-3" wire:click='order("id")'>
                                ID
                                {{-- SORT --}}
                                @if ($sortVariableType == 'id')
                                    @if ($directionVariableType == 'asc')
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
                                @if ($sortVariableType == 'name')
                                    @if ($directionVariableType == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif
                            </th>
                            <th class="cursor-pointer px-4 py-3">
                                Tipo de variable
                            </th>
                        </x-slot>
                        <x-slot name="body">
                            @if ($variables && count($variables) == 0)
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">
                                        <div class="container mt-4 mb-4">
                                            <x-alert-loading-danger>
                                                <x-slot name="title">¡No hay variables disponibles!</x-slot>
                                                <x-slot name="subtitle">Vuelva a cargar el proyecto en el
                                                    sistema</x-slot>
                                            </x-alert-loading-danger>
                                        </div>
                                    </td>
                                </tr>
                            @elseif ($variables && count($variables))
                                @foreach ($variables as $var)
                                    <tr
                                        class="text-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <td class="px-6 py-3 text-sm">{{ $var->id }}</td>
                                        <td class="prose truncate px-4 py-3">{{ $var->name }}</td>
                                        <td class=" px-4 py-3">
                                            <x-select-dropdown class="w-full" wire:model='variablesTypeCollect.{{$var->id}}'>
                                                <option value="">selecciona una opción</option>
                                                @foreach ($TypesVariable as $TypeVariable)
                                                    <option value="{{ $TypeVariable->id }}">{{ $TypeVariable->name }}</option>
                                                @endforeach
                                            </x-select-dropdown>
                                            <x-input-error for="variablesTypeCollect.{{$var->id}}" class="mt-2 w-full" />
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
        </x-slot>

        <x-slot name="footer">
            <x-primary-button wire:click="save()" wire:loading.attr='disabled' wire:target="save"
                class="bg-blue-500 disabled:opacity-25">
                <span wire:loading.remove wire:target="save">{{ 'actualizar' }}</span>
                <span wire:loading wire:loading.disabled wire:target="save">actualizando...</span>
            </x-primary-button>
        </x-slot>
    </x-dialog-modal>
</div>
