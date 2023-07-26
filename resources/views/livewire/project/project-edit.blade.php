<div>
    <h2 class="mt-4 text-xl text-left dark:text-gray-400">
        Informacion de proyecto
    </h2>
    <div class="mt-4 mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg transform sm:w-full">
        <div class="px-6 py-4">
            <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
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
                    <x-input id="name" wire:model='name' wire:keydown="generateSlug()" type="text"
                        class="w-full" />
                    <x-input-error for="name" />
                </div>
                <div class="container mt-4">
                    <x-label class="mb-4" value="Descripción del proyecto" />
                    <textarea wire:model.defer='description' class="w-full form-control" cols="30" rows="6"></textarea>
                    <x-input-error for="description" />
                </div>

                <div class="container mt-4">
                    <x-label class="mb-4" value="Estado de publicación" />
                    <x-radio-group class="inline inline-flex">
                        <x-label for="No Publicado" class="mr-2" value="No Publicado" />
                        <x-input id="No Publicado" wire:model.def='status' type="radio" class="form-radio mr-2"
                            name="opcion" value="1" :checked="$status === 1" />
                        <x-label for="Publicado" class="mr-2" value="Publicado" />
                        <x-input id="Publicado" wire:model='status' type="radio" class="form-radio mr-2"
                            name="opcion" value="2" :checked="$status === 2" />
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
                        <x-input placeholder="Buscar" class="flex-1 mr-4" type="text" wire:model='searchUser'>
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

                <div class="container mt-4">
                    <x-label class="mb-4" value="URL de la pagina" />
                    <x-input readonly id="slug" wire:model='slug' type="text" class="w-full" />
                    <x-input-error for="slug" />
                </div>
            </div>
        </div>
        <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 dark:bg-gray-800 text-right">
            <x-primary-button wire:click="save()" wire:loading.attr='disabled' wire:target="save,file"
                class="bg-blue-500 disabled:opacity-25">
                Actualizar
            </x-primary-button>
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