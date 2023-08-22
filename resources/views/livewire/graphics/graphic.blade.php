<div wire:init='loadGraphic'>
    <div
        class="border border-gray-300 mb-6 mt-4 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
            <div class="inline-block w-full">
                <div class="px-6 py-4 flex flex-items-center">
                    <div class="flex items-center">
                        <span class="mr-2 text-gray-700 dark:text-gray-400">Selecciona el grafico:
                        </span>
                        <x-select-dropdown class="mx-auto" wire:model="typeGraphic" wire:change="selectGraphic()">
                            @foreach ($entrysGraphic as $entry)
                                <option value="{{ $entry->id }}">{{ $entry->name }}</option>
                            @endforeach
                        </x-select-dropdown>
                    </div>
                </div>
                @if ($variable)
                    <div id="{{ $variable->id }}"></div>
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
                <div class="px-6 py-4">
                    <div class="text-2xl text-left dark:text-gray-400 flex items-center justify-between w-full p-5 
                    font-medium text-left text-gray-800  focus:outline-none">
                        P12 cual es su opinion de la universidad
                    </div>
                </div>
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
