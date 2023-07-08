<div>
    <x-dialog-modal maxWidth="8xl" id="GraphicDetailsModal" wire:model='open'>
        <x-slot name="title">
            <div class="">
                {!! $variable ? '<b>' . $variable->name . '</b>' : '' !!}
                <span wire:click='closeModal()' class="float-right text-gray-500 text-2xl cursor-pointer">&times;</span>
                <!-- Botón de cierre -->
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 font-mono text-sm text-center font-bold leading-6 rounded-lg">
                    <div class="p-4 rounded-lg shadow-lg bg-white dark:text-gray-400 dark:bg-gray-800">
                        <div class="flex-none widget-header">
                            <div class="caption">
                              <p style="text-align:center"><strong>Valor máximo obtenido {{key($max)}}</strong></p>
                            </div>
                          </div>
                        <div style="height:195.27045593261718px;" class="dark:text-gray-400 dark:bg-gray-800 widget-body flex-auto h-full w-full flex flex-col justify-center overflow-hidden">
                            <div style="font-size: 160px" class="dark:text-gray-400 dark:bg-gray-800">  {{reset($max)}}</div>
                        </div>
                    </div>               
                    <div class="p-4 rounded-lg shadow-lg bg-white dark:text-gray-400 dark:bg-gray-800">
                        <div class="flex-none widget-header">
                            <div class="caption">
                              <p style="text-align:center"><strong>Valor minimo obtenido {{key($min)}}</strong></p>
                            </div>
                          </div>
                        <div style="height:195.27045593261718px;" class="dark:text-gray-400 dark:bg-gray-800 widget-body flex-auto w-full flex flex-col justify-center overflow-hidden">
                            <div style="font-size: 160px" class="dark:text-gray-400 dark:bg-gray-800">  {{reset($min)}}</div>
                        </div>
                    </div>     
                    <div class="p-4 rounded-lg shadow-lg bg-white dark:text-gray-400 dark:bg-gray-800">03</div>
                    <div class="p-4 rounded-lg shadow-lg bg-white dark:text-gray-400 dark:bg-gray-800">04</div>
                </div>
                {{-- {{$variable ? $variable : ''}} --}}
                {{-- {{ var_Export($max) }}
                {{ var_Export($min) }} --}}
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-primary-button wire:click="closeModal()" class="bg-blue-500 disabled:opacity-25">
                <span>cerrar</span>
            </x-primary-button>
        </x-slot>
    </x-dialog-modal>

</div>
