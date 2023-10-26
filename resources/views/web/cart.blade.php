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
                        <table class="table table-bordered">
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
                                @if(!empty($carts))
                                @foreach ($carts as $key => $value)
                                <tr>
                                    <td>
                                        <div class="img">
                                            <a href="{{route('web.product.detail', $value['product_id'])}}"><img src="{{ asset('images/'.$value['options']['image'] ?? '') }}" alt="Image"></a>
                                            <p>{{ $value['name'] ?? '' }}</p>
                                        </div>
                                    </td>
                                    <td>{{ $value['color'] }}</td>
                                    <td>{{ number_format($value['price'] ?? 0, 2) }}{{ config('project.currency') }}</td>
                                    <td>
                                        <div class="qty">
                                            <button class="btn-minus update-cart" data-id="{{ $value['product_id'] ?? 0 }}"><i class="fa fa-minus"></i></button>
                                            <input id="cart-{{ $value['product_id'] ?? 0 }}" class="cart" data-cart="{{ auth()->user()->id ?? 0 }}" data-id="{{ $value['product_id'] ?? 0}}" data-name="{{ $value['name'] ?? ''}}" data-color="{{ $value['color'] ?? ''}}" data-image="{{ $value['options']['image'] ?? '' }}" data-price="{{ $value['price'] ?? 0 }}" data-qty="{{ $value['quantity'] ?? 0 }}" type="number" name="quantity" value="{{ $value['quantity'] ?? 0 }}" oninput="checkQuantity(this)">
                                            <button class="btn-plus update-cart" data-id="{{ $value['product_id'] ?? 0 }}"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </td>
                                    <td id="total-{{ $value['product_id'] ?? 0 }}">{{ number_format(($value['price'] ?? 0) * ($value['quantity'] ?? 0), 2) }}{{ config('project.currency') }}</td>
                                    <td><button type="button" data-id="{{ $value['product_id'] ?? 0 }}" data-color="{{ $value['color'] ?? 0 }}" class="delete-cart"><i class="fa fa-trash"></i></button></td>
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
                                    <h1>@lang('languages.cart_summary')</h1>
                                    <p>@lang('languages.sub_total')<span id="sub_total">$0</span></p>
                                    <p>@lang('languages.shipping_cost')<span>@lang('languages.free')</span></p>
                                    <h2>@lang('languages.grand_total')<span id="total">$0</span></h2>
                                </div>
                                <div class="cart-btn">
                                    <button onclick="document.getElementById('check-out-form').submit()">@lang('languages.checkout')</button>
                                </div>
                                <form id="check-out-form" style="display: none;" action="{{ route('order.create', auth()->user()->id ?? 0) }}" method="get">
                                </form>
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

    function checkQuantity(input) {
        var value = parseFloat(input.value);
        if (value < 1) {
            input.value = 1;
        }
    }
</script>
<script src="{{ asset('fe/js/cart.js') }}"></script>
@endsection