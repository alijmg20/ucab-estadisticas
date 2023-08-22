<div wire:init='loadGraphic'>
    <div class="inline-block w-full shadow rounded-lg overflow-hidden bg-white">
        @if ($variable)
            @if ($selection > 0 && $selection < 4)
                <div class="p-4 rounded-lg">
                    <div id="{{ $variable->id }}"></div>
                </div>
            @endif
            @if ($selection > 3 && $selection < 7)
                <div class="p-4 rounded-lg col-span-2">
                    <div id="{{ $variable->id }}"></div>
                </div>
            @endif
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
