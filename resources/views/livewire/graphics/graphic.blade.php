<div wire:init='loadGraphic'>
    <div
        class="border border-gray-300 mb-6 mt-4 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
        <div class="inline-block w-full">
            <div class="px-6 py-4 flex flex-items-center">
                <div class="flex items-center w-full">
                    <span class="mr-2 text-gray-700 dark:text-gray-400">Selecciona el grafico:
                    </span>
                    <x-select-dropdown class="" wire:model="typeGraphic" wire:change="selectGraphic()">
                        @foreach ($entrysGraphic as $entry)
                            <option value="{{ $entry->id }}">{{ $entry->name }}</option>
                        @endforeach
                    </x-select-dropdown>
                    @if ($variable)
                    <x-primary-button wire:click='emitScore({{ $variable->id }})'
                        class="ml-2 bg-blue-500 disabled:opacity-25">
                        Puntaje de opciones
                    </x-primary-button>
                    @endif
                </div>
            </div>
            @if ($variable)
                <div id="{{ $variable->id }}"></div>
                @livewire('graphics.multiple.multiple-table', ['variable' => $variable->id])
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
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('graphicShow', (variable, data) => {
                if (variable.graphictype_id == 1)
                    column(variable, data);
                else if (variable.graphictype_id == 2) {
                    circle(variable, data);
                } else if (variable.graphictype_id == 3) {
                    bar(variable, data);
                }
            });
        });
    </script>
</div>
