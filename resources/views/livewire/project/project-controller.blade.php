<div wire:init='loadProject'>
    <div class="container mx-auto px-8 sm:px-8">
        <h1 class="mt-4 text-3xl text-left dark:text-gray-400">
            Lista de Proyectos
        </h1>
    </div>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
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
                        @livewire('project.project-modal')
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
                                                <x-slot name="title">¡No existen proyectos a los que esté asociado!</x-slot>
                                                <x-slot name="subtitle">Puede crear nuevos proyectos en el botón <b>NUEVA</b>
                                                </x-slot>
                                            </x-alert-loading-danger>
                                        </div>
                                    </td>
                                </tr>
                            @elseif ($projects && count($projects))
                                @foreach ($projects as $proj)
                                    <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <td class="cursor-pointer px-6 py-3 text-sm">
                                            <a  href="{{route('admin.files.show',$proj)}}">
                                            {{ $proj->id }}
                                            </a>
                                        </td>
                                        <td class="cursor-pointer px-4 py-3" >
                                            <a  href="{{route('admin.files.show',$proj)}}">
                                            {{ $proj->name }}
                                            </a>
                                        </td>
                                        <td class="cursor-pointer px-4 py-3 text-sm" >
                                            <a  href="{{route('admin.files.show',$proj)}}">
                                            {{ $proj->status == 1 ? 'No Publicado' : 'Publicado' }}
                                            </a>
                                        </td>
                                        <td class=" cursor-pointer px-6 py-3 text-sm" >
                                            <a  href="{{route('admin.files.show',$proj)}}">
                                            {{ $proj->created_at }}
                                            </a>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-4 text-sm">
                                                <a href="{{route('admin.files.show',$proj)}}"
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                    aria-label="View">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <button wire:click='edit({{ $proj->id }})'
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                    aria-label="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                <button wire:click='$emit("projectDelete",{{ $proj->id }})'
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                    aria-label="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
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

    <x-dialog-modal id="ProjectModalEdit" wire:model='open_edit'>
        <x-slot name="title">
            <div class="container">
                Editar Proyecto
                <span wire:click='closeModal' class="float-right text-gray-500 text-2xl cursor-pointer">&times;</span>
                <!-- Botón de cierre -->
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="container mt-4 mb-4">
                <x-alert-loading-danger class="mb-4" wire:loading wire:target='file'>
                    <x-slot name="title">Imagen Cargando!</x-slot>
                    <x-slot name="subtitle">Espere que la imagen termine de cargar</x-slot>
                </x-alert-loading-danger>
                @if ($file)
                    <div class="min-w-full">
                        <img id="picture" src="{{ $file->temporaryUrl() }}" alt="">
                    </div>
                @elseif(optional($project->image)->url)
                    <div class="min-w-full">
                        <img id="picture" src="{{ App\Helpers\Tools::StorageUrl($project->image->url) }}"
                            alt="">
                    </div>
                @endif
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Nombre del proyecto" />
                <x-input id="name" wire:model='project.name' wire:keydown="generateSlug()" type="text"
                    class="w-full" />
                <x-input-error for="name" />
            </div>
            <div class="container mt-4">
                <x-label class="mb-4" value="Descripción del proyecto" />
                <textarea wire:model.defer='project.description' class="w-full form-control" cols="30" rows="6"></textarea>
                <x-input-error for="description" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Estado de publicación" />
                <x-radio-group class="inline inline-flex">
                    <x-label for="No Publicado" class="mr-2" value="No Publicado" />
                    <x-input id="No Publicado" wire:model.def='project.status' type="radio"
                        class="form-radio mr-2" name="opcion" value="1" :checked="$project->status === 1" />
                    <x-label for="Publicado" class="mr-2" value="Publicado" />
                    <x-input id="Publicado" wire:model='project.status' type="radio" class="form-radio mr-2"
                        name="opcion" value="2" :checked="$project->status === 2" />
                </x-radio-group>
                <x-input-error for="status" />
            </div>
            <div class="container mt-4">
                <x-label class="mb-4" for="line_id" value="Selecciona una linea de investigación" />
                <x-select-dropdown class="w-full" wire:model.def='project.line_id'>
                    <option value="">selecciona una opción</option>
                    @foreach ($lines as $line)
                        <option value="{{ $line->id }}">{{ $line->name }}</option>
                    @endforeach
                </x-select-dropdown>
                <x-input-error for="line_id" class="mt-2" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Imagen del proyecto" />
                <x-input-file id="file_edit" wire:model='file'>
                    <span>Seleccionar archivo</span>
                </x-input-file>
                <x-input-error for="file-{{ $project->id }}" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Equipo de proyecto" />
                <div class="px-6 py-4 flex flex-items-center">
                    <x-input placeholder="Buscar" class="flex-1 mr-4" type="text" wire:model='searchUserEdit'>
                    </x-input>
                </div>
                <x-table>
                    <x-slot name="headers">
                        <th class="px-4 py-3">
                            ID
                        </th>
                        <th class="px-4 py-3">
                            Nombre
                        </th>
                        <th class="px-4 py-3">
                            Selección
                        </th>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($users as $key => $user)
                            @if ($user->id != $user_id)
                                <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <td class="px-6 py-3 text-sm">
                                        {{ $user->id }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-3 text-sm">
                                        <input
                                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                            type="checkbox" name="users_id[]" wire:model="users_id"
                                            value="{{ $user->id }}"
                                            @if (in_array((int) $user->id, $users_id)) checked @endif />
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </x-slot>
                </x-table>
                @if ($users->hasPages())
                    <div class="mt-4 px-6 py-3">
                        {{ $users->links() }}
                    </div>
                @endif
                <x-input-error for="users" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="URL de la pagina" />
                <x-input readonly id="slug" wire:model='project.slug' type="text" class="w-full" />
                <x-input-error for="project.slug" />
            </div>


        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class="mr-2" wire:click="closeModal()">
                Cancelar
            </x-secondary-button>
            <x-primary-button wire:click="update()" wire:loading.attr='disabled' wire:target="update,file"
                class="bg-blue-500 disabled:opacity-25">
                Actualizar
            </x-primary-button>
        </x-slot>
    </x-dialog-modal>

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
