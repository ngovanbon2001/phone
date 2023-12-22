<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<style>
    body {
        font-family: 'DejaVu Sans', sans-serif;
    }
</style>

<body>
    <div class="section">
        <div class="container">
            <div class="row">
                <div style="display: flex; justify-content: center;"><h1>@lang('languages.order')</h1></div>
                <!-- End Image Column -->
                <!-- Project Info Column -->
                <div class="portfolio-item-description col-sm-6">
                    <h3>@lang('languages.customer')</h3>
                    <ul class="no-list-style">
                        <li><b>@lang('languages.name'):</b> {{ $order['order']['customer_name'] ?? '' }}</li>
                        <li><b>@lang('languages.phone_number'):</b> {{ $order['order']['customer_phone'] ?? '' }}</li>
                        <li><b>@lang('languages.email'):</b> {{ $order['order']['customer_email'] ?? '' }}</li>
                        <li><b>@lang('languages.address'):</b> {{ $order['order']['address'] ?? '' }}</li>
                    </ul>
                    <h3>@lang('languages.product')</h3>
                    <ul class="no-list-style">
                        <img src="{{ $order['product_image'] ?? '' }}" alt="Product Image">
                        <li><b>@lang('languages.product_name'):</b> {{ $order['product_name'] ?? '' }}</li>
                        <li><b>@lang('languages.price') ({{ config('project.currency') }}):</b> {{ number_format($order['product_price'] ?? 0, 2) }}</li>
                        <li><b>@lang('languages.quantity'):</b> {{ $order['product_quantity'] ?? '' }}</li>
                        <li><b>@lang('languages.total') ({{ config('project.currency') }}):</b> {{ number_format((($order['product_price'] ?? 0) * ($order['product_quantity'] ?? 0)), 2) }}</li>
                    </ul>
                </div>
                <!-- End Project Info Column -->
            </div>
        </div>
    </div>
</body>

</html>