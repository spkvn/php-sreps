@extends('layout.main')
@section('content')

    <div class="row my-2 py-2 bg-green rounded-corners">
        <div class="col-3">
            <h1>PHP-SRePS Sales</h1>
            <p>Reports created based on sales data</p>
        </div>
        <div class="col-6 text-center py-4">
            <a href="#sales-report" class="fade-button">Sales Report</a>
            <a href="#csv-report" class="fade-button">CSV Report</a>
        </div>
        <div class="col-3 text-center py-4">
            <a href="#" id="refresh" class="fade-button">Refresh Reports</a>
        </div>
    </div>

    <div class="row bg-white rounded-corners my-3 py-3 px-3">
        <div class="col-4"></div>
        <div class="col-4" class="controls" style="text-align: center;">
            <h1 id="sales-report">Sales Report</h2>
            <p class="lead">Controls</p>
            <form class="inline-form">
                <input type="text" class="form-control" id="start-sales" placeholder="YYYY-MM-DD">
                <input type="text" class="form-control" id="stop-sales" placeholder="YYYY-MM-DD">
            </form>

        </div>
        <div class="col-4"></div>
        <div class="col-12">
            <div class="bar-wrapper" id="salesReportWrapper">

            </div>
        </div>

    </div>
    <div class="row bg-white rounded-corners my-3 py-3 px-3">
        <div class="col-4"></div>
        <div class="col-4" class="controls" style="text-align: center;">
            <h1 id="csv-report">CSV Report</h2>
            <p class="lead">Controls</p>
            <form class="inline-form">
                <input type="text" class="form-control" id="start-csv" placeholder="YYYY-MM-DD">
                <input type="text" class="form-control" id="stop-csv" placeholder="YYYY-MM-DD">
            </form>
            <button onclick="location.href = location.href + '/generateCSV'">Generate CSV</button>

        </div>
        <div class="col-4"></div>
        <div class="col-12">
            <div id="csvReportsWrapper">

            </div>
        </div>
    </div>
@endsection
@push('javascript')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var startDate = document.querySelector("#start-sales").value;
        var stopDate = document.querySelector("#stop-sales").value;
        console.log("start: " + startDate);
        console.log("stop: " + stopDate);
        $.ajax({
            url: '/reports/salesByDay',
            data: {
                start: startDate,
                stop: stopDate
            },
            success: function(response){
                if(response.length > 0){
                    var unprocessedData = [
                        ['Day', 'Sales']
                    ];

                    response.forEach(function(d){
                        unprocessedData.push([d.day, parseInt(d.total)]);
                    });
                    console.log(unprocessedData);

                    var data = google.visualization.arrayToDataTable(unprocessedData);
                    var options = {
                        title: 'Sales Per Day',
                        height:400,
                        curveType: 'function',
                        legend: 'right',
                        pointSize: 5
                    };

                    var chart = new google.visualization.LineChart(document.getElementById('salesReportWrapper'));

                    chart.draw(data, options);
                } else {
                    document.querySelector('#salesReportWrapper').innerHTML = "<h2>No sales for that date range</h2>"
                    + "<p> Start: " + startDate + "</p>"
                    + "<p> Stop: " + stopDate  + "</p>"
                }
            }

        });
    }
    
    function createCSV() {
        var startDate = document.querySelector("#start-csv").value;
        var stopDate = document.querySelector("#stop-csv").value;
        console.log("start: " + startDate);
        console.log("stop: " + stopDate);
        $.ajax({
            url: '/reports/allSalesForDate',
            data: {
                start: startDate,
                stop: stopDate
            },
            success: function(response){
                if(response.length > 0){
                    var unprocessedData = [
                        ['ID', 'Customer', 'Total', 'Day']
                    ];

                    response.forEach(function(d) {
                        unprocessedData.push([d.id, d.customer, parseInt(d.total), d.day]);
                        document.querySelector('#csvReportsWrapper').innerHTML = "<p>" + d.id + ", " + d.customer + ", " + parseInt(d.total) + ", " + d.day + "</p>"
                    });
                    console.log(unprocessedData);
                } else {
                    document.querySelector('#csvReportsWrapper').innerHTML = "<h2>No sales for that date range</h2>"
                    + "<p> Start: " + startDate + "</p>"
                    + "<p> Stop: " + stopDate  + "</p>"
                }
            }

        });
    }

    document.querySelector("#refresh").addEventListener('click',drawChart);
    document.querySelector("#refresh").addEventListener('click',createCSV);
</script>
@endpush
