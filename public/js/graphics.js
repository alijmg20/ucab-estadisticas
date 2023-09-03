function circle(variable, data) {
    Highcharts.chart(variable["id"].toString(), {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: "pie",
        },
        title: {
            text: variable["name"],
            align: "left",
        },
        tooltip: {
            pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>",
        },
        accessibility: {
            point: {
                valueSuffix: "%",
            },
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: "pointer",
                dataLabels: {
                    enabled: false,
                },
                showInLegend: true,
            },
        },
        series: [
            {
                name: variable["name"].toString(),
                colorByPoint: true,
                data: JSON.parse(data),
            },
        ],
    });
}

function column(variable, data) {
    var keys = [];
    var values = [];
    var datas = JSON.parse(data);
    datas.forEach((dat) => {
        keys.push(dat.name.toString());
        values.push(parseFloat(dat.y));
    });
    // Calcular el total de los valores
    var total = values.reduce(function (a, b) {
        return a + b;
    }, 0);
    // Convertir los valores a porcentajes con dos decimales
    var datosPorcentaje = values.map(function (valor) {
        return parseFloat(((valor / total) * 100).toFixed(2));
    });
    // Configuración del gráfico
    Highcharts.chart(variable["id"].toString(), {
        chart: {
            type: "column",
        },
        title: {
            text: variable["name"],
        },
        xAxis: {
            categories: keys,
        },
        yAxis: {
            title: {
                text: "Porcentaje",
            },
            labels: {
                format: "{value}%",
            },
        },
        series: [
            {
                name: variable["name"].toString(),
                data: datosPorcentaje,
                tooltip: {
                    valueSuffix: "%",
                },
            },
        ],
    });
}

function bar(variable, data) {
    var keys = [];
    var values = [];
    var datas = JSON.parse(data);
    datas.forEach((dat) => {
        keys.push(dat.name.toString());
        values.push(parseFloat(dat.y));
    });
    // Calcular el total de los valores
    var total = values.reduce(function (a, b) {
        return a + b;
    }, 0);
    // Convertir los valores a porcentajes con dos decimales
    var datosPorcentaje = values.map(function (valor) {
        return parseFloat(((valor / total) * 100).toFixed(2));
    });
    // Configuración del gráfico
    Highcharts.chart(variable["id"].toString(), {
        chart: {
            type: "bar",
        },
        title: {
            text: variable["name"],
        },
        xAxis: {
            categories: keys,
        },
        yAxis: {
            title: {
                text: "Porcentaje",
            },
            labels: {
                format: "{value}%",
            },
        },
        plotOptions: {
            series: {
                states: {
                    hover: {
                        enabled: true,
                        halo: {
                            size: 0,
                        },
                    },
                },
            },
        },
        tooltip: {
            pointFormat:
                '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y}%</b><br/>',
        },
        series: [
            {
                name: variable["name"].toString(),
                data: datosPorcentaje,
            },
        ],
    });
}

function barColor(variable,name, data) {
    Highcharts.chart(name, {
        chart: {
            type: "bar",
        },
        title: {
            align: "center",
            text: variable["name"],
        },
        accessibility: {
            announceNewData: {
                enabled: true,
            },
        },
        xAxis: {
            type: "category",
        },
        yAxis: {
            title: {
                text: "Porcentaje",
            },
        },
        legend: {
            enabled: false,
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: "{point.y:.1f}%",
                },
            },
        },
    
        tooltip: {
            headerFormat:
                '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat:
                '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>',
        },
    
        series: [
            {
                name: variable["name"].toString(),
                colorByPoint: true,
                data: data,
            },
        ],
    });
}

function columnColor(variable,name, data) {
    Highcharts.chart(name, {
        chart: {
            type: "column",
        },
        title: {
            align: "center",
            text: variable["name"],
        },
        accessibility: {
            announceNewData: {
                enabled: true,
            },
        },
        xAxis: {
            type: "category",
        },
        yAxis: {
            title: {
                text: "Porcentaje",
            },
        },
        legend: {
            enabled: false,
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: "{point.y:.1f}%",
                },
            },
        },

        tooltip: {
            headerFormat:
                '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat:
                '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>',
        },

        series: [
            {
                name: variable["name"].toString(),
                colorByPoint: true,
                data: data,
            },
        ],
    });
}