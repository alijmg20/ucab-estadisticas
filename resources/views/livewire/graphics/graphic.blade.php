<div wire:init='loadGraphic'>
    <div class="mb-4">
        <div class="inline-block w-full shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 flex flex-items-center">
                <div class="flex items-center">
                    <span class="mr-2 text-gray-700 dark:text-gray-400">Selecciona el grafico:
                    </span>
                    <x-select-dropdown class="mx-auto" wire:model="typeGraphic" wire:change="selectGraphic()">
                        @foreach ($entrysGraphic as $entry)
                            <option value="{{ $entry }}">{{ $entry }}</option>
                        @endforeach
                    </x-select-dropdown>
                </div>
            </div>
            @if ($variable)
                <div id="{{ $variable->id }}"></div>
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
        document.addEventListener('livewire:load', function() {
            Livewire.on('graphicShow', (variable, data) => {
                console.log(variable.graphic_type);
                if (variable.graphic_type == 'barra')
                    bar(variable, data);
                else if (variable.graphic_type == 'circulo') {
                    circle(variable, data);
                }
            });
        });

        function circle(variable, data) {
            Highcharts.chart(variable['id'].toString(), {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: variable['name'],
                    align: 'left'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: variable['name'].toString(),
                    colorByPoint: true,
                    data: JSON.parse(data),
                }]
            });
        }

        function bar(variable, data) {

            var keys = [];
            var values = [];
            var datas = JSON.parse(data);
            datas.forEach(dat => {
                keys.push(dat.name.toString());
                values.push(parseFloat(dat.y));
            });
            // Calcular el total de los valores
            var total = values.reduce(function(a, b) {
                return a + b;
            }, 0);
            // Convertir los valores a porcentajes con dos decimales
            var datosPorcentaje = values.map(function(valor) {
                return parseFloat(((valor / total) * 100).toFixed(2));
            });
            // Configuración del gráfico
            Highcharts.chart(variable['id'].toString(), {
                chart: {
                    type: 'column'
                },
                title: {
                    text: variable['name']
                },
                xAxis: {
                    categories: keys
                },
                yAxis: {
                    title: {
                        text: 'Porcentaje'
                    },
                    labels: {
                        format: '{value}%'
                    }
                },
                series: [{
                    name: variable['name'].toString(),
                    data: datosPorcentaje,
                    tooltip: {
                        valueSuffix: '%'
                    }
                }]
            });

        }
    </script>
</div>
