<div wire:init='loadWordCloud'>
    @if ($variable)
        <div
            class="border border-gray-300 mb-6 mt-4 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
            <div class="px-6 py-4">
                <div
                    class="text-2xl text-left dark:text-gray-400 flex items-center justify-between w-full p-5 
            font-medium text-left text-gray-800 {{-- border border-gray-200 rounded-lg 
            dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 --}} focus:outline-none">
                    {{ $variable->name }}
                </div>
                {{-- <button wire:click='loadWordCloud'>enviar</button> --}}
            </div>
            <div class="px-6 py-4">
                <div id="qualitative-{{ $variable->id }}"></div>
            </div>
            @livewire('graphics.qualitatives.qualitative-table',['variable' => $variable->id])
        </div>
    @endif
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('cloudShow', (data,variable) => {
                // Datos para la nube de palabras
                name = "qualitative-" + variable.id;
                generateWordCloud(data,name,variable);
            });
        });
    </script>
</div>
