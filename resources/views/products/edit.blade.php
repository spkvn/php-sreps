@extends('layout.main')
@section('content')
    <div class="row my-2 py-2 bg-green rounded-corners">
        <div class="col-9">
            <h1>PHP-SRePS Products</h1>
            <p>Here's the form to update the product <strong>{{$product->name}}</strong></p>
        </div>
        <div class="col-3 text-center py-4">
            <a href="/products" class="fade-button">Product List</a>
        </div>
    </div>

    <div class="row bg-white rounded-corners my-3 py-3 px-3">
        <div class="col">
            <form action="{{route('products.update', $product->id)}}" method="POST">

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
                        <label for="name">Name:</label>
                        <input type="text" name="name" value="{{$product->name}}" class="form-control" placeholder="Product Name">
                    </div>
                    <div class="col">
                        <label for="code">Code:</label>
                        <input type="text" name="code" value="{{$product->code}}" class="form-control" placeholder="Product Code">
                    </div>
                </div>

                <div class="row py-1">
                    <div class="col">
                        <label for="description">Description:</label>
                        <input type="text" name="description" value="{{$product->description}}" class="form-control" placeholder="Product Description">
                    </div>
                </div>

                <div class="row py-1">
                    <div class="col-3">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" value="{{$product->quantity}}" class="form-control" placeholder="Quantity of Product">
                    </div>

                    <div class="col-9">
                        <label for="supplier">Supplier:</label>
                        <input type="text" name="supplier" value="{{$product->supplier}}" class="form-control" placeholder="Product Supplier">
                    </div>
                </div>

                <div class="row py-1">
                    <div class="col">
                        <label for="comments">Comments:</label>
                        <textarea name="comments" id="" cols="30" rows="10" class="form-control" placeholder="Comments about product">{!! $product->comments !!}</textarea>
                    </div>
                </div>

                <div class="row py-5 text-center">
                    <div class="col">
                        <input type="submit" class="px-5 bg-green fade-button" value="Update">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection