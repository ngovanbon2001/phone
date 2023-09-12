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
                <div style="display: flex; justify-content: center;"><h1>Your Bill</h1></div>
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
                    </ul>
                </div>
                <!-- End Project Info Column -->
            </div>
        </div>
    </div>
</body>

</html>