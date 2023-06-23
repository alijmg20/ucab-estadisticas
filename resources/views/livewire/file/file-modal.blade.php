<div>
    <x-loading />
    <x-button class="bg-green-600" wire:click="openModal">Nueva</x-button>

    <x-dialog-modal id="FileModal" wire:model='open'>
        <x-slot name="title">
            <div class="container">
                {{ $file ? 'Editar archivo' : 'Nuevo Archivo' }}
                <span wire:click='closeModal' class="float-right text-gray-500 text-2xl cursor-pointer">&times;</span>
                <!-- Botón de cierre -->
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="container mt-4">
                <x-label class="mb-4" value="Nombre del archivo" />
                <x-input id="name" wire:model='name' type="text" class="w-full" />
                <x-input-error for="name" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Estatus de publicación" />
                <div>
                    <input
                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        type="checkbox" name="status" wire:model="status"
                        @if ($status == true) checked @endif />
                    <span class="ml-2">
                        @if ($status == true)
                            Publicado
                        @else
                            No Publicado
                        @endif
                    </span>
                </div>
                <x-input-error for="status" />
            </div>
            @if ($file)
                <div class="container mt-4 mb-4">
                    <x-alert-loading-danger>
                        <x-slot name="title">Los datos del archivo no son editables</x-slot>
                        <x-slot name="subtitle">Puede eliminarlo y volverlo a cargar</x-slot>
                    </x-alert-loading-danger>
                </div>
                <div class="container mt-4 mb-4">
                    <x-label class="mb-4" value="Editar nombre de variables" />
                    @livewire('variable.variable-controller', ['file' => $file])
                </div>
            @else
                <div class="container mt-4">
                    <x-label class="mb-4" value="Archivo del proyecto" />
                    <x-input-file autocomplete="off"
                        accept=".csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                        id="file_data" wire:model='file_data'>
                        <span>Seleccionar archivo</span>
                    </x-input-file>
                    <x-input-error for="file_data" />
                </div>
                <div class="container mt-4 mb-4">
                    <x-alert-loading-danger class="min-w-full" wire:loading wire:target='file_data'>
                        <x-slot name="title">Archivo Cargando!</x-slot>
                        <x-slot name="subtitle">Espere que su archivo de datos termine de cargar</x-slot>
                    </x-alert-loading-danger>
                    @if ($file_data)
                        <div class="min-w-full">
                            <x-alert-loading-danger class="success-format">
                                <x-slot name="title">Archivo Cargado!</x-slot>
                                <x-slot name="subtitle">carga de archivo finalizada</x-slot>
                            </x-alert-loading-danger>
                        </div>
                    @endif
                </div>
            @endif

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class="mr-2" wire:click="closeModal()">
                Cancelar
            </x-secondary-button>

            <x-primary-button wire:click="save" onclick="spinner()" wire:loading.attr='disabled' wire:target="save , file_data"
                class="bg-blue-500 disabled:opacity-25">
                <span wire:loading.remove wire:target="save">{{ $file ? 'actualizar' : 'Crear' }}</span>
                <span wire:loading wire:loading.disabled wire:target="save">Guardando...</span>
            </x-primary-button>
        </x-slot>
        
    </x-dialog-modal>
    <script>
        function spinner() {
            $('.spinner').addClass('loading-spinner');
            $('.loading-overlay').removeClass('hidden');
            $('.spinner').addClass('flex');
            $('.loading-overlay').addClass('flex');
        }
    </script>
</div>
