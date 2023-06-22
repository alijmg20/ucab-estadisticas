<div>
    <x-dialog-modal id="VariableModal" wire:model='open'>
        <x-slot name="title">
            <div class="container">
                {{'Editar Variable'}}
                <span wire:click='closeModal()' class="float-right text-gray-500 text-2xl cursor-pointer">&times;</span>
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
                 type="checkbox" 
                name="status"
                wire:model="status" 
               @if($status == true ) checked @endif
               />
               <span class="ml-2">@if($status == true ) Publicado @else No Publicado @endif</span>
                </div>
                {{-- {{$status}} --}}
                <x-input-error for="status" />
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
