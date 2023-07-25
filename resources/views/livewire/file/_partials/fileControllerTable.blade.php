<h2 class="mt-4 text-xl text-left dark:text-gray-400">
    Bases de datos en Excel
</h2>
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
            @livewire('file.file-modal', ['project' => $project])
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
                @if ($files && count($files) == 0)
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center">
                        <div class="container mt-4 mb-4">
                            <x-alert-loading-danger>
                                <x-slot name="title">¡No existen archivos del proyecto!</x-slot>
                                <x-slot name="subtitle">Agregue nuevos archivos en el botón <b>NUEVA</b>
                                </x-slot>
                            </x-alert-loading-danger>
                        </div>
                    </td>
                </tr>
                @elseif ($files && count($files))
                @foreach ($files as $fil)
                <tr class="cursor-pointer text-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600">

                    <td class="px-6 py-3 text-sm">
                        <a href="{{ route('admin.files.showfile', $fil) }}">
                            {{ $fil->id }}
                        </a>
                    </td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.files.showfile', $fil) }}">
                            {{ $fil->name }}
                        </a>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <a href="{{ route('admin.files.showfile', $fil) }}">
                            {{ $fil->status == 1 ? 'No Publicado' : 'Publicado' }}
                        </a>
                    </td>
                    <td class="px-6 py-3 text-sm">
                        <a href="{{ route('admin.files.showfile', $fil) }}">
                            {{ $fil->created_at }}
                        </a>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                            <a href="{{ route('admin.files.showfile', $fil) }}" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="View">
                                <i class="far fa-eye"></i>
                            </a>
                            <button wire:click='$emitTo("file.file-modal","edit",{{ $fil->id }})' class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button wire:click='$emit("fileDelete",{{ $fil->id }})' class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center">
                        <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
                            <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
                        </div>
                    </td>
                </tr>
                @endif
            </x-slot>
        </x-table>
        @if ($files && count($files) && $files->hasPages())
        <div class="px-6 py-3">
            {{ $files->links() }}
        </div>
        @endif
    </div>
</div>