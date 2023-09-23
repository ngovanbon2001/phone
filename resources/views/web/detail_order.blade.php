@extends('layouts.app')

@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
            <li class="breadcrumb-item active">Order Detail</li>
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
                                    <h2>Product</h2>
                                </div>
                                <div>
                                    <p><b>Product name: </b> <span>{{ $order['product_name'] ?? '' }}</span></p>
                                </div>
                                <div>
                                    <p><b>Price: </b> <span>{{ number_format($order['product_price'] ?? 0, 2) }}</span></p>
                                </div>
                                <div>
                                    <p><b>Quantity: </b> <span>{{ $order['product_quantity'] ?? 0 }}</span></p>
                                </div>
                                <div>
                                    <p><b>Total: </b> <span>{{ number_format((($order['product_price'] ?? 0) * ($order['product_quantity'] ?? 0)), 2) }}</span></p>
                                </div>
                                <div class="title">
                                    <h2>Customer</h2>
                                </div>
                                <div>
                                    <p><b>Name: </b> <span>{{ $order['order']['customer_name'] ?? '' }}</span></p>
                                </div>
                                <div>
                                    <p><b>Phone: </b> <span>{{ $order['order']['customer_phone'] ?? '' }}</span></p>
                                </div>
                                <div>
                                    <p><b>Email: </b> <span>{{ $order['order']['customer_email'] ?? '' }}</span></p>
                                </div>
                                <div>
                                    <p><b>Address: </b> <span>{{ $order['order']['address'] ?? '' }}</span></p>
                                </div>
                                <a href="{{ route('order.pdf', $order['id'] ?? 0) }}" class="btn">Export PDF</a>
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