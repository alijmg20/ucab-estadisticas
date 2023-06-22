<div>

    <x-button class="bg-green-600" wire:click="openModal">Nueva</x-button>

    <x-dialog-modal id="RoletModal" wire:model='open'>
        <x-slot name="title">
            <div class="container">
               {{$role ?  'Editar Rol de usuario' : 'Nuevo Rol de usuario'}}
                <span wire:click='closeModal' class="float-right text-gray-500 text-2xl cursor-pointer">&times;</span>
                <!-- Botón de cierre -->
            </div>
        </x-slot>

        <x-slot name="content">

            <div class="container mt-4">
                <x-label class="mb-4" value="Nombre del Rol" />
                <x-input id="name" wire:model='name' type="text" class="w-full" />
                <x-input-error for="name" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Permisos de usuario" />
                <div class="px-6 py-4 flex flex-items-center">
                    <x-input placeholder="Buscar" class="flex-1 mr-4" type="text" wire:model='searchRole'></x-input>
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
                        @foreach ($permissions as $key => $permission)
                                <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <td class="px-6 py-3 text-sm">
                                        {{ $permission->id }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $permission->description }}
                                    </td>
                                    <td class="px-6 py-3 text-sm">
                                        <x-checkbox wire:model="permissions_id" value="{{ $permission->id }}" />
                                    </td>
                                </tr>
                        @endforeach
                    </x-slot>
                </x-table>
                @if (count($permissions) && $permissions->hasPages())
                    <div class="mt-4 px-6 py-3">
                        {{ $permissions->links() }}
                    </div>
                @endif
                <x-input-error for="permissions" />
            </div>
            {{-- <div>permissions_id {{var_Export($permissions_id)}}</div> --}}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class="mr-2" wire:click="closeModal()">
                Cancelar
            </x-secondary-button>
            <x-primary-button wire:click="save()" wire:loading.attr='disabled' wire:target="save"
                class="bg-blue-500 disabled:opacity-25">
                {{$role ?  'actualizar' : 'Crear'}}
            </x-primary-button>
        </x-slot>
    </x-dialog-modal>

</div>
