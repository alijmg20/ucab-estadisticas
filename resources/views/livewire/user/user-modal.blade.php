<div>

    <x-button class="bg-green-600" wire:click="openModal">Nueva</x-button>

    <x-dialog-modal id="UserModal" wire:model='open'>
        <x-slot name="title">
            <div class="container">
               {{$user ?  'Editar Usuario' : 'Nuevo Usuario'}}
                <span wire:click='closeModal' class="float-right text-gray-500 text-2xl cursor-pointer">&times;</span>
                <!-- Botón de cierre -->
            </div>
        </x-slot>

        <x-slot name="content">

            <div class="container mt-4">
                <x-label class="mb-4" value="Nombre del usuario" />
                <x-input id="name" wire:model='name' type="text" class="w-full" />
                <x-input-error for="name" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Correo electronico" />
                <x-input id="email" wire:model='email' type="email" class="w-full" />
                <x-input-error for="email" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Contraseña" />
                <x-input id="password" wire:model='password' type="password" class="w-full" />
                <x-input-error for="password" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Confirmación de contraseñas" />
                <x-input id="password_confirmation" wire:model='password_confirmation' type="password" class="w-full" />
                <x-input-error for="password_confirmation" />
            </div>

            <div class="container mt-4">
                <x-label class="mb-4" value="Roles de usuario" />
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
                        @foreach ($roles as $key => $role)
                                <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <td class="px-6 py-3 text-sm">
                                        {{ $role->id }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $role->name }}
                                    </td>
                                    <td class="px-6 py-3 text-sm">
                                        <x-checkbox wire:model="roles_id" value="{{ $role->id }}" />
                                    </td>
                                </tr>
                        @endforeach
                    </x-slot>
                </x-table>
                @if (count($roles) && $roles->hasPages())
                    <div class="mt-4 px-6 py-3">
                        {{ $roles->links() }}
                    </div>
                @endif
                <x-input-error for="roles" />
            </div>
            {{-- <div>roles_id {{var_Export($roles_id)}}</div> --}}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class="mr-2" wire:click="closeModal()">
                Cancelar
            </x-secondary-button>
            @if ($user)
            <x-primary-button wire:click='update()' wire:loading.attr='disabled' wire:target="update"
                class="bg-blue-500 disabled:opacity-25">
                actualizar
            </x-primary-button>
            '@else
            <x-primary-button wire:click='save()' wire:loading.attr='disabled' wire:target="save"
                class="bg-blue-500 disabled:opacity-25">
                Crear
            </x-primary-button>
            @endif
        </x-slot>
    </x-dialog-modal>

</div>
