@extends('layout.main')
@section('content')

    <div class="row my-2 py-2 bg-green rounded-corners">
        <div class="col-10">
            <h1>PHP-SRePS Sales</h1>
            <p>Reports created based on sales data</p>
        </div>
        <div class="col-2 text-center py-4">
            <a href="#" id="refresh" class="fade-button">Refresh Reports</a>
        </div>
    </div>

    <div class="row bg-white rounded-corners my-3 py-3 px-3">
        <div class="col-12" class="controls">
            <p class="lead">Controls</p>
            <form class="inline-form">
                <input type="text" class="form-control" id="start" placeholder="YYYY-MM-DD">
                <input type="text" class="form-control" id="stop" placeholder="YYYY-MM-DD">
            </form>

        </div>
        <div class="col-12">
            <div class="bar-wrapper" id="reportsWrapper">

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
        var startDate = document.querySelector("#start").value;
        var stopDate = document.querySelector("#stop").value;
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

                    var chart = new google.visualization.LineChart(document.getElementById('reportsWrapper'));

                    chart.draw(data, options);
                } else {
                    document.querySelector('#reportsWrapper').innerHTML = "<h2>No sales for that date range</h2>"
                    + "<p> Start: " + startDate + "</p>"
                    + "<p> Stop: " + stopDate  + "</p>"
                }
            }

        });
    }
    document.querySelector("#refresh").addEventListener('click',drawChart);
</script>
@endpush
