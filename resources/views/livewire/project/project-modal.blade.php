<div>

    <x-button class="bg-green-600" wire:click="openModal">Nueva</x-button>

    <x-dialog-modal id="ProjectModal" wire:model='open'>
        <x-slot name="title">
            <div class="container">
                @if ($project)
                    Editar Proyecto
                @else
                    Nuevo Proyecto
                @endif
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
                @elseif($project && optional($project->image)->url)
                    <div class="min-w-full">
                        <img id="picture" src="{{ App\Helpers\Tools::StorageUrl($project->image->url) }}"
                            alt="">
                    </div>
                @endif
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Nombre del proyecto" />
                <x-input id="name" wire:model='name' wire:keydown="generateSlug()" type="text" class="w-full" />
                <x-input-error for="name" />
            </div>
            <div class="container mt-4">
                <x-label class="mb-4" value="Descripción del proyecto" />
                <textarea wire:model.defer='description' class="w-full form-control" cols="30" rows="6"></textarea>
                <x-input-error for="description" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Fecha de finalización (opcional)" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input type="date" id="date_end" name="date_end" wire:model="date_end"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Select date">
                </div>
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Proyecto finalizado (opcional)" />
                <div>
                    <input
                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        type="checkbox" name="ended" wire:model="ended"
                        @if ($ended == true) checked @endif />
                    <span class="ml-2">
                        @if ($ended == true)
                            Finalizado
                        @else
                            No Finalizado
                        @endif
                    </span>
                </div>
                <x-input-error for="status" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Estado de publicación" />
                <x-radio-group class="inline inline-flex">
                    <x-label for="No Publicado" class="mr-2" value="No Publicado" />
                    <x-input id="No Publicado" wire:model.def='status' type="radio" class="form-radio mr-2"
                        name="opcion" value="1" :checked="$status === 1" />
                    <x-label for="Publicado" class="mr-2" value="Publicado" />
                    <x-input id="Publicado" wire:model='status' type="radio" class="form-radio mr-2" name="opcion"
                        value="2" :checked="$status === 2" />
                </x-radio-group>
                <x-input-error for="status" />
            </div>
            <div class="container mt-4">
                <x-label class="mb-4" for="line_id" value="Selecciona una linea de investigación" />
                <x-select-dropdown class="w-full" wire:model.def='line_id'>
                    <option value="">selecciona una opción</option>
                    @foreach ($lines as $line)
                        <option value="{{ $line->id }}">{{ $line->name }}</option>
                    @endforeach
                </x-select-dropdown>
                <x-input-error for="line_id" class="mt-2" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Imagen del proyecto" />
                <x-input-file id="file" wire:model='file'>
                    <span>Seleccionar archivo</span>
                </x-input-file>
                <x-input-error for="file" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Equipo de proyecto" />
                <div class="px-6 py-4 flex flex-items-center">
                    <x-input placeholder="Buscar" class="flex-1 mr-4" type="text"
                        wire:model='searchUser'></x-input>
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
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-6 py-3 text-sm">
                                        {{ $user->id }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-3 text-sm">
                                        <x-checkbox wire:model="users_id" value="{{ $user->id }}" />
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </x-slot>
                </x-table>
                @if (count($users) && $users->hasPages())
                    <div class="mt-4 px-6 py-3">
                        {{ $users->links() }}
                    </div>
                @endif
                <x-input-error for="users" />
            </div>
            {{-- <div>users_id {{var_Export($users_id)}}</div> --}}
            <div class="container mt-4">
                <x-label class="mb-4" value="URL de la pagina" />
                <x-input readonly id="slug" wire:model='slug' type="text" class="w-full" />
                <x-input-error for="slug" />
            </div>


        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class="mr-2" wire:click="closeModal()">
                Cancelar
            </x-secondary-button>
            @if ($project)
                <x-primary-button wire:click="update()"  wire:loading.attr='disabled' wire:target="update,file"
                    class="bg-blue-500 disabled:opacity-25">
                    Actualizar
                </x-primary-button>
            @else
                <x-primary-button wire:click="save()" wire:loading.attr='disabled' wire:target="save,file"
                    class="bg-blue-500 disabled:opacity-25">
                    Crear
                </x-primary-button>
            @endif
        </x-slot>
    </x-dialog-modal>
</div>
