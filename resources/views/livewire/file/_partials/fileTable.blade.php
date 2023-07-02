<div>
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-block w-full shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 flex flex-items-center">
                <div class="flex items-center">
                    <span class="mr-2 text-gray-700 dark:text-gray-400">Mostrar</span>
                    <x-select-dropdown class="mx-2" wire:model.def='cantFileShow'>
                        @foreach ($entrys as $entry)
                            <option value="{{ $entry }}">{{ $entry }}</option>
                        @endforeach
                    </x-select-dropdown>
                    <span class="ml-2 mr-2 text-gray-700 dark:text-gray-400">Entradas</span>
                </div>
                <x-input placeholder="Buscar" class="flex-1 mr-4" type="text" wire:model='searchFileShow'></x-input>
            </div>

            <x-table>
                <x-slot name="headers">
                    @foreach ($variables as $variable)
                    <th class="cursor-pointer px-4 py-3">
                        {{$variable->name}}
                    </th>
                    @endforeach
                </x-slot>
                <x-slot name="body">
                    @if ($registers && count($registers))
                        @foreach ($registers as $regis)
                            <tr  class="cursor-pointer text-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600">
                                @foreach ($regis->datos as $item)
                                    <td class="px-6 py-3 text-sm">
                                        {{ $item }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center">
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
            @if ($registers && count($registers) && $registers->hasPages())
                <div class="px-6 py-3">
                    {{ $registers->links() }}
                </div>
            @endif
        </div>
    </div>
</div>