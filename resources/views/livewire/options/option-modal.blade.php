<div>
    <x-dialog-modal id="OptionModal" wire:model='open'>
        <x-slot name="title">
            <div class="container">
                {{'Editar Opción'}}
                <span wire:click='closeModal()' class="float-right text-gray-500 text-2xl cursor-pointer">&times;</span>
                <!-- Botón de cierre -->
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="container mt-4">
                <x-label class="mb-4" value="Nombre del Opción" />
                <x-input id="name" wire:model='name' type="text" class="w-full" />
                <x-input-error for="name" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class="mr-2" wire:click="closeModal()">
                Cancelar
            </x-secondary-button>
            <x-primary-button wire:click="save()" wire:loading.attr='disabled' wire:target="save"
                class="bg-blue-500 disabled:opacity-25">
                <span wire:loading.remove wire:target="save">{{ 'actualizar'  }}</span>
                <span wire:loading wire:loading.disabled wire:target="save">actualizando...</span>
            </x-primary-button>
        </x-slot>
    </x-dialog-modal>
</div>
