@extends('layout.main')
@section('content')

    <div class="row my-2 py-2 bg-green rounded-corners">
        <div class="col-10">
            <h1>PHP-SRePS Sales</h1>
            <p>Here are the sales completed in the database</p>
        </div>
        <div class="col-2 text-center py-4">
            <a href="#" class="fade-button">New Sale</a>
        </div>
    </div>

    <div class="row bg-white rounded-corners my-3 py-3 px-3">
        <div class="col">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Code</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    {{--
                        Tip: For else directive
                        Provides you with a foreach loop, and a @empty block if the
                        array or collection passed in is empty!
                    --}}
                    @forelse($sales as $sale)
                        <tr>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->customer }}</td>
                            <td>{{ $sale->code }}</td>
                            <td>{{ $sale->quantity }}</td>
                            <td><!--<a class="btn btn-secondary" href="{{route('sales.edit', $product->id)}}">--><a>Edit</a></td>
                            <td>
                                <!--<form class="delete-form" action="{{route('products.destroy',$product->id)}}" method="POST">
                                    {{csrf_field()}}
                                </form>-->
                                <button class="delete-button btn btn-dark">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>No Sales</td>
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
