{{--
    Tip: Extends.
    @extends means that the content of this blade template will
    be pasted into the blade at /views/layout/main.blade.php
    where we call @yield('content')
 --}}
@extends('layout.main')
@section('content')
    <div class="jumbotron bg-green my-5">
        <h1 class="display-4">PHP-SRePS</h1>
        <p class="lead">Get started with one of the buttons below</p>
        <hr>
        <div class="row px-auto text-center pt-3">
            <div class="col">
                <a href="/products" class="fade-button">Products</a>
            </div>
            <div class="col">
                <a href="/sales" class="fade-button">Sales</a>
            </div>
            <div class="col">
                <a href="/reports" class="fade-button">Reports</a>
            </div>
        </div>
    </div>
    @if($lowStockProducts->count() > 0)
    <div class="row bg-white rounded-corners my-5 py-3 ">
        <div class="col">
            <p class="lead text-danger text-right">Low-Stock Items:</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Item Code</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($lowStockProducts as $product)
                    <tr>
                        <td>{{$product->code}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->quantity}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
@endsection
