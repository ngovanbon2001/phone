@extends('layouts.app')
@section('title')
    <title>NhatMai SHOP - @lang('languages.buy_now')</title>
@endsection

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('web.home') }}">@lang('languages.home')</a></li>
                <li class="breadcrumb-item active">@lang('languages.buy_now')</li>
                <li class="breadcrumb-item">{{ $product->name ?? '' }}</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Detail Start -->
    <div class="product-detail">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-detail-top">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="product-slider-single normal-slider">
                                    <img src="{{ asset($product->image_url ?? '') }}" alt="Product Image">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <form id="check-out-form" action="{{ route('web.order.build') }}" method="post">
                                    @csrf
                                    <div class="product-content">
                                        <div class="title">
                                            <h2>{{ $product->name ?? '' }}</h2>
                                        </div>
                                        <div class="ratting">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="price">
                                            <h4>@lang('languages.price'):</h4>
                                            <p>{{ number_format(($product->price ?? 0)) }}{{ config('project.currency') }}
                                                <span>{{ number_format(($product->old_price ?? 0)) }}{{ config('project.currency') }}</span>
                                            </p>
                                        </div>
                                        <div class="quantity">
                                            <h4>@lang('languages.quantity'):</h4>
                                            <div class="qty">
                                                <button type="button" class="btn-minus"><i class="fa fa-minus"></i>
                                                </button>
                                                <input id="amount" type="text"
                                                       name="items[{{ $product->id ?? 0 }}][product_quantity]"
                                                       value="1">
                                                <button type="button" class="btn-plus"><i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="p-color">
                                            <div class="input-append" style="display: flex;">
                                                <h4 style="padding-top: 1%;">@lang('languages.color'):</h4>
                                                <select name="items[{{ $product->id ?? 0 }}][color]" style="width: 50%;"
                                                        class="form-control input-sm">
                                                    @foreach($product->productColor as $key => $value)
                                                        <option
                                                            value="{{ $value->id ?? '' }}">{{ (isset($value['color']) && $value['color'] !== '') ? __(config('project.color')[$value['color']]) : '' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="items[{{ $product->id ?? 0 }}][product_id]"
                                           value="{{ $product->id ?? 0 }}">
                                    <input type="hidden" name="items[{{ $product->id ?? 0 }}][product_name]"
                                           value="{{ $product->name ?? '' }}">
                                    <input type="hidden" name="items[{{ $product->id ?? 0 }}][product_price]"
                                           value="{{ $product->price ?? 0 }}">
                                    <input type="hidden" name="items[{{ $product->id ?? 0 }}][product_image]"
                                           value="{{ $product->image_url ?? '' }}">
                                    <div class="col-lg-12">
                                        <div class="checkout-inner">
                                            <div class="billing-address">
                                                <h2>@lang('languages.billing_address')</h2>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>@lang('languages.name')</label>
                                                        <input class="form-control" type="text" name="customer_name"
                                                               value="{{ auth()->user()->username ?? '' }}"
                                                               placeholder="{{ __('languages.name') }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>@lang('languages.email')</label>
                                                        <input class="form-control" type="text" name="customer_email"
                                                               value="{{ auth()->user()->email ?? '' }}"
                                                               placeholder="{{ __('languages.email') }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>@lang('languages.phone_number')</label>
                                                        <input class="form-control" type="text" name="customer_phone"
                                                               value="{{ auth()->user()->phone ?? '' }}"
                                                               placeholder="{{ __('languages.phone_number') }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>@lang('languages.provinces')</label>
                                                        <select id="provinces" name="provinces"
                                                                class="form-control input-sm choose provinces">
                                                            <option value="">---@lang('languages.provinces')---</option>
                                                            @foreach ($provinces as $value)
                                                                <option
                                                                    value="{{ $value->id }}">{{ $value->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>@lang('languages.districts')</label>
                                                        <div class="input-append">
                                                            <select id="districts" name="districts"
                                                                    class="form-control input-sm choose districts">
                                                                <option value="">---@lang('languages.districts')---
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>@lang('languages.wards')</label>
                                                        <div class="input-append">
                                                            <select id="wards" name="wards"
                                                                    class="form-control input-sm wards">
                                                                <option value="">---@lang('languages.wards')---</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label>@lang('languages.address')</label>
                                                        <input class="form-control" type="text" name="address_detail"
                                                               placeholder="{{ __('languages.address') }}">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn"><i
                                                                class="fa fa-shopping-cart"></i> @lang('languages.place_order')
                                                        </button>
                                                    </div>
                                                    &emsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Detail End -->
@endsection
@section('script-custom')
    <script>
        const token = '{{ csrf_token() }}';

        const urlAddress = "{{ route('select-delivery') }}";
    </script>
    <script src="{{ asset('fe/js/check-out.js') }}"></script>
@endsection
