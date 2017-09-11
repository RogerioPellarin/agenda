google.charts.load("current", {packages: ["corechart"]});
//classificação etária
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
    var dataAges = null;
        dataAges = $.ajax({
            method: "POST",
            url: $('#base_url').val() + "api_admin.php",
            dataType: "json",
            data: {
                method: "get_ages"
            },
            async: false
        }).responseText;
    
    var options = {
        pieHole: 0.4,
        chartArea: {
            left: "5%",
            top: "5%",
            botton: "5%",
            width: "100%"
        }

    };

    var chartData = new google.visualization.DataTable(dataAges);
    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
    chart.draw(chartData, options);    
}


//aceitação de contatos
google.charts.setOnLoadCallback(drawColumnChart);
function drawColumnChart() {
    var dataAccept = null;
    dataAccept = $.ajax({
            method: "POST",
            url: $('#base_url').val() + "api_admin.php",
            dataType: "json",
            data: {
                method: "get_accept"
            },
            async: false
        }).responseText;
            
    var options = {
        bar: {groupWidth: "95%"},
        colors: ['#69c2fe', '#5fc29d', '#FFD700', '#f3b49f', '#f6c7b6'],
        chartArea: {
            left: "5%",
            top: "5%",
            width: "100%"
        }
    };
    var chartData = new google.visualization.DataTable(dataAccept);
    var chart = new google.visualization.ColumnChart(document.getElementById('barchart_values'));
    chart.draw(chartData, options);    
}


$(window).resize(function () {
    drawChart();
    drawColumnChart();
});

