<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => __('languages.detail_order').' - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@lang('languages.dashboard')</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">@lang('languages.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('indexOrder') }}">@lang('languages.order')</a></li>
                    <li class="breadcrumb-item active">@lang('languages.detail')</li>
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
                                        <h2>{{ $order->customer_name ?? '' }}</h2>
                                        <div style="display: flex;"><b>@lang('languages.phone_number'):</b> &ensp; <p>{{ $order->customer_phone ?? '' }}</p>
                                        </div>
                                        <div style="display: flex;"><b>@lang('languages.email'):</b> &ensp; <p>{{ $order->customer_email ?? '' }}</p>
                                        </div>
                                        <div style="display: flex;"><b>@lang('languages.date'):</b> &ensp; <p>{{ $order->created_at ?? '' }}</p>
                                        </div>
                                        <div style="display: flex;"><b>@lang('languages.address'):</b> &ensp; <p>{{ $order->address ?? '' }}</p>
                                        </div>
                                    </div>

                                </div>

                                <div id="message">
                                    @if (session()->has('message'))
                                    &emsp;
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                    @endif

                                    @if (session()->has('message-error'))
                                    &emsp;
                                    <div class="alert alert-danger">
                                        {{ session('message-error') }}
                                    </div>
                                    @endif
                                </div>

                                &emsp;
                                <table style="width:100%" class="table table-striped">

                                    <thead>
                                        <tr>
                                            <th style="width:15%; text-align: center;">@lang('languages.image')</th>
                                            <th style="width:28%; text-align: center;">@lang('languages.product_name')</th>
                                            <th style="width:10%; text-align: center;">@lang('languages.color')</th>
                                            <th style="width:12%; text-align: center;">@lang('languages.price')</th>
                                            <th style="width:10%; text-align: center;">@lang('languages.quantity')</th>
                                            <th style="width:10%; text-align: center;">@lang('languages.total')</th>
                                            <th style="width:10%; text-align: center;">@lang('languages.status')</th>
                                            <th style="width:10%; text-align: center;">@lang('languages.action')</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (!empty($order['items']))
                                        @foreach ($order['items'] as $value)
                                        <tr>
                                            <td style="text-align: center;"><img src="{{ asset('images/' . $value->product_image ?? '') }}" style="width: 150px;" alt="Khong tai duoc"></td>
                                            <td>{{ $value->product_name ?? ''}}</td>
                                            <td>{{ isset($value['color']) ? colorProduct($value['color']) : '' }}</td>
                                            <td style="text-align: center;">${{ number_format($value->product_price ?? 0) }}</td>
                                            <td style="text-align: center;">{{ $value->product_quantity ?? '' }}</td>
                                            <td style="text-align: center;">${{ number_format($value->product_price * $value->product_quantity) }}</td>
                                            @foreach (App\Constants\Common::STATUS_ORDER as $key => $val)
                                            @if(($value->status ?? 0) == $key)
                                            <td>{{ __($val) }}</td>
                                            @endif
                                            @endforeach
                                            <td>
                                                @if (($value->status ?? 0) < App\Constants\Common::PAID) <form action="{{ route('updateOrder', $value->id) }}" method="post">
                                                    @csrf
                                                    <button class="btn {{ \App\Constants\Common::BUTTON_ORDER[($value->status ?? 0)] }}" type="submit"><i class="bi bi-coin"></i></button>
                                                    </form>
                                                    @endif
                                            </td>
                                            <td>
                                                @if (($value->status ?? 0) < App\Constants\Common::PAID) 
                                                <?php $cancel_order =  __('languages.cancel_order') ?>
                                                <a onclick="return confirm('{{ $cancel_order }}') ? document.getElementById('order-cancel-{{ $value->id ?? 0 }}').submit() : false" class="btn btn-danger"><i class="ri-close-circle-fill"></i></a>
                                                <form id="order-cancel-{{ $value->id ?? 0 }}" action="{{ route('cancel-order', $value->id) }}" method="post">
                                                    @csrf
                                                    </form>
                                                    @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>

                                </table>

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