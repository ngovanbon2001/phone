@extends('layouts.app')
@section('title')
<title>NhatMai SHOP - @lang('languages.checkout')</title>
@endsection
@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">@lang('languages.home')</a></li>
            <li class="breadcrumb-item active">@lang('languages.checkout')</li>
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
            <input type="hidden" name="items[{{ $key }}][color]" value="{{ $item['color'] ?? '' }}">
            @endforeach
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-inner">
                        <div class="billing-address">
                            <h2>@lang('languages.billing_address')</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>@lang('languages.name')</label>
                                    <input class="form-control" type="text" name="customer_name" value="{{ auth()->user()->username ?? '' }}" placeholder="{{ __('languages.name') }}">
                                </div>
                                <div class="col-md-6">
                                    <label>@lang('languages.email')</label>
                                    <input class="form-control" type="text" name="customer_email" value="{{ auth()->user()->email ?? '' }}" placeholder="{{ __('languages.email') }}">
                                </div>
                                <div class="col-md-6">
                                    <label>@lang('languages.phone_number')</label>
                                    <input class="form-control" type="text" name="customer_phone" value="{{ auth()->user()->phone ?? '' }}" placeholder="{{ __('languages.phone_number') }}">
                                </div>
                                <div class="col-md-6">
                                    <label>@lang('languages.provinces')</label>
                                    <select id="provinces" name="provinces" class="form-control input-sm choose provinces">
                                        <option value="">---@lang('languages.provinces')---</option>
                                        @foreach ($provinces as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>@lang('languages.districts')</label>
                                    <div class="input-append">
                                        <select id="districts" name="districts" class="form-control input-sm choose districts">
                                            <option value="">---@lang('languages.districts')---</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>@lang('languages.wards')</label>
                                    <div class="input-append">
                                        <select id="wards" name="wards" class="form-control input-sm wards">
                                            <option value="">---@lang('languages.wards')---</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label>@lang('languages.address')</label>
                                    <input class="form-control" type="text" name="address_detail" placeholder="{{ __('languages.address') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout-inner">
                        <div class="checkout-summary">
                            <h1>@lang('languages.cart_total')</h1>
                            <p class="sub-total">@lang('languages.sub_total')<span id="sub_total">$0</span></p>
                            <p class="ship-cost">@lang('languages.shipping_cost')<span>@lang('languages.free')</span></p>
                            <h2>@lang('languages.grand_total')<span id="total">$0</span></h2>
                        </div>

                        <div class="checkout-payment">
                            <div class="checkout-btn">
                                <button>@lang('languages.place_order')</button>
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
    const messages = {
        customer_name: "{{ __('validation.required', ['attribute' => __('languages.name')]) }}",
        customer_email_required: "{{ __('validation.required', ['attribute' => __('languages.email')]) }}",
        customer_email: "{{ __('validation.email', ['attribute' => __('languages.email')]) }}",
        customer_phone: "{{ __('validation.required', ['attribute' => __('languages.provinces')]) }}",
        provinces: "{{ __('validation.required', ['attribute' => __('languages.provinces')]) }}",
        districts: "{{ __('validation.required', ['attribute' => __('languages.districts')]) }}",
        wards: "{{ __('validation.required', ['attribute' => __('languages.wards')]) }}",
    };
</script>
<script src="{{ asset('fe/js/check-out.js') }}"></script>
@endsection
<style>
    label.error {
        color: red;
    }
</style>