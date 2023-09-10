<div>
    <div
        class="border border-gray-300 mb-6 mt-4 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
        <div class="dark:text-gray-400 px-6 py-4 text-left text-xl w-full dark:bg-gray-800" ><span>@if ($correlation) {{$correlation->name}} @endif<span></div>
        <div class="inline-block w-full">
            <div class="gaphicOptions px-6 py-4 flex flex-items-center">
                <div class="flex items-center w-full">
                    <span class="mr-2 text-gray-700 dark:text-gray-400">Opciones:
                    </span>
                    @if ($correlation)
                    <x-button wire:click='edit()' class="ml-2 bg-yellow-500 disabled:opacity-25">
                        editar
                    </x-button>
                    <x-button wire:click='delete()' class="ml-2 bg-red-600 disabled:opacity-25">
                        eliminar
                    </x-button>
                    @endif
                </div>
            </div>
            @if ($correlation)
            <div>
                <div class="text-center mb-4 w-full dark:bg-gray-800 dark:text-gray-400">Filas: {{ $variable1->name }}</div>
                <div class="text-center mb-4 w-full dark:bg-gray-800 dark:text-gray-400">Columnas: {{ $variable2->name }}</div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                            <tr>
                                <th scope="col" class="w-auto px-6 py-3">
                                    filas \ columnas
                                </th>
                                @foreach ($variable2->data()->distinct('value')->pluck('value') as $value)
                                    <th scope="col" class="w-auto px-6 py-3">
                                        {{ $value ?: 'Sin respuesta' }}
                                    </th>
                                @endforeach
                                <th scope="col" class="w-auto px-6 py-3">
                                    Total Fila
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tableData['tableData'] as $key => $values)
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                        {{ $key ?: 'Sin respuesta' }}
                                    </th>
                                    @foreach ($variable2->data()->distinct('value')->pluck('value') as $value)
                                        <td class="px-6 py-4">
                                            {{ isset($values[$value]) ? $values[$value] : 0 }}
                                        </td>
                                    @endforeach
                                    <td class="px-6 py-4">
                                        {{ isset($tableData['rowTotals'][$key]) ? $tableData['rowTotals'][$key] : 0 }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                    Total Columna
                                </th>
                                @foreach ($variable2->data()->distinct('value')->pluck('value') as $value)
                                    <td class="px-6 py-4">
                                        {{ isset($tableData['columnTotals'][$value]) ? $tableData['columnTotals'][$value] : 0 }}
                                    </td>
                                @endforeach
                                <td class="px-6 py-4">
                                    {{-- Calcula el total general aquí --}}
                                    {{ array_sum($tableData['columnTotals']) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
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
        </div>
    </div>
</div>
