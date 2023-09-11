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

        <div id="message">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if (session()->has('message-error'))
                <div class="alert alert-danger">
                    {{ session('message-error') }}
                </div>
            @endif
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Shopping Cart Items -->
                    <table class="shopping-cart">
                        @if(!empty($order))
                            @foreach ($order as $value)
                                @foreach($value->items as $val)
                                    <!-- Shopping Cart Item -->
                                    <tr>
                                        <!-- Shopping Cart Item Image -->
                                        <td class="image"><a href="page-product-details.html"><img
                                                    src="{{ asset('images/'.$val['product_image'] ?? '') }}"
                                                    alt="Item Name"></a></td>
                                        <!-- Shopping Cart Item Description & Features -->
                                        <td>
                                            <div class="cart-item-title"><a
                                                    href="page-product-details.html">{{ $val['product_name'] ?? '' }}</a>
                                            </div>
                                        </td>
                                        <!-- Shopping Cart Item Quantity -->
                                        <td class="quantity">
                                            <div class="cart-item-title"><a
                                                    href="page-product-details.html">{{ $val['product_quantity'] ?? '' }}</a>
                                            </div>
                                        </td>
                                        <!-- Shopping Cart Item Price -->
                                        <td class="price">${{ $val['product_price'] ?? 0 }}</td>
                                        <!-- Shopping Cart Item Actions -->
                                        <td class="actions">
                                            <a href="#" class="btn btn-xs btn-grey"><i
                                                    class="glyphicon glyphicon-trash"></i></a>
                                        </td>
                                    </tr>
                                    <!-- End Shopping Cart Item -->
                                @endforeach
                            @endforeach
                        @endif
                    </table>
                    <!-- End Shopping Cart Items -->
                </div>
            </div>
        </div>
    </div>
@endsection
