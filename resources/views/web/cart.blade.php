@extends('layouts.app')
@section('title')
<title>NhatMai SHOP - @lang('languages.cart')</title>
@endsection

@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">@lang('languages.home')</a></li>
            <li class="breadcrumb-item active">@lang('languages.cart')</li>
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
                        @if(!empty($carts))
                        <table id="list-cart" class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>@lang('languages.product')</th>
                                    <th>@lang('languages.color')</th>
                                    <th>@lang('languages.price')</th>
                                    <th>@lang('languages.quantity')</th>
                                    <th>@lang('languages.total')</th>
                                    <th>@lang('languages.action')</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @foreach ($carts as $key => $value)
                                <tr>
                                    <td>
                                        <div class="img">
                                            <a href="{{route('web.product.detail', $value['product_id'])}}"><img src="{{ asset($value['options']['image'] ?? '') }}" alt="Image"></a>
                                            <p>{{ $value['name'] ?? '' }}</p>
                                        </div>
                                    </td>
                                    <td>{{ isset($value['color']) ? colorProduct($value['color']) : '' }}</td>
                                    <td>{{ number_format($value['price'] ?? 0, 2) }}{{ config('project.currency') }}</td>
                                    <td>
                                        <div class="qty">
                                            <button class="btn-minus update-cart" data-id="{{ $value['product_id'] ?? 0 }}" data-color="{{ $value['color'] ?? 0 }}"><i class="fa fa-minus"></i></button>
                                            <input id="cart-{{ $value['product_id'] ?? 0 }}-{{ $value['color'] ?? 0 }}" class="cart" data-cart="{{ auth()->user()->id ?? 0 }}" data-id="{{ $value['product_id'] ?? 0}}" data-name="{{ $value['name'] ?? ''}}" data-color="{{ $value['color'] ?? ''}}" data-image="{{ $value['options']['image'] ?? '' }}" data-price="{{ $value['price'] ?? 0 }}" data-qty="{{ $value['quantity'] ?? 0 }}" type="number" name="quantity" value="{{ $value['quantity'] ?? 0 }}" oninput="checkQuantity(this)">
                                            <button class="btn-plus update-cart" data-id="{{ $value['product_id'] ?? 0 }}" data-color="{{ $value['color'] ?? 0 }}"><i class="fa fa-plus"></i></button>
                                        </div>
                                        <p id="color-amount-{{ $value['color'] ?? 0 }}" data-amount="{{ getAmount($value['color'] ?? 0) }}" style="font-size: 10px;">@lang('languages.max'): {{ getAmount($value['color'] ?? 0) }}</p>
                                    </td>
                                    <td id="total-{{ $value['product_id'] ?? 0 }}-{{ $value['color'] ?? 0 }}">{{ number_format(($value['price'] ?? 0) * ($value['quantity'] ?? 0), 2) }}{{ config('project.currency') }}</td>
                                    <td><button type="button" data-id="{{ $value['product_id'] ?? 0 }}" data-color="{{ $value['color'] ?? 0 }}" class="delete-cart"><i class="fa fa-trash"></i></button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <div><p>@lang('languages.cart_empty')</p></div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart-page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="cart-summary">
                                <div class="cart-content">
                                    <h1>@lang('languages.cart_summary')</h1>
                                    <p>@lang('languages.sub_total') ({{ config('project.currency') }})<span id="sub_total">$0</span></p>
                                    <p>@lang('languages.shipping_cost')<span>@lang('languages.free')</span></p>
                                    <h2>@lang('languages.grand_total') ({{ config('project.currency') }})<span id="total">$0</span></h2>
                                </div>
                                @if(!empty($carts))
                                <div id="check-out" class="cart-btn">
                                    <button onclick="document.getElementById('check-out-form').submit()">@lang('languages.checkout')</button>
                                    <form id="check-out-form" style="display: none;" action="{{ route('order.create', auth()->user()->id ?? 0) }}" method="get">
                                    </form>
                                </div>
                                @endif
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
    const deleteUrl = '{{ route("cart.destroy", [":productId", ":colorId"]) }}';

    const updateUrl = '{{ route("cart.update") }}';

    const token = '{{ csrf_token() }}';

    const urlAddress = "{{ route('select-delivery') }}";

    const cart_empty = "{{ __('languages.cart_empty') }}";

    function checkQuantity(input) {
        var value = parseFloat(input.value);
        var color = input.dataset.color;
        var max = $('#color-amount-' + color).data('amount');
        if (value < 1) {
            input.value = 1;
        } else if (value > max) {
            input.value = max;
        }
    }
</script>
<script src="{{ asset('fe/js/cart.js') }}"></script>
@endsection