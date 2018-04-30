@extends('layout.main')
@section('content')

    <div class="row my-2 py-2 bg-green rounded-corners">
        <div class="col-10">
            <h1>PHP-SRePS Sales</h1>
            <p>Reports created based on sales data</p>
        </div>
        <div class="col-2 text-center py-4">
            <a href="#" class="fade-button">Refresh Reports</a>
        </div>
    </div>

    <div class="row bg-white rounded-corners my-3 py-3 px-3">
        <div class="col-12" class="controls">
            <p class="lead">Controls</p>
        </div>
        <div class="col-12">
            <svg class="bar-wrapper" id="reportsWrapper">

            </svg>
        </div>

    </div>
@endsection
@push('javascript')
<script>
    function initializeBarGraph(data){
        var $wrapper = $("#reportsWrapper");
        var width = 320;
        var barHeight = 20;

        console.log("scaleLinear");
        var x = d3.scaleLinear()
            .range([0, width]);

        x.domain([0, d3.max(data,function(d) {
            return d.total;
        })]);

        console.log("selectAll, height:" + barHeight * data.length);
        var chart = d3.select('#reportsWrapper')
            .attr("width",width*2)
            .attr("height", barHeight * data.length);

        var bar = chart.selectAll("g")
            .data(data).enter()
            .append("g").attr("transform",function(d,i){
                return "translate(0," + i * barHeight + ")";
            });

        bar.append("rect")
            .attr("width", function(d){
                return x(d.total);
            })
            .attr("height", barHeight - 1);

        bar.append("text")
            .attr("x", function(d) { return 25; })
            .attr("y", barHeight / 2)
            .attr("dy", ".35em")
            .text(function(d) { return d.day+"th"; });
    }

    $.ajax({
        url: '/reports/salesByDay',
        success: function(response){
            initializeBarGraph(response);
        }
    })
    // d3.select('#reportsWrapper')
    //     .selectAll('div')
    //     .data(data)
    //     .enter().append('div')
    //     .style("width", function(d){
    //         return d * 2 +"px"
    //     })
    //     .text(function(d){
    //         return d;
    //     });
</script>
@endpush
