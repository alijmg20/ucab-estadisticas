<div wire:init='loadCheckbox'>
    @if ($variable)
        <div
            class="border border-gray-300 mb-6 mt-4 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
            <div class="px-6 py-4">
                <div id="checkbox-{{ $variable->id }}"></div>
            </div>
            @livewire('graphics.checkbox.checkbox-table', ['variable' => $variable->id])
        </div>
    @endif
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('checkboxShow', (variable,data) => {
                // Datos para el checkbox
                name = "checkbox-" + variable.id;
                columnColor(variable,name, data);
            });
        });
    </script>
</div>
