<div>

    <x-dialog-modal id="ShareModal" wire:model='open'>
        <x-slot name="title">
            <div class="container">
                {{ 'Compartir Enlace' }}
                <span wire:click='closeModal' class="float-right text-gray-500 text-2xl cursor-pointer">&times;</span>
                <!-- Botón de cierre -->
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="container mt-4">
                <x-input id="share" wire:model='share' type="text" class="w-full" />     
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class="mr-2" wire:click="closeModal()">
                Cancelar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

</div>
