@extends('layout.main')
@section('content')

    <div class="row my-2 py-2 bg-green rounded-corners">
        <div class="col-10">
            <h1>PHP-SRePS Products</h1>
            <p>Here are the products available in the database</p>
        </div>
        <div class="col-2 text-center py-4">
            <a href="/products/create" class="fade-button">Create</a>
        </div>
    </div>

    <div class="row bg-white rounded-corners my-3 py-3 px-3">
        <div class="col">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Description</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    {{--
                        Tip: For else directive
                        Provides you with a foreach loop, and a @empty block if the
                        array or collection passed in is empty!
                    --}}
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->description }}</td>
                            <td><a class="btn btn-secondary" href="{{route('products.edit', $product->id)}}">Edit</a></td>
                            <td>
                                <form class="delete-form" action="{{route('products.destroy',$product->id)}}" method="POST">
                                    {{csrf_field()}}
                                </form>
                                <button class="delete-button btn btn-dark">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>No Products</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
@endsection
@section('javascript')
<script>
    $('.delete-button').on('click',function(e){
        e.preventDefault();
        var $this = $(this);
        var deleteForm = $this.siblings('.delete-form').submit();
    });
</script>
@endsection