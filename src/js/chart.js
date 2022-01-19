google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    let data = google.visualization.arrayToDataTable([
        ['District', 'Count'],
        ['Dumfries', 10],
        ['Central & Fife', 10],
        ['Glasgow', 10],
        ['Lanarkshire', 10],
        ['Edinburgh & Borders', 10],
        ['Ayrshire & Clyde', 10]
    ]);

    let options = {
        title: 'Low Risks',
        colors: ['red', 'orange', 'purple', 'blue', 'green', 'yellow'],
        pieSliceTextStyle: {
            color: 'black'
        }
    }

    let chart = new google.visualization.PieChart(document.getElementById('lowChart'));
    chart.draw(data, options);
}