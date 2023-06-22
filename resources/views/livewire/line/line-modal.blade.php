<div>
    <x-button class="bg-green-600" wire:click="$set('open',true)">Nueva</x-button>

    <x-dialog-modal id="LineModal" wire:model='open'>
        <x-slot name="title">
            <div class="container">
                Nueva Linea de Investigación
                <span wire:click='closeModal' class="float-right text-gray-500 text-2xl cursor-pointer">&times;</span>
                <!-- Botón de cierre -->
            </div>
        </x-slot>
        <x-slot name="content">

            <div class="container mt-4 mb-4">
                <x-alert-loading-danger wire:loading wire:target='file'>
                    <x-slot name="title">Imagen Cargando!</x-slot>
                    <x-slot name="subtitle">Espere que la imagen termine de cargar</x-slot>
                </x-alert-loading-danger>
                @if ($file)
                    <div class="min-w-full">
                        <img id="picture" src="{{ $file->temporaryUrl() }}" alt="">
                    </div>
                @endif
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Nombre" />
                <x-input wire:model='name' wire:keydown="generateSlug()" type="text" class="w-full" />
                <x-input-error for="name" />
            </div>
            <div class="container mt-4">
                <x-label class="mb-4" value="Descripción" />
                <div {{--wire:ignore--}} class="mb-4">
                    <textarea wire:model.defer='description' id="description" class="w-full form-control" cols="30" rows="6"></textarea>
                </div>
                <x-input-error for="description" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Estado de publicación" />
                <x-radio-group class="inline inline-flex">
                    <x-label for="No Publicado" class="mr-2" value="No Publicado" />
                    <x-input id="No Publicado" wire:model.def='status' type="radio" class="form-radio mr-2"
                        name="opcion" value="1" :checked="$status === 1" />
                    <x-label for="Publicado" class="mr-2" value="Publicado" />
                    <x-input id="Publicado" wire:model='status' type="radio" class="form-radio mr-2" name="opcion"
                        value="2" :checked="$status === 2" />
                </x-radio-group>
                <x-input-error for="status" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Imagen del proyecto" />
                <x-input-file id="file" wire:model='file'>
                    <span>Seleccionar archivo</span>
                </x-input-file>
                <x-input-error for="file" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="URL de la pagina" />
                <x-input readonly wire:model.defer='slug' type="text" class="w-full" />
                <x-input-error for="slug" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class="mr-2" wire:click="closeModal()">
                Cancelar
            </x-secondary-button>
            <x-primary-button wire:click="save()" wire:loading.attr='disabled' wire:target="save,file"
                class="bg-blue-500 disabled:opacity-25">
                Crear
            </x-primary-button>
        </x-slot>
    </x-dialog-modal>

    @push('js')
        <script>
            // ClassicEditor
            //     .create(document.querySelector('#description'))
            //     .then((editor)=>{
            //         editor.model.document.on('change:data',()=>{
            //             @this.set('description',editor.getData());
            //         });
            //         Livewire.on('resetCKeditor',()=>{
            //             editor.setData('');
            //         });

            //     })
            //     .catch(error => {
            //         console.error(error);
            //     });
        </script>
    @endpush
</div>
