<div>

    <x-button class="bg-green-600" wire:click="openModal">Nueva</x-button>

    <x-dialog-modal id="AttachmentModal" wire:model='open'>
        <x-slot name="title">
            <div class="container">
               {{$attachment ?  'Editar archivo adjunto' : 'Nuevo archivo adjunto'}}
                <span wire:click='closeModal' class="float-right text-gray-500 text-2xl cursor-pointer">&times;</span>
                <!-- Botón de cierre -->
            </div>
        </x-slot>

        <x-slot name="content">

            <div class="container mt-4">
                <x-label class="mb-4" value="Nombre" />
                <x-input id="name" wire:model='name' type="text" class="w-full" />
                <x-input-error for="name" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Estatus del archivo adjunto" />
                <div>
                <input 
                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                 type="checkbox" 
                name="status"
                wire:model="status" 
               @if($status == true ) checked @endif
               />
               <span class="ml-2">@if($status == true ) Publicado @else No publicado @endif</span>
                </div>
                <x-input-error for="status" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="archivo adjunto" />
                <x-input-file id="file_attachment" wire:model='file_attachment'>
                    <span>Seleccionar archivo</span>
                </x-input-file>
                <x-input-error for="file_attachment" />
            </div>
            <div class="container mt-4 mb-4">
                <x-alert-loading-danger class="min-w-full" wire:loading wire:target='file_attachment'>
                    <x-slot name="title">Archivo Cargando!</x-slot>
                    <x-slot name="subtitle">Espere que su archivo de datos termine de cargar</x-slot>
                </x-alert-loading-danger>
                @if ($file_attachment)
                    <div class="min-w-full">
                        <x-alert-loading-danger class="success-format">
                            <x-slot name="title">Archivo Cargado!</x-slot>
                            <x-slot name="subtitle">carga de archivo finalizada</x-slot>
                        </x-alert-loading-danger>
                    </div>
                @endif
            </div>
            {{-- <div>file_attachment {{var_Export($file_attachment)}}</div> --}}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class="mr-2" wire:click="closeModal()">
                Cancelar
            </x-secondary-button>
            <x-primary-button wire:click="save()" wire:loading.attr='disabled' wire:target="save,file_attachment"
                class="bg-blue-500 disabled:opacity-25">
                {{$attachment ?  'actualizar' : 'Crear'}}
            </x-primary-button>
        </x-slot>
    </x-dialog-modal>

</div>
