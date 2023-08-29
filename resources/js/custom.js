// // resources/js/wordcloud-script.js
// import * as d3 from 'd3';
// import cloud from 'd3-cloud';

// const createWordCloud = (wordFrequencies) => {
//     const layout = cloud()
//         .size([800, 600])
//         .words(wordFrequencies)
//         .padding(5)
//         .rotate(() => 0)
//         .font("Arial")
//         .fontSize((d) => d.size)
//         .on("end", draw);

//     layout.start();

//     function draw(words) {
//         d3.select("#wordcloud-container").append("svg")
//             .attr("width", layout.size()[0])
//             .attr("height", layout.size()[1])
//             .append("g")
//             .attr("transform", `translate(${layout.size()[0] / 2},${layout.size()[1] / 2})`)
//             .selectAll("text")
//             .data(words)
//             .enter().append("text")
//             .style("font-size", (d) => `${d.size}px`)
//             .style("font-family", "Arial")
//             .attr("text-anchor", "middle")
//             .attr("transform", (d) => `translate(${d.x},${d.y})rotate(${d.rotate})`)
//             .text((d) => d.text);
//     }
// };

// export default createWordCloud;

// // Uso de la función
// import createWordCloud from './wordcloud-script';

// const wordFrequencies = [
//     { text: 'hello', size: 20 },
//     { text: 'world', size: 10 },
//     // Agrega más objetos aquí...
// ];

// createWordCloud(wordFrequencies);
