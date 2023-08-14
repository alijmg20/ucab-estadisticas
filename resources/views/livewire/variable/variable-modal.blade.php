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
                <x-label class="mb-4" value="Nombre de la variable" />
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
            <div class="container mt-4">
                <x-label class="mb-4" for="graphic_type" value="Selecciona un gráfico" />
                <x-select-dropdown class="w-full" wire:model.def='graphic_type'>
                    <option value="">selecciona una opción</option>
                    @foreach ($graphicList as $graphic)
                        <option value="{{ $graphic}}">{{ $graphic }}</option>
                    @endforeach
                </x-select-dropdown>
                <x-input-error for="graphic_type" class="mt-2" />
            </div>
            <div class="container mt-4">
                <x-label class="mb-4" value="Valores de la variable" />
                @if($variable_id)
                    @livewire('frequency.frequency-controller', ['variable' => $variable_id])
                @endif
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
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('frequencyAlert', (title, message) => {
                alert(title, message)
            });
            Livewire.on('frequencyDelete', (frequency) => {
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
                        Livewire.emitTo("frequency.frequency-controller", "delete", frequency);
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
