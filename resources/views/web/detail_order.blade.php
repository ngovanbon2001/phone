@extends('layouts.app')

@section('content')
    <!-- Page Title -->
    <div class="section section-breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Your Order</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="section">

        <div class="container">
            <div class="row">
                <!-- Image Column -->
                <div class="col-sm-6">
                    <div class="portfolio-item">
                        <div class="portfolio-image">
                            <a href="#"><img style="width: 50%" src="{{ asset('images/'.$order['product_image'] ?? '') }}" alt="Project Name"></a>
                        </div>
                    </div>
                </div>
                <!-- End Image Column -->
                <!-- Project Info Column -->
                <div class="portfolio-item-description col-sm-6">
                    <h3>Customer</h3>
                    <ul class="no-list-style">
                        <li><b>Name:</b> {{ $order['order']['customer_name'] ?? '' }}</li>
                        <li><b>Phone:</b> {{ $order['order']['customer_phone'] ?? '' }}</li>
                        <li><b>Email:</b> {{ $order['order']['customer_email'] ?? '' }}</li>
                        <li><b>Address:</b> {{ $order['order']['address'] ?? '' }}</li>
                    </ul>
                    <h3>Product</h3>
                    <ul class="no-list-style">
                        <li><b>Product name:</b> {{ $order['product_name'] ?? '' }}</li>
                        <li><b>Price:</b> {{ $order['product_price'] ?? '' }}</li>
                        <li><b>Quantity:</b> {{ $order['product_quantity'] ?? '' }}</li>
                        <li><b>Total:</b> {{ number_format((($order['product_price'] ?? 0) * ($order['product_quantity'] ?? 0)), 2) }}</li>
                        <li class="portfolio-visit-btn"><a href="{{ route('order.pdf', $order['id'] ?? 0) }}" class="btn">Export PDF</a></li>
                    </ul>
                </div>
                <!-- End Project Info Column -->
            </div>
        </div>
    </div>
@endsection
