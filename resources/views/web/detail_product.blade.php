@extends('layouts.app')
@section('title')
<title>NhatMai SHOP - Product detail</title>
@endsection

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

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('web.product') }}">Products</a></li>
            <li class="breadcrumb-item active">Product Detail</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product Detail Start -->
<div class="product-detail">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="product-detail-top">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div class="product-slider-single normal-slider">
                                <img src="{{ asset('images/'. ($product->image_url ?? '')) }}" alt="Product Image">
                                @foreach($product->images as $item)
                                <img src="{{ asset('images/'. ($item->image_url ?? '')) }}" alt="Product Image">
                                @endforeach
                            </div>
                            <div class="product-slider-single-nav normal-slider">
                                <div class="slider-nav-img"><img src="{{ asset('images/'. ($product->image_url ?? '')) }}" alt="Product Image"></div>
                                @foreach($product->images as $item)
                                <div class="slider-nav-img"><img src="{{ asset('images/'. ($item->image_url ?? '')) }}" alt="Product Image"></div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-7">
                            <form action="{{ route('cart.create') }}" method="post">
                                @csrf
                                <div class="product-content">
                                    <div class="title">
                                        <h2>{{ $product->name ?? '' }}</h2>
                                    </div>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="price">
                                        <h4>Price:</h4>
                                        <p>${{ number_format(($product->price ?? 0)) }} <span>${{ number_format(($product->old_price ?? 0)) }}</span></p>
                                    </div>
                                    <div class="quantity">
                                        <h4>Quantity:</h4>
                                        <div class="qty">
                                            <button type="button" class="btn-minus"><i class="fa fa-minus"></i></button>
                                            <input id="amount" type="text" name="quantity" value="1">
                                            <button type="button" class="btn-plus"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div>
                                        <h4>Brand: {{ $product->brand->name ?? '' }}</h4>
                                    </div>
                                    <div>
                                        <h4>Category: {{ $product->category->name ?? '' }}</h4>
                                    </div>
                                    <div class="action">
                                        <button type="submit" class="btn"><i class="fa fa-shopping-cart"></i>Add to Cart</button>
                                    </div>
                                </div>
                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                <input type="hidden" value="{{ $product->name }}" name="product_name">
                                <input type="hidden" value="{{ $product->image_url }}" name="product_image">
                                <input type="hidden" value="{{ $product->price }}" name="product_price">
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row product-detail-bottom">
                    <div class="col-lg-12">
                        <ul class="nav nav-pills nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#description">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#specification">Specification</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="description" class="container tab-pane active">
                                <h4>Product description</h4>
                                <p>{!! $product->description ?? '' !!}</p>
                            </div>
                            <div id="specification" class="container tab-pane fade">
                                <h4>Product specification</h4>
                                <ul>
                                    <li><b>Screen: </b>{{ $product->specifications->screen ?? '' }}</li>
                                    <li><b>Operating system: </b>{{ $product->specifications->operating_system ?? '' }}</li>
                                    <li><b>Rear camera: </b>{{ $product->specifications->rear_camera ?? '' }}</li>
                                    <li><b>Front camera: </b>{{ $product->specifications->front_camera ?? '' }}</li>
                                    <li><b>Cpu: </b>{{ $product->specifications->cpu ?? '' }}</li>
                                    <li><b>Ram: </b>{{ $product->specifications->ram ?? '' }}</li>
                                    <li><b>Memory stick: </b>{{ $product->specifications->memory_stick ?? '' }}</li>
                                    <li><b>Internal memory: </b>{{ $product->specifications->internal_memory ?? '' }}</li>
                                    <li><b>Battery: </b>{{ $product->specifications->battery ?? '' }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product">
                    <div class="section-header">
                        <h1>New Products</h1>
                    </div>

                    <div class="row align-items-center product-slider product-slider-3">
                        @foreach($newProduct as $item)
                        <div class="col-lg-3">
                            <div class="product-item">
                                <div class="product-title">
                                    <a href="{{route('web.product.detail', $item->id)}}">{{ $item->name }}</a>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <div class="product-image">
                                    <a href="{{route('web.product.detail', $item->id)}}">
                                        <img src="{{ asset('images/'.$item->image_url) }}" alt="Product Image">
                                    </a>
                                    <div class="product-action">
                                        <a onclick="document.getElementById('cart-add-{{ $item->id ?? 0 }}').submit()" href="#"><i class="fa fa-cart-plus"></i></a>
                                        <a href="{{route('web.product.detail', $item->id)}}"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-price">
                                    <h3><span>$</span>{{ number_format($item->price) }}</h3>
                                    <a class="btn" onclick="document.getElementById('cart-add-{{ $item->id ?? 0 }}').submit()" href="#"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                                </div>
                            </div>
                            <form id="cart-add-{{ $item->id ?? 0 }}" action="{{ route('cart.create') }}" method="post" class="cart">
                                @csrf
                                <input type="hidden" value="{{ $item->id ?? 0 }}" name="product_id">
                                <input type="hidden" value="1" name="quantity">
                                <input type="hidden" value="{{ $item->name ?? '' }}" name="product_name">
                                <input type="hidden" value="{{ $item->image_url ?? '' }}" name="product_image">
                                <input type="hidden" value="{{ $item->price ?? 0 }}" name="product_price">
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Side Bar Start -->
            <div class="col-lg-4 sidebar">
                <div class="sidebar-widget category">
                    <h2 class="title">Category</h2>
                    <nav class="navbar bg-light">
                        <ul class="navbar-nav">
                            @foreach($categories as $item)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('web.product', ['category_id' => $item->id ?? '', 'brand_id' => request('brand_id') ?? '', 'name' => request('name') ?? '', 'tags' => request('tags') ?? '']) }}"><i class="fa fa-mobile-alt"></i>{{ $item->name ?? '' }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>

                <div class="sidebar-widget widget-slider">
                    <div class="sidebar-slider normal-slider">
                        @foreach ($products as $item)
                        <div class="product-item">
                            <div class="product-title">
                                <a href="#">{{ $item->name ?? '' }}</a>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <div class="product-image">
                                <a href="product-detail.html">
                                    <img src="{{ asset('images/'.$item->image_url) }}" alt="Product Image">
                                </a>
                                <div class="product-action">
                                    <a onclick="document.getElementById('cart-add-{{ $item->id ?? 0 }}').submit()" href="#"><i class="fa fa-cart-plus"></i></a>
                                    <a href="{{route('web.product.detail', $item->id)}}"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-price">
                                <h3><span>$</span>{{ number_format($item->price) }}</h3>
                                <a class="btn" onclick="document.getElementById('cart-add-{{ $item->id ?? 0 }}').submit()" href="#"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                            </div>
                            <form id="cart-add-{{ $item->id ?? 0 }}" action="{{ route('cart.create') }}" method="post" class="cart">
                                @csrf
                                <input type="hidden" value="{{ $item->id ?? 0 }}" name="product_id">
                                <input type="hidden" value="1" name="quantity">
                                <input type="hidden" value="{{ $item->name ?? '' }}" name="product_name">
                                <input type="hidden" value="{{ $item->image_url ?? '' }}" name="product_image">
                                <input type="hidden" value="{{ $item->price ?? 0 }}" name="product_price">
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="sidebar-widget brands">
                    <h2 class="title">Our Brands</h2>
                    <ul>
                        @foreach($brands as $item)
                        <li><a href="{{ route('web.product', ['brand_id' => $item->id ?? '', 'category_id' => request('category_id') ?? '', 'name' => request('name') ?? '', 'tags' => request('tags') ?? '']) }}">{{ $item->name ?? '' }} </a><span>{{ $item->products->count() }}</span></li>
                        @endforeach
                    </ul>
                </div>

                <div class="sidebar-widget tag">
                    <h2 class="title">Tags Cloud</h2>
                    @foreach ($tags as $item)
                    @if($item->tags !== null)
                    <a href="{{ route('web.product', ['category_id' => request('category_id') ?? '', 'brand_id' => request('brand_id') ?? '', 'name' => request('name') ?? '', 'tags' => $item->tags ?? '']) }}">{{ $item->tags }}</a>
                    @endif
                    @endforeach
                </div>
            </div>
            <!-- Side Bar End -->
        </div>
    </div>
</div>
<!-- Product Detail End -->

<!-- Brand Start -->
<div class="brand">
    <div class="container-fluid">
        <div class="brand-slider">
            @foreach($brands as $item)
            <div class="brand-item"><img src="{{ asset('images/'.$item->image_url) }}" alt=""></div>
            @endforeach
        </div>
    </div>
</div>
<!-- Brand End -->
@endsection
@section('script-custom')
<script>
    const toastrSuccess = '{{ session("success") }}';
    const toastrError = '{{ session("error") }}';
    if (toastrSuccess) {
        showToasrt(toastrSuccess, true);
    } else if (toastrError) {
        showToasrt(toastrError, false);
    }
</script>
@endsection