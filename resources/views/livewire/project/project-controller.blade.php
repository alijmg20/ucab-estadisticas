<div wire:init='loadProject'>
    <div class="container mx-auto px-8 sm:px-8">
        <h1 class="mt-4 text-3xl text-left dark:text-gray-400">
            Lista de Proyectos
        </h1>
    </div>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="grid gap-6 mb-8 md:grid-cols-4 xl:grid-cols-4">
                    <!-- Card -->
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                        <div class="p-3 mr-4 rounded-full">
                            <i class="rounded-full text-center text-orange-500 fas fa-exclamation"></i>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                Total de Proyectos asociados
                            </p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                @if ($totalProjects)
                                    {{ $totalProjects['totalProjects'] }} Proyectos
                                @endif
                            </p>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                        <div class="p-3 mr-4 rounded-full">
                            <i class="rounded-full text-center text-indigo-500 fas fa-star"></i>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                Proyectos finalizados
                            </p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                @if ($totalProjects)
                                    {{ $totalProjects['totalProjectsEnd'] }} Proyectos
                                @endif
                            </p>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                        <div class="p-3 mr-4 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <i class="rounded-full text-center text-green-500 fas fa-project-diagram"></i>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                Proyectos Publicados
                            </p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                @if ($totalProjects)
                                    {{ $totalProjects['totalProjectsPublished'] }} Proyectos
                                @endif
                            </p>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                        <div class="p-3 mr-4 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <i class="rounded-full text-center text-indigo-500 fas fa-tasks"></i>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                Proyectos en progreso
                            </p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                @if ($totalProjects)
                                    {{ $totalProjects['totalProjectsProgress'] }} Proyectos
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="inline-block w-full shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 flex flex-items-center">
                        <div class="flex items-center">
                            <span class="mr-2 text-gray-700 dark:text-gray-400">Mostrar</span>
                            <x-select-dropdown class="mx-2" wire:model.def='cant'>
                                @foreach ($entrys as $entry)
                                    <option value="{{ $entry }}">{{ $entry }}</option>
                                @endforeach
                            </x-select-dropdown>
                            <span class="ml-2 mr-2 text-gray-700 dark:text-gray-400">Entradas</span>
                        </div>
                        <x-input placeholder="Buscar" class="flex-1 mr-4" type="text" wire:model='search'></x-input>
                        @if (Gate::allows('admin.projects.create') && Gate::allows('admin.projects.edit'))
                            @livewire('project.project-modal')
                        @endif
                    </div>

                    <x-table>
                        <x-slot name="headers">
                            <th class="cursor-pointer px-4 py-3" wire:click='order("id")'>
                                ID
                                {{-- SORT --}}
                                @if ($sort == 'id')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif
                            </th>
                            <th class="cursor-pointer px-4 py-3" wire:click='order("name")'>
                                Nombre
                                {{-- SORT --}}
                                @if ($sort == 'name')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif
                            </th>
                            <th class="cursor-pointer px-4 py-3" wire:click='order("status")'>
                                estado
                                {{-- SORT --}}
                                @if ($sort == 'status')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif
                            </th>
                            <th class="cursor-pointer px-4 py-3" wire:click='order("created_at")'>
                                Fecha de creación
                                {{-- SORT --}}
                                @if ($sort == 'created_at')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif
                            </th>
                            <th class="px-4 py-3">
                                Acciones
                            </th>
                        </x-slot>
                        <x-slot name="body">
                            @if ($projects && count($projects) == 0)
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">
                                        <div class="container mt-4 mb-4">
                                            <x-alert-loading-danger>
                                                <x-slot name="title">¡No existen proyectos a los que esté
                                                    asociado!</x-slot>
                                                <x-slot name="subtitle">Puede crear nuevos proyectos en el botón
                                                    <b>NUEVA</b>
                                                </x-slot>
                                            </x-alert-loading-danger>
                                        </div>
                                    </td>
                                </tr>
                            @elseif ($projects && count($projects))
                                @foreach ($projects as $proj)
                                    <tr
                                        class="text-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <td class="cursor-pointer px-6 py-3 text-sm">
                                            <a href="{{ route('admin.files.show', $proj) }}">
                                                {{ $proj->id }}
                                            </a>
                                        </td>
                                        <td class="cursor-pointer px-4 py-3">
                                            <a class="title-project" href="{{ route('admin.files.show', $proj) }}">
                                                {{ $proj->name }}
                                            </a>
                                        </td>
                                        <td class="cursor-pointer px-4 py-3 text-sm">
                                            <a href="{{ route('admin.files.show', $proj) }}">
                                                {{ $proj->status == 1 ? 'No Publicado' : 'Publicado' }}
                                            </a>
                                        </td>
                                        <td class=" cursor-pointer px-6 py-3 text-sm">
                                            <a href="{{ route('admin.files.show', $proj) }}">
                                                {{ $proj->created_at }}
                                            </a>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-4 text-sm">
                                                @can('admin.projects.edit')
                                                    <button
                                                        wire:click='$emitTo("project.project-modal","edit",{{ $proj->id }})'
                                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                        aria-label="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>
                                                @endcan
                                                @can('admin.projects.destroy')
                                                    <button wire:click='$emit("projectDelete",{{ $proj->id }})'
                                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                        aria-label="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">
                                        <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
                                            role="status">
                                            <span
                                                class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </x-slot>
                    </x-table>
                    @if ($projects && count($projects) && $projects->hasPages())
                        <div class="px-6 py-3">
                            {{ $projects->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('projectAlert', (title, message) => {
                alert(title, message)
            });
            Livewire.on('projectDelete', (variable) => {
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
                        Livewire.emitTo("project.project-controller", "delete", variable);
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
