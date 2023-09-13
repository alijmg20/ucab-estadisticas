<div wire:init='generateComparisonChart'>
    <div
        class="border border-gray-300 mb-6 mt-4 bg-white dark:bg-gray-800 rounded-lg overflow-hidden transform sm:w-full">
        <div class="dark:text-gray-400 px-6 py-4 text-left text-xl w-full dark:bg-gray-800"><span>
                @if ($correlation)
                    {{ $correlation->name }}
                @endif
                <span></div>
        <div class="inline-block w-full">
            <div class="gaphicOptions px-6 py-4 flex flex-items-center">
                <div class="flex items-center w-full">
                    <span class="mr-2 text-gray-700 dark:text-gray-400">Opciones:
                    </span>
                    @if ($correlation)
                        <x-button wire:click='edit()'  wire:loading.attr='disabled' wire:target="edit"
                         class="ml-2 bg-yellow-500 disabled:opacity-25">
                            editar
                        </x-button>
                        <x-button wire:click='delete()' wire:loading.attr='disabled' wire:target="delete"
                         class="ml-2 bg-red-600 disabled:opacity-25">
                            eliminar
                        </x-button>
                    @endif
                </div>
            </div>
            @if ($correlation)
                <div>
                    <div id="comparison-chart-{{$correlation->id}}" class="mb-4"></div>
                    <div class="text-center mb-4 w-full dark:bg-gray-800 dark:text-gray-400">Filas:
                        {{ $variable1->name }}</div>
                    <div class="text-center mb-4 w-full dark:bg-gray-800 dark:text-gray-400">Columnas:
                        {{ $variable2->name }}</div>
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
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
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
                    <div class="px-6 py-4">
                        <div
                            class="text-2xl text-left dark:text-gray-400 flex items-center justify-between w-full p-5 
                    font-medium text-left text-gray-800  focus:outline-none">
                            Estadisticas obtenidas de la intersección
                        </div>
                        <div class="inline-flex mb-4 gap-6 w-full justify-center">
                            <!-- Card -->
                            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                <div
                                    class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        Estadistico X<sup>2</sup> (chi cuadrado)
                                    </p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                        {{ $responsed['chiSquare'] }}
                                    </p>
                                </div>
                            </div>
                            <!-- Card -->
                            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                <div
                                    class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        grado de libertad de X<sup>2</sup>(chi cuadrado)
                                    </p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                        {{$responsed['degreesOfFreedomChiSquare']}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="inline-flex gap-6 w-full justify-center">
                            <!-- Card -->
                            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                <div
                                    class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        Calculo V de Cramer
                                    </p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                        {{ $responsed['cramerv'] }}
                                    </p>
                                </div>
                            </div>
                            <!-- Card -->
                            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                <div
                                    class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        grado de libertad V de Cramer 
                                    </p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                        {{ $responsed['degreesOfFreedomCramersV'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
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

    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('updateChartData', function (chartData) {
                console.log(Object.keys(chartData.tableData));
                Highcharts.chart('comparison-chart-'+chartData.correlation.id.toString(), {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: chartData.correlation.name.toString(),
                    },
                    xAxis: {
                        categories: chartData.categories, // Categorías
                        crosshair: true
                    },
                    yAxis: {
                        title: {
                            text: 'Valores'
                        }
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: Object.entries(chartData.tableData).map(([name, data]) => ({
                        name,
                        data: Object.values(data)
                    }))
                });
            });
        });
    </script>
    
</div>
