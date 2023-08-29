// public/js/custom-wordcloud.js
function generateWordCloud(data,name,variable) {


    // Configuración de la nube de palabras
    var options = {
        series: [
            {
                type: "wordcloud",
                data: data,
            },
        ],
        title: {
            text: variable.name.toString(),
        },
    };

    // Crear el gráfico de Highcharts
    Highcharts.chart(name, options);
}
