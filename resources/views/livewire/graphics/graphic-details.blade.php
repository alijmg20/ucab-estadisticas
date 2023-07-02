<div wire:init='loadGraphicDetails()'>
    <div class="inline-block w-full shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 flex flex-items-center">
            <div class="flex items-center">
                <span class="mr-2 text-gray-700 dark:text-gray-400">Mostrar</span>
                <x-select-dropdown class="mx-2" wire:model.def='cantGraphicDetails'>
                    @foreach ($entrysGraphicDetails as $entry)
                        <option value="{{ $entry }}">{{ $entry }}</option>
                    @endforeach
                </x-select-dropdown>
                <span class="ml-2 mr-2 text-gray-700 dark:text-gray-400">Entradas</span>
            </div>
            <x-input placeholder="Buscar" class="flex-1 mr-4" type="text" wire:model='searchGraphicDetails'></x-input>
            @livewire('graphics.graphic-details-modal')
        </div>
        <x-table>
            <x-slot name="headers">
                <th class="cursor-pointer px-4 py-3" wire:click='order("name")'>
                    Nombre
                    {{-- SORT --}}
                    @if ($sortGraphicDetails == 'name')
                        @if ($directionGraphicDetails == 'asc')
                            <i class="fas fa-sort-alpha-up-alt float-right"></i>
                        @else
                            <i class="fas fa-sort-alpha-down-alt float-right"></i>
                        @endif
                    @else
                        <i class="fas fa-sort float-right"></i>
                    @endif
                </th>
            </x-slot>
            <x-slot name="body">
                @if ($variables && count($variables) == 0)
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center">
                        <div class="container mt-4 mb-4">
                            <x-alert-loading-danger>
                                <x-slot name="title">Variables NO seleccionadas</x-slot>
                                <x-slot name="subtitle">¡Debe seleccionar las variables que desea ver en la pestaña <b>variables!</b></x-slot>
                            </x-alert-loading-danger>
                        </div>
                    </td>
                </tr>
                @elseif ($variables && count($variables))
                    @foreach ($variables as $var)
                        <tr class="cursor-pointer text-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <td class="prose truncate px-4 py-3" ><span wire:click='$emitTo("graphics.graphic-details-modal","openModal",{{ $var->id }})'>{{ $var->name }}</span></td>
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
