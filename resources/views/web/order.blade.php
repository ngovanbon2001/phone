<script>
    setTimeout(function() {
        $(".alert").alert("close");
    }, 3000);
</script>

@extends('layouts.app')

@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
            <li class="breadcrumb-item active">Order</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Cart Start -->
<div class="cart-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                @if (Session::has('message'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('message') }}
                </div>
                @endif

                @if (Session::has('message-error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('message-error') }}
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="cart-page-inner">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @if(!empty($order))
                                @foreach ($order as $value)
                                @foreach($value->items as $val)
                                <tr>
                                    <td>
                                        <div class="img">
                                            <a href="{{ route('order.detail', $val['id']) }}"><img src="{{ asset('images/'.$val['product_image'] ?? '') }}" alt="Image"></a>
                                            <p>{{ $val['product_name'] ?? '' }}</p>
                                        </div>
                                    </td>
                                    <td>${{ $val['product_price'] ?? 0 }}</td>
                                    <td>
                                        <p>{{ $val['product_quantity'] ?? 0 }}</p>
                                    </td>
                                    <td>${{ ($val['product_price'] ?? 0) * ($val['product_quantity'] ?? 0) }}</td>
                                    <td>{{ App\Constants\Common::STATUS_ORDER[($val['status'] ?? 0)] }}</td>
                                    <td>
                                        @if (($val['status'] ?? 0) < App\Constants\Common::DELIVERY) 
                                        <form id="order-{{ $val['id'] ?? 0 }}" action="{{ route('web.order.cancel', $val['id'] ?? 0) }}" method="post">
                                            @csrf
                                        </form>
                                        <a type="button" onclick="return confirm('Are you sure you want to delete this item?') ? document.getElementById('order-{{ $val->id ?? 0 }}').submit() : false" class="delete-cart"><i class="fa fa-trash"></i></a>
                                         @endif
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection