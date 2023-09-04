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

        <form id="check-out-form" action="{{ route('order.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <!-- Shopping Cart Items -->
                    <table class="shopping-cart">
                        @if(!empty($carts))
                        @foreach ($carts as $key => $value)
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
                                <!-- <input type="hidden" name="products[{{ $value['product_id'] }}][id]" value="{{ $value['product_id'] }}">
                                    <input class="form-control input-sm input-micro cart" data-id="{{ $value['product_id'] }}" type="text" name="products[{{ $value['product_id'] }}][quantity]" value="{{ $value['quantity'] }}"> -->
                                <input id="cart-{{ $value['product_id'] }}" class="form-control input-sm input-micro cart" data-id="{{ $value['product_id'] }}" data-name="{{ $value['name'] }}" data-image="{{ $value['options']['image'] }}" data-price="{{ $value['price'] }}" data-qty="{{ $value['quantity'] }}" type="number" name="quantity" value="{{ $value['quantity'] }}">
                            </td>
                            <!-- Shopping Cart Item Price -->
                            <td class="price">${{ $value['price'] ?? 0 }}</td>
                            <!-- Shopping Cart Item Actions -->
                            <td class="actions">
                                <a href="#" class="btn btn-xs btn-grey"><i class="glyphicon glyphicon-pencil"></i></a>
                                <a href="#" class="btn btn-xs btn-grey"><i class="glyphicon glyphicon-trash"></i></a>
                            </td>
                        </tr>
                        <input type="hidden" name="items[{{ $key }}][product_id]" value="{{ $value['product_id'] ?? '' }}">
                        <input type="hidden" name="items[{{ $key }}][product_name]" value="{{ $value['name'] ?? '' }}">
                        <input type="hidden" name="items[{{ $key }}][product_price]" value="{{ $value['price'] ?? '' }}">
                        <input id="quantity-{{ ($value['product_id'] ?? 0) }}" type="hidden" name="items[{{ $key }}][product_quantity]" value="{{ $value['quantity'] ?? 0 }}">
                        <input type="hidden" name="items[{{ $key }}][product_image]" value="{{ $value['options']['image'] }}">
                        <!-- End Shopping Cart Item -->
                        @endforeach
                        @endif
                    </table>
                    <!-- End Shopping Cart Items -->
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <div id="form-order">
                        <div class="cart-promo-code">
                            <h6> Name</h6>
                            <div>
                                <input class="form-control input-sm" name="customer_name" type="text" value="">
                            </div>
                        </div>
                        <div class="cart-promo-code">
                            <h6> Email</h6>
                            <div>
                                <input class="form-control input-sm" name="customer_email" type="text" value="">
                            </div>
                        </div>
                        <div class="cart-promo-code">
                            <h6> Phone</h6>
                            <div>
                                <input class="form-control input-sm" name="customer_phone" type="text" value="">
                            </div>
                        </div>
                        <div class="cart-shippment-options">
                            <h6> Provinces</h6>
                            <div class="input-append">
                                <select id="provinces" name="provinces" class="form-control input-sm choose provinces">
                                    <option>---Select provinces---</option>
                                    @foreach ($provinces as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="cart-shippment-options">
                            <h6> Districts</h6>
                            <div class="input-append">
                                <select id="districts" name="districts" class="form-control input-sm choose districts">
                                    <option>---Select districts---</option>
                                    <option value="2">Next day delivery - $10.00</option>
                                </select>
                            </div>
                        </div>
                        <div class="cart-shippment-options">
                            <h6> Wards</h6>
                            <div class="input-append">
                                <select id="wards" name="wards" class="form-control input-sm wards">
                                    <option>---Select wards---</option>
                                    <option value="2">Next day delivery - $10.00</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn">Order</button>
                    </div>
                </div>
                <!-- Shopping Cart Totals -->
                <div class="col-md-4 col-md-offset-4 col-sm-6">
                    <table class="cart-totals">
                        <tr>
                            <td><b>Shipping</b></td>
                            <td>Free</td>
                        </tr>
                        <tr class="cart-grand-total">
                            <td><b>Total</b></td>
                            <td><b id="total">$0</b></td>
                        </tr>
                    </table>
                    <!-- Action Buttons -->
                    <div class="pull-right">
                        <button id="update-cart" type="button" data-cart="{{ auth()->user()->id ?? 0 }}" class="btn btn-grey"><i class="glyphicon glyphicon-refresh"></i> UPDATE</button>
                        <button type="button" id="check-out" data-status="0" class="btn"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> CHECK OUT</button>
                    </div>
                </div>
            </div>
        </form>
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
        $('#form-order').hide();

        toastr.options = {
            "positionClass": "toast-bottom-right",
        };

        const carts = $('.cart');
        var total = 0;

        carts.each(function() {
            total = total + (parseInt($(this).val()) * parseFloat($(this).data('price')));
        });

        $('#total').text(total);

        $('#check-out').on('click', function() {
            var status = $(this).data('status');

            if (status == 0) {
                $('#form-order').show();
                $(this).data('status', 1);
            } else {
                $('#form-order').hide();
                $(this).data('status', 0);
            }
        });

        $('#update-cart').on('click', function() {
            var cartData = [];
            var cart_id = $(this).data('cart');
            var totalNew = 0;

            carts.each(function() {
                cartData.push({
                    product_id: $(this).data('id'),
                    quantity: $(this).val(),
                    name: $(this).data('name'),
                    price: $(this).data('price'),
                    options: {
                        image: $(this).data('image')
                    },
                });
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
                },
                success: function(response) {
                    console.log(response.data.data);
                    $.each(response.data.data, function(key, item) {
                        $("#cart-" + item.product_id).data("qty", parseInt(item.quantity));
                        $("#quantity-" + item.product_id).prop('value', parseInt(item.quantity));
                        console.log($("#quantity-" + item.product_id).val());
                        totalNew = totalNew + (parseInt(item.quantity) * parseFloat(item.price));
                    });
                    setTimeout(function() {
                        toastr.success('Cart updated successfully!', 'Success');

                    }, 2000);
                    $('#total').text(totalNew);
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

        $('.choose').on('change', function() {
            var action = $(this).attr('id');
            var id = $(this).val();
            var _token = '{{ csrf_token() }}';
            var result = "";
            if (action == 'provinces') {
                result = 'districts';
            } else {
                result = 'wards';
            }
            $.ajax({
                url: "{{ route('select-delivery') }}",
                method: 'POST',
                data: {
                    action: action,
                    id: id,
                    _token: _token
                },
                success: function(data) {
                    $('#' + result).html(data);
                },
            });
        });
    });
</script>