@extends('layout.main')
@section('content')
    <div class="row my-2 py-2 bg-green rounded-corners">
        <div class="col-9">
            <h1>PHP-SRePS Sales</h1>
            <p>Here's the form to create a new sale</p>
        </div>
        <div class="col-3 text-center py-4">
            <a href="/sales" class="fade-button">Sales List</a>
        </div>
    </div>

    <div class="row bg-white rounded-corners my-3 py-3 px-3">
        <div class="col">
            <form action="{{route('sales.store')}}" method="POST">

                {{--
                    Tip: CSRF Token
                    Every POST / PUT / PATCH / DELETE http request in laravel requires
                    a CSRF token, which is automatically generated which helps to prevent
                    cross-site forgeries (sending requests outside of our site)

                    we use csrf_field() to generate a hidden input which proves we're who
                    we say we are.
                --}}
                {{ csrf_field() }}

                <div class="row py-1">
                    <div class="col">
                        <label for="customer">Customer:</label>
                        <input type="text" name="customer" class="form-control" placeholder="Customer Name">
                    </div>
                    <div class="col">
                        <label for="code">Code:</label>
                        <input type="text" name="code" id="product-code" class="form-control" placeholder="Sale Code">
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col-9">
                        <p class="lead">Product:</p>
                    </div>
                    <div class="col-3">
                        <p class="lead">Quantity:</p>
                    </div>
                </div>
                <div class="row py-1 line-item">
                    <div class="col-9">
                        <input type="text" name="product_id[]" class="selectize selectize-control">
                    </div>
                    <div class="col-3">
                        <input type="number" name="quantity[]" class="form-control" placeholder="Product Quantity">
                    </div>
                </div>
                <div class="row py-1 line-item">
                    <div class="col-9">
                        <input type="text" name="product_id[]" class="selectize selectize-control">
                    </div>
                    <div class="col-3">
                        <input type="number" name="quantity[]" class="form-control" placeholder="Product Quantity">
                    </div>
                </div>
                <div class="row py-1 line-item">
                    <div class="col-9">
                        <input type="text" name="product_id[]" class="selectize selectize-control">
                    </div>
                    <div class="col-3">
                        <input type="number" name="quantity[]" class="form-control" placeholder="Product Quantity">
                    </div>
                </div>

				<div class="row py-5 text-center">
					<div class="col">
						<input type="submit" class="px-5 bg-green fade-button" value="Create">
					</div>
				</div>
            </form>
        </div>
    </div>
@endsection
@push('javascript')
<script>
    $('.selectize').selectize({
        valueField:'id',
        labelField:'name',
        searchField:'name',
        maxItems:1,
        placeholder:'Search for a product by its name',
        options:[],
        load:function(query,callback){
            $.ajax({
                url:'/sales/autocomplete',
                data:{
                    name: query
                },
                success: function(response){
                    callback(response);
                },
                error: function(response){
                    console.log(response);
                    callback();
                }
            });
        }
    });
</script>
@endpush