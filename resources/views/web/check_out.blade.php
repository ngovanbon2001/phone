@extends('layouts.app')

@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active">Checkout</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Checkout Start -->
<div class="checkout">
    <div class="container-fluid">
        <form id="check-out-form" action="{{ route('order.store') }}" method="post">
            @csrf
            @foreach($items as $key => $item)
            <input class="cart" data-cart="{{ auth()->user()->id ?? 0 }}" data-id="{{ $item['product_id'] ?? 0}}" data-name="{{ $item['name'] ?? ''}}" data-image="{{ $item['options']['image'] ?? '' }}" data-price="{{ $item['price'] ?? 0 }}" data-qty="{{ $item['quantity'] ?? 0 }}" type="hidden" name="quantity" value="{{ $item['quantity'] ?? 0 }}">
            <input type="hidden" name="items[{{ $key }}][product_id]" value="{{ $item['product_id'] ?? '' }}">
            <input type="hidden" name="items[{{ $key }}][product_name]" value="{{ $item['name'] ?? '' }}">
            <input type="hidden" name="items[{{ $key }}][product_price]" value="{{ $item['price'] ?? '' }}">
            <input type="hidden" name="items[{{ $key }}][product_quantity]" value="{{ $item['quantity'] ?? 0 }}">
            <input type="hidden" name="items[{{ $key }}][product_image]" value="{{ $item['options']['image'] ?? '' }}">
            @endforeach
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-inner">
                        <div class="billing-address">
                            <h2>Billing Address</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Name</label>
                                    <input class="form-control" type="text" name="customer_name" placeholder="First Name">
                                </div>
                                <div class="col-md-6">
                                    <label>E-mail</label>
                                    <input class="form-control" type="text" name="customer_email" placeholder="E-mail">
                                </div>
                                <div class="col-md-6">
                                    <label>Mobile No</label>
                                    <input class="form-control" type="text" name="customer_phone" placeholder="Mobile No">
                                </div>
                                <div class="col-md-6">
                                    <label>Provinces</label>
                                    <select id="provinces" name="provinces" class="form-control input-sm choose provinces">
                                        <option value="">---Select provinces---</option>
                                        @foreach ($provinces as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Districts</label>
                                    <div class="input-append">
                                        <select id="districts" name="districts" class="form-control input-sm choose districts">
                                            <option value="">---Select districts---</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Wards</label>
                                    <div class="input-append">
                                        <select id="wards" name="wards" class="form-control input-sm wards">
                                            <option value="">---Select wards---</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label>Address</label>
                                    <input class="form-control" type="text" name="address_detail" placeholder="Address">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout-inner">
                        <div class="checkout-summary">
                            <h1>Cart Total</h1>
                            <p class="sub-total">Sub Total<span id="sub_total">$0</span></p>
                            <p class="ship-cost">Shipping Cost<span>Free</span></p>
                            <h2>Grand Total<span id="total">$0</span></h2>
                        </div>

                        <div class="checkout-payment">
                            <div class="checkout-btn">
                                <button>Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Checkout End -->
@endsection
@section('script-custom')
<script>
    const token = '{{ csrf_token() }}';
    const urlAddress = "{{ route('select-delivery') }}";
</script>
<script src="{{ asset('fe/js/check-out.js') }}"></script>
@endsection
<style>
    label.error {
        color: red;
    }
</style>