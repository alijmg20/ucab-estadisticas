<div>
    <x-dialog-modal id="GraphicDetailsModal" wire:model='open'>
        <x-slot name="title">
            <div class="container">
                {!! $variable ? 'Ver detalle de <b>'.$variable->name.'</b>' : '' !!}
                <span wire:click='closeModal()' class="float-right text-gray-500 text-2xl cursor-pointer">&times;</span>
                <!-- Botón de cierre -->
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="container mt-4">
                {{$variable ? $variable : ''}}
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-primary-button wire:click="closeModal()"
                class="bg-blue-500 disabled:opacity-25">
                <span>cerrar</span>
            </x-primary-button>
        </x-slot>
    </x-dialog-modal>

</div>
