<div>
    <div class="gaphicOptions px-6 py-4 flex flex-items-center">
        <div class="flex items-center w-full">
            <span class="mr-2 text-gray-700 dark:text-gray-400">Opciones:
            </span>
            @if ($correlation)
                <x-button wire:click='edit()' wire:loading.attr='disabled' wire:target="edit"
                    class="ml-2 bg-yellow-500 disabled:opacity-25">
                    editar
                </x-button>
                <x-button wire:click='delete()' wire:loading.attr='disabled' wire:target="delete"
                    class="ml-2 bg-red-600 disabled:opacity-25">
                    eliminar
                </x-button>
            @endif
        </div>
    </div>
</div>
