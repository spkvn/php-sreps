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
            <div class="bar-wrapper" id="reportsWrapper">

            </div>
        </div>

    </div>
@endsection
@push('javascript')
<script>
    var data = [234,231,302,284,299,253,321];
    d3.select('#reportsWrapper')
        .selectAll('div')
        .data(data)
        .enter().append('div')
        .style("width", function(d){
            return d * 2 +"px"
        })
        .text(function(d){
            return d;
        });
</script>
@endpush
