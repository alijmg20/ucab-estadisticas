<div>

    <x-button class="bg-green-600" wire:click="openModal">Nueva</x-button>

    <x-dialog-modal id="CarruselModal" wire:model='open'>
        <x-slot name="title">
            <div class="container">
               {{$carrusel ?  'Editar Slider' : 'Nuevo Slider'}}
                <span wire:click='closeModal' class="float-right text-gray-500 text-2xl cursor-pointer">&times;</span>
                <!-- Botón de cierre -->
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="container mt-4 mb-4">
                <x-alert-loading-danger class="mb-4" wire:loading wire:target='file'>
                    <x-slot name="title">Imagen Cargando!</x-slot>
                    <x-slot name="subtitle">Espere que la imagen termine de cargar</x-slot>
                </x-alert-loading-danger>
                @if ($file)
                    <div class="min-w-full">
                        <img id="picture" src="{{ $file->temporaryUrl() }}" alt="">
                    </div>
                @elseif(optional($carrusel)->url)
                    <div class="min-w-full">
                        <img id="picture" src="{{ App\Helpers\Tools::StorageUrl($carrusel->url) }}"
                            alt="{{$carrusel->alt}}">
                    </div>
                @endif
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Leyenda de la imagen" />
                <x-input id="alt" wire:model='alt' type="text" class="w-full" />
                <x-input-error for="alt" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Imagen para el carrusel" />
                <x-input-file id="file" wire:model='file'>
                    <span>Seleccionar archivo</span>
                </x-input-file>
                <x-input-error for="file" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class="mr-2" wire:click="closeModal()">
                Cancelar
            </x-secondary-button>
            <x-primary-button wire:click="save()" wire:loading.attr='disabled' wire:target="save,file"
                class="bg-blue-500 disabled:opacity-25">
                {{$carrusel ?  'actualizar' : 'Crear'}}
            </x-primary-button>
        </x-slot>
    </x-dialog-modal>

</div>
