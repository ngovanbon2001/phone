@extends('layouts.app')

@section('content')
<!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Shopping Cart</h1>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <!-- Shopping Cart Items -->
                <table class="shopping-cart">
                    @if(!empty($carts))
                    @foreach ($carts as $value)
                    <!-- Shopping Cart Item -->
                    <tr>
                        <!-- Shopping Cart Item Image -->
                        <td class="image"><a href="page-product-details.html"><img src="{{ asset('images/'.$value['options']['image'] ?? '') }}" alt="Item Name"></a></td>
                        <!-- Shopping Cart Item Description & Features -->
                        <td>
                            <div class="cart-item-title"><a href="page-product-details.html">{{ $value['name'] ?? '' }}</a></div>
                        </td>
                        <!-- Shopping Cart Item Quantity -->
                        <td class="quantity">
                            <!-- <input type="hidden" name="products[{{ $value['id'] }}][id]" value="{{ $value['id'] }}">
                                    <input class="form-control input-sm input-micro cart" data-id="{{ $value['id'] }}" type="text" name="products[{{ $value['id'] }}][quantity]" value="{{ $value['qty'] }}"> -->
                            <input id="cart-{{ $value['id'] }}" class="form-control input-sm input-micro cart" data-id="{{ $value['id'] }}" data-name="{{ $value['name'] }}" data-image="{{ $value['options']['image'] }}" data-price="{{ $value['price'] }}" data-qty="{{ $value['qty'] }}" type="text" name="quantity" value="{{ $value['qty'] }}">
                        </td>
                        <!-- Shopping Cart Item Price -->
                        <td class="price">${{ $value['price'] ?? 0 }}</td>
                        <!-- Shopping Cart Item Actions -->
                        <td class="actions">
                            <a href="#" class="btn btn-xs btn-grey"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a href="#" class="btn btn-xs btn-grey"><i class="glyphicon glyphicon-trash"></i></a>
                        </td>
                    </tr>
                    <!-- End Shopping Cart Item -->
                    @endforeach
                    @endif
                </table>
                <!-- End Shopping Cart Items -->
            </div>
        </div>
        <div class="row">
            <!-- Shopping Cart Totals -->
            <div class="col-md-4 col-md-offset-8 col-sm-6 col-sm-offset-6">
                <table class="cart-totals">
                    <tr>
                        <td><b>Shipping</b></td>
                        <td>Free</td>
                    </tr>
                    <tr class="cart-grand-total">
                        <td><b>Total</b></td>
                        <td><b>$163.55</b></td>
                    </tr>
                </table>
                <!-- Action Buttons -->
                <div class="pull-right">
                    <button id="update-cart" data-cart="{{ auth()->user()->id ?? 0 }}" class="btn btn-grey"><i class="glyphicon glyphicon-refresh"></i> UPDATE</button>
                    <a href="#" class="btn"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> CHECK OUT</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
    /* Styles for the toast container */
    button {
        outline: 0 !important;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        toastr.options = {
            "positionClass": "toast-bottom-right",
        };

        function changeQuantity(carts) {
            carts.each(function() {
                var qty = $(this).val();
                $(this).data('id', qty);
            });
        }

        $('#update-cart').on('click', function() {
            const carts = $('.cart');
            var cartData = [];
            var products = [];
            var cart_id = $(this).data('cart');

            carts.each(function() {
                cartData.push({
                    id: parseInt($(this).data('id')),
                    qty: parseInt($(this).val()),
                    name: $(this).data('name'),
                    price: $(this).data('price'),
                    options: {
                        image: $(this).data('image')
                    },
                });
                products.push({
                    id: $(this).data('id'),
                    qty: $(this).val() - $(this).data('qty'),
                })
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route("cart.update") }}',
                method: 'POST',
                data: {
                    cart_id: cart_id,
                    data: cartData,
                    products: products,
                },
                success: function(response) {
                    console.log(response.data.data);
                    $.each(response.data.data, function(key, item) {
                        $("#cart-" + item.id).data("qty", parseInt(item.qty));
                    });
                    setTimeout(function() {
                        toastr.success('Cart updated successfully!', 'Success');

                    }, 2000);
                },
                error: function(xhr, text, err) {
                    var responseData = JSON.parse(xhr.responseText);
                    var errorMessage = responseData.message;
                    setTimeout(function() {
                        toastr.error(errorMessage, 'Error');
                    }, 2000);

                    var inputElement = $("#cart-" + responseData.id);
                    var previousQuantity = inputElement.data('qty');
                    inputElement.val(previousQuantity);
                }
            });
        });
    });
</script>