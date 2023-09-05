<div wire:init='loadfileshow'>
    <div class="pb-4 container mx-auto px-8 sm:px-8 flex items-center">
        
        <h1 class="inline-block w-full flex mt-4 text-3xl text-left dark:text-gray-400 ml-4 mr-4">
            <x-primary-button wire:click='back()' class="bg-blue-500 disabled:opacity-25">
                volver
            </x-primary-button>
            <span class="ml-4">
                Datos de {{ $file->name }}
            </span>
        </h1>
    </div>
    <div x-data="{ activeTab: 1 }" class="container mx-auto px-4 sm:px-8">
        <ul
            class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
            <li wire:click="$set('content',1)" class="w-full">
                <a x-on:click.prevent="activeTab = 1"
                    :class="{
                        'inline-block w-full p-4 text-gray-900 bg-gray-100 rounded-l-lg active focus:outline-none dark:bg-gray-700 dark:text-white': activeTab ===
                            1,
                        'inline-block w-full p-4 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700': activeTab !==
                            1
                    }"
                    href="#">Variables</a>
            </li>
            <li wire:click="$set('content',2)" class="w-full">
                <a x-on:click.prevent="activeTab = 2"
                    :class="{
                        'inline-block w-full p-4 text-gray-900 bg-gray-100 rounded-l-lg active focus:outline-none dark:bg-gray-700 dark:text-white': activeTab ===
                            2,
                        'inline-block w-full p-4 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700': activeTab !==
                            2
                    }"
                    href="#">General</a>
            </li>
            {{-- <li wire:click="$set('content',3)" class="w-full">
                <a x-on:click.prevent="activeTab = 3"
                    :class="{
                        'inline-block w-full p-4 text-gray-900 bg-gray-100 rounded-l-lg active focus:outline-none dark:bg-gray-700 dark:text-white': activeTab ===
                            3,
                        'inline-block w-full p-4 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700': activeTab !==
                            3
                    }"
                    href="#">Detalles</a>
            </li> --}}
        </ul>

        <div>
            <div class="mt-4 mb-4" x-show="activeTab === 1"> 
                @livewire('variable.variable-controller', ['file' => $file])
            </div>
            <div class="mt-4 mb-4" x-show="activeTab === 2"> @livewire('graphics.graphic-controller', ['file' => $file])  </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('variableAlert', (title, message) => {
                alert(title, message)
            });
            Livewire.on('variableDelete', (variable) => {
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
                        Livewire.emitTo("variable.variable-controller", "delete", variable);
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
