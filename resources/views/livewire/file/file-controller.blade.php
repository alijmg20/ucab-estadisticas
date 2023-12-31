<div wire:init='loadProjectFiles'>
    <div class="container mx-auto px-8 sm:px-8">
        <h1 class="mt-4 mb-4 text-3xl text-left dark:text-gray-400">
            Proyecto #{{ $project->id }} {{ $project->name }}
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
                    href="#">Información</a>
            </li>
            {{-- <li wire:click="$set('content',2)" class="w-full">
                <a x-on:click.prevent="activeTab = 2"
                    :class="{
                        'inline-block w-full p-4 text-gray-900 bg-gray-100 rounded-l-lg active focus:outline-none dark:bg-gray-700 dark:text-white': activeTab ===
                            2,
                        'inline-block w-full p-4 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700': activeTab !==
                            2
                    }"
                    href="#">Encuestas</a>
            </li> --}}
            <li wire:click="$set('content',3)" class="w-full">
                <a x-on:click.prevent="activeTab = 3"
                    :class="{
                        'inline-block w-full p-4 text-gray-900 bg-gray-100 rounded-l-lg active focus:outline-none dark:bg-gray-700 dark:text-white': activeTab ===
                            3,
                        'inline-block w-full p-4 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700': activeTab !==
                            3
                    }"
                    href="#">Bases de datos</a>
            </li>
            <li wire:click="$set('content',4)" class="w-full">
                <a x-on:click.prevent="activeTab = 4"
                    :class="{
                        'inline-block w-full p-4 text-gray-900 bg-gray-100 rounded-l-lg active focus:outline-none dark:bg-gray-700 dark:text-white': activeTab ===
                            4,
                        'inline-block w-full p-4 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700': activeTab !==
                            4
                    }"
                    href="#">Adjuntos</a>
            </li>
        </ul>

        <div>
            <div x-show="activeTab === 1">
                @livewire('project.project-edit', ['project' => $project->id])
            </div>
            {{-- <div x-show="activeTab === 2">
                @livewire('quiz.quiz-controller', ['project' => $project->id])
            </div> --}}
            <div class="mt-4 mb-4" x-show="activeTab === 3">
                @include('livewire.file._partials.fileControllerTable')
            </div>
            <div class="mt-4 mb-4" x-show="activeTab === 4">
                @livewire('attachment.attachment-controller', ['project' => $project->id])
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('fileAlert', (title, message) => {
                alert(title, message)
            });
            Livewire.on('fileDelete', (variable) => {
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
                        Livewire.emitTo("file.file-controller", "delete", variable);
                        Swal.fire(
                            'Eliminado!',
                            "Se ha sido eliminado.",
                            'success'
                        )
                    }
                })
            });
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
