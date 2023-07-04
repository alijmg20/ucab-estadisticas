<div>
    <x-dialog-modal id="GraphicDetailsModal" wire:model='open'>
        <x-slot name="title">
            <div class="container">
                {!! $variable ? '<b>' . $variable->name . '</b>' : '' !!}
                <span wire:click='closeModal()' class="float-right text-gray-500 text-2xl cursor-pointer">&times;</span>
                <!-- Botón de cierre -->
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="container mt-4">
                <div class="
                grid grid-cols-2 gap-4 font-mono text-sm text-center font-bold leading-6 rounded-lg
                ">
                    <div class="p-4 rounded-lg shadow-lg bg-fuchsia-500">01</div>
                    <div class="p-4 rounded-lg shadow-lg bg-fuchsia-500">02</div>
                    <div class="p-4 rounded-lg shadow-lg bg-fuchsia-500">03</div>
                    <div class="p-4 rounded-lg shadow-lg bg-fuchsia-500">04</div>
                </div>
                {{$variable ? $variable : ''}}
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-primary-button wire:click="closeModal()" class="bg-blue-500 disabled:opacity-25">
                <span>cerrar</span>
            </x-primary-button>
        </x-slot>
    </x-dialog-modal>

</div>
