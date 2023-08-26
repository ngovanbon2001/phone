<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => 'Detail order - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('indexOrder') }}">Order</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <div class="card-body">
                            <div class="table-responsive">

                                <div class="card-header">

                                    <div class="product-inner">
                                        <h2 class="product-name">{{ $order->customer_name }}</h2>
                                        <div style="display: flex;"><b>Phone:</b> &ensp; <p>{{ $order->customer_phone }}</p>
                                        </div>
                                        <div style="display: flex;"><b>Email:</b> &ensp; <p>{{ $order->customer_email }}</p>
                                        </div>
                                        <div style="display: flex;"><b>Date:</b> &ensp; <p>{{ $order->created_date }}</p>
                                        </div>
                                        <div style="display: flex;"><b>Address:</b> &ensp; <p>{{ $order->address }}</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="widget-content">
                                    <table style="width:100%" class="table table-striped">

                                        <thead>
                                            <tr>
                                                <th style="width:5%; text-align: center;">No</th>
                                                <th style="width:15%; text-align: center;">Image</th>
                                                <th style="width:38%;">Product name</th>
                                                <th style="width:12%; text-align: center;">Price</th>
                                                <th style="width:10%; text-align: center;">Quantity</th>
                                                <th style="width:10%; text-align: center;">Amount</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($itemOrder as $key => $itemOrderData)
                                            <tr>
                                                <td style="text-align: center;">{{ $key + 1 }}</td>
                                                <td style="text-align: center;"><img src="../images/{{ $itemOrderData->product_image }}" height="50px" width="150px" alt="Khong tai duoc"></td>
                                                <td>{{ $itemOrderData->product_name }}</td>
                                                <td style="text-align: right;">${{ number_format($itemOrderData->product_price) }}</td>
                                                <td style="text-align: center;">{{ $itemOrderData->product_quantity }}</td>
                                                <td style="text-align: right;">${{ number_format($itemOrderData->product_price * $itemOrderData->product_quantity) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>

                                    <div style="margin-left: 80%;">
                                        <div style="display: flex;"><b>Total product:</b> &ensp; <p>{{ $order->total_products }}</p>
                                        </div>
                                        <div style="display: flex;"><b>Total money:</b> &ensp; $<p>{{ number_format($order->total_money) }}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div><!-- End Left side columns -->

            </div>
        </section>
    </main><!-- End #main -->

    @include ('admin.common.footer')
</body>

</html>