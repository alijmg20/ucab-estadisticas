<div wire:init='loadgraphic'>
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-block w-full shadow rounded-lg overflow-hidden">
            @if (count($variablesActive))
                @foreach ($variablesActive as $variablesActive)
                    <div class="mb-4">
                        <div id="{{ $variablesActive->id }}"></div>
                    </div>
                @endforeach
            @else
                <div class="container mt-4 mb-4">
                    <x-alert-loading-danger>
                        <x-slot name="title">Variables NO seleccionadas</x-slot>
                        <x-slot name="subtitle">¡Debe seleccionar las variables que desea ver en la pestaña <b>variables!</b></x-slot>
                    </x-alert-loading-danger>
                </div>
            @endif

        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function() {
            @this.showGraphics();
            Livewire.on('ghaphicList', (variables, data) => {
                let i = 0;
                variables.forEach(variable => {
                    circle(variable, data[i]);
                    i++;
                });
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
    </script>

</div>
