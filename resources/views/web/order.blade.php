@extends('layouts.app')
@section('title')
    <title>NhatMai SHOP - @lang('languages.order')</title>
@endsection

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('web.home') }}">@lang('languages.home')</a></li>
                <li class="breadcrumb-item active">@lang('languages.order')</li>
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
                                    <th>@lang('languages.product')</th>
                                    <th>@lang('languages.price')</th>
                                    <th>@lang('languages.quantity')</th>
                                    <th>@lang('languages.total')</th>
                                    <th>@lang('languages.status')</th>
                                    <th>@lang('languages.action')</th>
                                </tr>
                                </thead>
                                <tbody class="align-middle">
                                @if(!empty($order))
                                    @foreach ($order as $value)
                                        @foreach($value->items as $val)
                                            @if(isset($val['status']) && $val['status'] < \App\Constants\Common::ORDER_HIDDEN)
                                                <tr>
                                                    <td>
                                                        <div class="img">
                                                            <a href="{{ route('order.detail', $val['id'] ?? '') }}"><img
                                                                    src="{{ asset('images/'.$val['product_image'] ?? '') }}"
                                                                    alt="Image"></a>
                                                            <p>{{ $val['product_name'] ?? '' }}</p>
                                                        </div>
                                                    </td>
                                                    <td>{{ number_format($val['product_price'] ?? 0, 2) }}{{ config('project.currency') }}</td>
                                                    <td>
                                                        <p>{{ $val['product_quantity'] ?? 0 }}</p>
                                                    </td>
                                                    <td>
                                                        {{ number_format(($val['product_price'] ?? 0) * ($val['product_quantity'] ?? 0), 2) }}{{ config('project.currency') }}</td>
                                                    <td>{{ __(App\Constants\Common::STATUS_ORDER[($val['status'] ?? 0)]) }}</td>
                                                    <td>
                                                            <?php
                                                            $message = __('languages.delete_confirm');
                                                            $cancel_order = __('languages.cancel_order');
                                                            ?>
                                                        @if (($val['status'] ?? 0) < App\Constants\Common::DELIVERY)
                                                            <form id="order-{{ $val['id'] ?? 0 }}"
                                                                  action="{{ route('web.order.cancel', $val['id'] ?? 0) }}"
                                                                  method="post">
                                                                @csrf
                                                            </form>
                                                            <a type="button"
                                                               onclick="return confirm('{{ $cancel_order }}') ? document.getElementById('order-{{ $val->id ?? 0 }}').submit() : false"
                                                               class="delete-cart"><i
                                                                    class="fas fa-window-close"></i></a>
                                                            &emsp;
                                                        @endif
                                                        @if (($val['status'] ?? 0) > App\Constants\Common::DELIVERY)
                                                            <form id="order-delete-{{ $val['id'] ?? 0 }}"
                                                                  action="{{ route('web.order.delete', $val['id'] ?? 0) }}"
                                                                  method="post">
                                                                @csrf
                                                            </form>
                                                            <a type="button"
                                                               onclick="return confirm('{{ $message }}') ? document.getElementById('order-delete-{{ $val->id ?? 0 }}').submit() : false"
                                                               class="delete-cart"><i class="fa fa-trash"></i></a>
                                                            &emsp;
                                                        @endif
                                                        <a href="{{ route('order.detail', $val['id'] ?? '') }}"><i
                                                                class="fas fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            @endif
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
