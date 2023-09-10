<div>
    <div class="inline-block w-full bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 flex flex-items-center">
            <div class="flex items-center">
                <span class="mr-2 text-gray-700 dark:text-gray-400">Mostrar</span>
                <x-select-dropdown class="mx-2" wire:model.def='cantVariable'>
                    {{-- @foreach ($entrysVariable as $entry)
                        <option value="{{ $entry }}">{{ $entry }}</option>
                    @endforeach --}}
                    <option value="">selecciona una opcion</option>
                </x-select-dropdown>
                <span class="ml-2 mr-2 text-gray-700 dark:text-gray-400">Entradas</span>
            </div>
            <x-input placeholder="Buscar" class="flex-1 mr-4" type="text"></x-input>
            @livewire('graphics.correlation.correlation-modal',['file' => $file->id])
        </div>
    </div>
    @if (count($correlations))
        @foreach ($correlations as $correlation)
            @livewire('graphics.correlation.variable-correlation', ['correlation' => $correlation['id']], key($correlation['id']))
        @endforeach 
    @else
        <div style="display: none">@livewire('graphics.correlation.variable-correlation', ['correlation' => 0])</div>
        <div class="container mt-4 mb-4">
            <x-alert-loading-danger>
                <x-slot name="title">NO existen correlaciones</x-slot>
                <x-slot name="subtitle">¡Puede crear una en el botón 
                    <b>NUEVA</b>
                </x-slot>
            </x-alert-loading-danger>
        </div>
    @endif
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('correlationAlert', (title, message) => {
                alert(title, message)
            });
            Livewire.on('correlationDelete', (correlation) => {
                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "¡Esta acción es irreversible!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, estoy seguro!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo("graphics.correlation.correlation-controller", "delete",
                            correlation);
                        Swal.fire(
                            'Eliminado!',
                            "Se ha sido eliminado.",
                            'success'
                        )
                    }
                })
            });
        }); 
    </script>
</div>
