@extends('layouts.app')

@section('content')
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Product Details</h1>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <!-- Product Image & Available Colors -->
            <div class="col-sm-6">
                <div class="product-image-large">
                    <img src="{{ asset('images/'.$product->image_url ?? '') }}" alt="Item Name">
                </div>
            </div>
            <!-- End Product Image & Available Colors -->
            <!-- Product Summary & Options -->
            <div class="col-sm-6 product-details">
                <h4>{{$product->name ?? ''}}</h4>
                <div class="price">
                    <span class="price-was">${{ number_format($product->old_price) ?? 0}}</span> ${{ number_format($product->price) ?? 0}}
                </div>
                <div style="padding-top: 5px; padding-bottom: 5px;"><b>Category: </b>{{$product->category->name ?? ''}}</div>
                <div style="padding-top: 5px; padding-bottom: 5px;"><b>Brand: </b>{{$product->brand->name ?? ''}}</div>
                <table class="shop-item-selections">
                    <!-- Quantity -->
                    <tr>
                        <td><b>Quantity:</b></td>
                        <td>
                            <input id="amount" type="number" class="form-control input-sm input-micro" value="1">
                        </td>
                    </tr>
                    <!-- Add to Cart Button -->
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <a class="btn btn add-cart" data-id="{{$product->id}}" 
                            data-name="{{$product->name}}" data-price="{{$product->price}}" data-image="{{$product->image_url}}">
                                <i class="icon-shopping-cart icon-white"></i> Add to Cart
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
            <!-- End Product Summary & Options -->

            <!-- Full Description & Specification -->
            <div class="col-sm-12">
                <div class="tabbable">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs product-details-nav">
                        <li class="active"><a href="#tab1" data-toggle="tab">Description</a></li>
                        <li><a href="#tab2" data-toggle="tab">Specification</a></li>
                    </ul>
                    <!-- Tab Content (Full Description) -->
                    <div class="tab-content product-detail-info">
                        <div class="tab-pane active" id="tab1">
                            <p>{!! $product->description !!}</p>
                        </div>
                        <!-- Tab Content (Specification) -->
                        <div class="tab-pane" id="tab2">
                            <table>
                                <tr>
                                    <td>Screen</td>
                                    <td>{{$product->specifications->screen ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Operating system</td>
                                    <td>{{$product->specifications->operating_system ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Rear camera</td>
                                    <td>{{$product->specifications->rear_camera ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Front camera</td>
                                    <td>{{$product->specifications->front_camera ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>CPU</td>
                                    <td>{{$product->specifications->cpu ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>RAM</td>
                                    <td>{{$product->specifications->ram ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Internal memory</td>
                                    <td>{{$product->specifications->internal_memory ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Memory Stick</td>
                                    <td>{{$product->specifications->memory_stick ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Battery</td>
                                    <td>{{$product->specifications->battery ?? ''}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Full Description & Specification -->
        </div>
    </div>
</div>
@endsection