<div>

    {{-- <x-button class="bg-green-600" wire:click="openModal">Nueva</x-button> --}}

    <x-dialog-modal id="emailModal" wire:model='open'>
        <x-slot name="title">
            <div class="container">
               {{'Ver Mensaje'}}
                <span wire:click='closeModal' class="float-right text-gray-500 text-2xl cursor-pointer">&times;</span>
                <!-- Botón de cierre -->
            </div>
        </x-slot>

        <x-slot name="content">

            <div class="container mt-4">
                <x-label class="mb-4" value="Remitente" />
                <x-input readonly id="name" wire:model='name' type="text" class="w-full" />
                <x-input-error for="name" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Correo electronico" />
                <x-input readonly id="email" wire:model='email' type="email" class="w-full" />
                <x-input-error for="email" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Asunto" />
                <x-input readonly id="subject" wire:model='subject' type="text" class="w-full" />
                <x-input-error for="subject" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Estatus de mensaje" />
                <div>
                <input 
                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                 type="checkbox" 
                name="status"
                wire:model="status" 
               @if($status == true ) checked @endif
               />
               <span class="ml-2">@if($status == true ) Leído @else No leído @endif</span>
                </div>
                <x-input-error for="status" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Mensaje" />
                <div class="mb-4">
                    <textarea readonly wire:model.defer='message' id="message" class="w-full form-control" cols="30" rows="6"></textarea>
                </div>
                <x-input-error for="message" />
            </div>

            
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class="mr-2" wire:click="closeModal()">
                Cancelar
            </x-secondary-button>
            <x-primary-button wire:click="save()" wire:loading.attr='disabled' wire:target="save"
                class="bg-blue-500 disabled:opacity-25">
                {{'actualizar'}}
            </x-primary-button>
        </x-slot>
    </x-dialog-modal>

</div>
