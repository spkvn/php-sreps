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
                        <input type="text" name="code" id="product-code" class="form-control" placeholder="Sale Code" readonly>
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col">
                        <label for="name">Product Name:</label>
                        <select name="name" id="product-name">
                            <option value="" disabled selected>Select a Product</option>
                        @forelse ($products as $product)
                            <option value="{{$product->name}}">{{$product->name}}</option>
                        @empty
                            <option value="No Products">No Prodcuts</option>
                        @endforelse   
                        </select>
                    </div>
                    <input type="hidden" name="product" id="product-id">
                    <input type="hidden" id="product-price" value="">
                    <div class="col" id="product-confirm">

                    </div>
                </div>
                <div class="row py-1">
                    <div class="col">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Quantity of Product">
                    </div>
					
                    <div class="col">
                        <label for="total">Total:</label>
                        <input type="number" name="total" id="total" class="form-control-plaintext" placeholder="Total Price" readonly>
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
    /**
     * Creates the HTML string which we put back into the page.
     * @param {array} products
     * @returns {string}
     */
    function generateButtonsHtmlString(products){
        var htmlString = '';
        for(var i = 0; i < products.length; i++){
            htmlString += '<p>'+products[i].name+' <span class="px-2 bg-green fade-button confirm-button" data-id="'+products[i].id+'" data-code="'+products[i].code+'" data-price="'+products[i].price+'">Confirm</span></p>'
        }
        return htmlString
    }

    /**
     * Updates the total based on product price and quantity.
     */
    function updatePrice(){
        var qty = parseInt($('#quantity').val());
        var price = parseFloat($('#product-price').val());
        $('#total').val(qty*price);
    }

    /**
     * Sets the hidden input fields in the form to the product's ID
     * price and id.
     * Updates price.
     */
    function saveSelection(){
        var id = $(this).data('id');
        var price = $(this).data('price');
        var code = $(this).data('code');
        console.log(price)
        $('#product-id').val(id);
        $('#product-price').val(price);
        $('#product-code').val(code);
        updatePrice();
    }

    function resetDependentFields(){
        $('#product-id').val(null);
        $('#product-price').val(null);
        $('#quantity').val(0);
        $('#total').val(0);
        $('#product-confirm').empty();
    }

    $('#product-name').on('input',function(){
        var name = $(this).val();
        $.ajax({
            url: '/sales/autocomplete',
            method: 'get',
            data: {
                _token : '{{csrf_token()}}',
                name  : name
            },
            success: function(response){
                $('#product-confirm').empty();
                $('#product-id').val(null);
                if(response.length > 0){
                    $('#product-confirm').append(generateButtonsHtmlString(response));
                    $('.confirm-button').on('click',saveSelection);
                }
            },
            error: function (error){
                console.log(error);
                resetDependentFields();
            }
        });
    });
    $('#quantity').on('input',updatePrice);
</script>
@endpush