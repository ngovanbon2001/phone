@extends('layouts.app')
@section('title')
<title>NhatMai SHOP - @lang('languages.order_detail')</title>
@endsection

@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">@lang('languages.home')</a></li>
            <li class="breadcrumb-item active">@lang('languages.order_detail')</li>
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
                        <div class="col-md-5">
                            <div class="product-slider-single">
                                <img src="{{ asset('images/'.$order['product_image'] ?? '') }}" alt="Product Image">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="product-content">
                                <div class="title">
                                    <h2>@lang('languages.product')</h2>
                                </div>
                                <div>
                                    <p><b>@lang('languages.product_name'): </b> <span>{{ $order['product_name'] ?? '' }}</span></p>
                                </div>
                                <div>
                                    <p><b>@lang('languages.price'): </b> <span>{{ number_format($order['product_price'] ?? 0, 2) }}</span></p>
                                </div>
                                <div>
                                    <p><b>@lang('languages.quantity'): </b> <span>{{ $order['product_quantity'] ?? 0 }}</span></p>
                                </div>
                                <div>
                                    <p><b>@lang('languages.total'): </b> <span>{{ number_format((($order['product_price'] ?? 0) * ($order['product_quantity'] ?? 0)), 2) }}</span></p>
                                </div>
                                <div class="title">
                                    <h2>@lang('languages.customer')</h2>
                                </div>
                                <div>
                                    <p><b>@lang('languages.name'): </b> <span>{{ $order['order']['customer_name'] ?? '' }}</span></p>
                                </div>
                                <div>
                                    <p><b>@lang('languages.phone_number'): </b> <span>{{ $order['order']['customer_phone'] ?? '' }}</span></p>
                                </div>
                                <div>
                                    <p><b>@lang('languages.email'): </b> <span>{{ $order['order']['customer_email'] ?? '' }}</span></p>
                                </div>
                                <div>
                                    <p><b>@lang('languages.address'): </b> <span>{{ $order['order']['address'] ?? '' }}</span></p>
                                </div>
                                <a href="{{ route('order.pdf', $order['id'] ?? 0) }}" class="btn">@lang('languages.export_pdf')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Side Bar End -->
        </div>
    </div>
</div>
<!-- Product Detail End -->
@endsection