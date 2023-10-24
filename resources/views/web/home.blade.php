@extends('layouts.app')
@section('title')
<title>NhatMai SHOP - @lang('languages.home')</title>
@endsection

@section('content')

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

<section>
    <!-- Main Slider Start -->
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <nav class="navbar bg-light">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('web.home') }}"><i class="fa fa-home"></i>@lang('languages.home')</a>
                            </li>

                            @foreach($categories as $item)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('web.product', ['category_id' => $item->id ?? 0]) }}"><i class="fa fa-mobile-alt"></i>{{ $item->name ?? '' }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
                <div class="col-md-6">
                    <div class="header-slider normal-slider">
                        @foreach ($banners as $key => $item)
                        <div class="header-slider-item">
                            <img src="{{ asset('images/'.$item->image_url ?? '') }}" alt="Slider Image" />
                            <div class="header-slider-caption">
                                <p>{{ $item->title ?? "" }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="header-img">
                        <div class="img-item">
                            <img src="{{ asset('fe/img/chinh-hang-a.png') }}" />
                            <a class="img-text" href="">
                                <p>@lang('languages.genuine')</p>
                            </a>
                        </div>
                        &emsp14;
                        <div class="img-item">
                            <img src="{{ asset('fe/img/van-chuyen-1.png') }}" />
                            <a class="img-text" href="">
                                <p>@lang('languages.free_ship')</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Slider End -->

    <!-- Brand Start -->
    <div class="brand">
        <div class="container-fluid">
            <div class="brand-slider">
                @foreach ($brands as $key => $item)
                <div class="brand-item"><img src="{{ asset('images/'.$item->image_url ?? '') }}" alt=""></div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Brand End -->

    <!-- Feature Start-->
    <div class="feature">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fab fa-cc-mastercard"></i>
                        <h2>Secure Payment</h2>
                        <p>
                            @lang('languages.lorem_ipsum')
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-truck"></i>
                        <h2>Worldwide Delivery</h2>
                        <p>
                            @lang('languages.lorem_ipsum')
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-sync-alt"></i>
                        <h2>90 Days Return</h2>
                        <p>
                            @lang('languages.lorem_ipsum')
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-comments"></i>
                        <h2>24/7 Support</h2>
                        <p>
                            @lang('languages.lorem_ipsum')
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End-->

    <!-- Category Start-->
    <div class="category">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="category-item ch-400">
                        <img src="{{ asset('fe/img/quang-cao-1.jpg') }}" />
                        <a class="category-name" href="">
                            <p>@lang('languages.description')</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="category-item ch-250">
                        <img src="{{ asset('fe/img/quang-cao-3.jpg') }}" />
                        <a class="category-name" href="">
                            <p>@lang('languages.description')</p>
                        </a>
                    </div>
                    <div class="category-item ch-150">
                        <img src="{{ asset('fe/img/quang-cao-2.jpg') }}" />
                        <a class="category-name" href="">
                            <p>@lang('languages.description')</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="category-item ch-150">
                        <img src="{{ asset('fe/img/quang-cao-4.jpg') }}" />
                        <a class="category-name" href="">
                            <p>@lang('languages.description')</p>
                        </a>
                    </div>
                    <div class="category-item ch-250">
                        <img src="{{ asset('fe/img/quang-cao-5.png') }}" />
                        <a class="category-name" href="">
                            <p>@lang('languages.description')</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="category-item ch-400">
                        <img src="{{ asset('fe/img/quang-cao-6.png') }}" />
                        <a class="category-name" href="">
                            <p>@lang('languages.description')</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Category End-->

    <!-- Call to Action Start -->
    <div class="call-to-action">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1>@lang('languages.call_us')</h1>
                </div>
                <div class="col-md-6">
                    <a href="tel:0123456789">+012-345-6789</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Call to Action End -->

    <!-- Featured Product Start -->
    <div class="featured-product product">
        <div class="container-fluid">
            <div class="section-header">
                <h1>@lang('languages.new_product')</h1>
            </div>
            <div class="row align-items-center product-slider product-slider-4">
                @foreach ($newProduct as $item)
                <div class="col-lg-3">

                    <div class="product-item">
                        <div class="product-title">
                            <a href="#">{{ $item->name ?? ''}}</a>
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
                                <img src="{{asset('images/'.$item->image_url ?? '')}}" alt="Product Image">
                            </a>
                            <div class="product-action">
                                <a href="#" onclick="document.getElementById('cart-add-{{ $item->id ?? 0 }}').submit()"><i class="fa fa-cart-plus"></i></a>
                                <a href="{{route('web.product.detail', $item->id)}}"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="product-price">
                            <h3><span>$</span>{{ number_format($item->price ?? 0)}}</h3>
                            <a class="btn" onclick="document.getElementById('cart-add-{{ $item->id ?? 0 }}').submit()" href="#"><i class="fa fa-shopping-cart"></i>@lang('languages.buy_now')</a>
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
    <!-- Featured Product End -->

    <!-- Recent Product Start -->
    <div class="recent-product product">
        <div class="container-fluid">
            <div class="section-header">
                <h1>@lang('languages.low_price')</h1>
            </div>
            <div class="row align-items-center product-slider product-slider-4">
                @foreach ($discountProduct as $item)
                <div class="col-lg-3">

                    <div class="product-item">
                        <div class="product-title">
                            <a href="#">{{ $item->name ?? ''}}</a>
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
                                <img src="{{asset('images/'.$item->image_url ?? '')}}" alt="Product Image">
                            </a>
                            <div class="product-action">
                                <a href="#" onclick="document.getElementById('cart-add-{{ $item->id ?? 0 }}').submit()"><i class="fa fa-cart-plus"></i></a>
                                <a href="{{route('web.product.detail', $item->id)}}"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="product-price">
                            <h3><span>$</span>{{ number_format($item->price ?? 0)}}</h3>
                            <a class="btn" onclick="document.getElementById('cart-add-{{ $item->id ?? 0 }}').submit()" href="#"><i class="fa fa-shopping-cart"></i>@lang('languages.buy_now')</a>
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
    <!-- Recent Product End -->
</section> <!-- End Section -->
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