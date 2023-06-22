<div wire:init='loadgraphic'>
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-block w-full shadow rounded-lg overflow-hidden">
                @foreach ($variables as $variable)
                    <div class="mb-4">
                        <div id="{{ $variable->id }}"></div>
                    </div>
                @endforeach
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
