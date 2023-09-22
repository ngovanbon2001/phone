@extends('layouts.app')

@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active">Cart</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Cart Start -->
<div class="cart-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-page-inner">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @if(!empty($carts))
                                @foreach ($carts as $key => $value)
                                <tr>
                                    <td>
                                        <div class="img">
                                            <a href="{{route('web.product.detail', $value['product_id'])}}"><img src="{{ asset('images/'.$value['options']['image'] ?? '') }}" alt="Image"></a>
                                            <p>{{ $value['name'] ?? '' }}</p>
                                        </div>
                                    </td>
                                    <td>${{ $value['price'] ?? 0 }}</td>
                                    <td>
                                        <div class="qty">
                                            <input id="cart-{{ $value['product_id'] ?? 0 }}" class="cart" data-cart="{{ auth()->user()->id ?? 0 }}" data-id="{{ $value['product_id'] ?? 0}}" data-name="{{ $value['name'] ?? ''}}" data-image="{{ $value['options']['image'] ?? '' }}" data-price="{{ $value['price'] ?? 0 }}" data-qty="{{ $value['quantity'] ?? 0 }}" type="number" name="quantity" value="{{ $value['quantity'] ?? 0 }}" oninput="checkQuantity(this)">
                                        </div>
                                    </td>
                                    <td id="total-{{ $value['product_id'] ?? 0 }}">${{ ($value['price'] ?? 0) * ($value['quantity'] ?? 0) }}</td>
                                    <td><button type="button" data-id="{{ $value['product_id'] ?? 0 }}" class="delete-cart"><i class="fa fa-trash"></i></button></td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart-page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="cart-summary">
                                <div class="cart-content">
                                    <h1>Cart Summary</h1>
                                    <p>Sub Total<span id="sub_total">$0</span></p>
                                    <p>Shipping Cost<span>Free</span></p>
                                    <h2>Grand Total<span id="total">$0</span></h2>
                                </div>
                                <div class="cart-btn">
                                    <button>Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection
<style>
    /* Styles for the toast container */
    button {
        outline: 0 !important;
    }
</style>
@section('script-custom')
<script>
    const deleteUrl = '{{ route("cart.destroy", ":productId") }}';

    const updateUrl = '{{ route("cart.update") }}';

    const token = '{{ csrf_token() }}';

    const urlAddress = "{{ route('select-delivery') }}";

    function checkQuantity(input) {
        var value = parseFloat(input.value);
        if (value < 1) {
            input.value = 1;
        }
    }
</script>
<script src="{{ asset('fe/js/cart.js') }}"></script>
@endsection