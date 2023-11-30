@extends('layouts.app')
@section('title')
<title>NhatMai SHOP - @lang('languages.product_details')</title>
@endsection

@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">@lang('languages.home')</a></li>
            <li class="breadcrumb-item"><a href="{{ route('web.product') }}">@lang('languages.product')</a></li>
            <li class="breadcrumb-item active">@lang('languages.product_details')</li>
            <li class="breadcrumb-item">{{ $product->name ?? '' }}</li>
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
                                <img src="{{ asset($product->image_url ?? '') }}" alt="Product Image">
                                @foreach($product->images as $item)
                                <img src="{{ asset($item->image_url ?? '') }}" alt="Product Image">
                                @endforeach
                            </div>
                            <div class="product-slider-single-nav normal-slider">
                                <div class="slider-nav-img"><img src="{{ asset($product->image_url ?? '') }}" alt="Product Image"></div>
                                @foreach($product->images as $item)
                                <div class="slider-nav-img"><img src="{{ asset($item->image_url ?? '') }}" alt="Product Image"></div>
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
                                        <h4>@lang('languages.price'):</h4>
                                        <p>{{ number_format(($product->price ?? 0)) }}{{ config('project.currency') }} <span>{{ number_format(($product->old_price ?? 0)) }}{{ config('project.currency') }}</span></p>
                                    </div>
                                    <div class="quantity">
                                        <h4>@lang('languages.quantity'):</h4>
                                        <div class="qty">
                                            <button type="button" class="btn-minus"><i class="fa fa-minus"></i></button>
                                            <input id="amount" type="text" name="quantity" value="1">
                                            <button type="button" class="btn-plus"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="p-color">
                                        <div class="input-append" style="display: flex;">
                                            <h4 style="padding-top: 1%;">@lang('languages.color'):</h4>
                                            <select name="color" style="width: 50%;" class="form-control input-sm">
                                                @foreach($product->productColor as $key => $value)
                                                <option value="{{ $value->id ?? '' }}">{{ (isset($value['color']) && $value['color'] !== '') ? __(config('project.color')[$value['color']]) : '' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="action">
                                        <button type="submit" class="btn"><i class="fa fa-shopping-cart"></i> @lang('languages.add_to_cart')</button>
                                    </div>
                                </div>
                                <input type="hidden" value="{{ $product->id ?? 0 }}" name="product_id">
                                <input type="hidden" value="{{ $product->name ?? '' }}" name="product_name">
                                <input type="hidden" value="{{ $product->image_url ?? '' }}" name="product_image">
                                <input type="hidden" value="{{ $product->price ?? 0 }}" name="product_price">
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row product-detail-bottom">
                    <div class="col-lg-12">
                        <ul class="nav nav-pills nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#description">@lang('languages.description')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#specification">@lang('languages.specification')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#reviews">@lang('languages.review')</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="description" class="container tab-pane active">
                                <h4>@lang('languages.product_description')</h4>
                                <p>{!! $product->description ?? '' !!}</p>
                            </div>
                            <div id="specification" class="container tab-pane fade">
                                <h4>@lang('languages.product_specification')</h4>
                                <ul>
                                    <li><b>@lang('languages.screen'): </b>{{ $product->specifications->screen ?? '' }}</li>
                                    <li><b>@lang('languages.operating_system'): </b>{{ $product->specifications->operating_system ?? '' }}</li>
                                    <li><b>@lang('languages.rear_camera'): </b>{{ $product->specifications->rear_camera ?? '' }}</li>
                                    <li><b>@lang('languages.front_camera'): </b>{{ $product->specifications->front_camera ?? '' }}</li>
                                    <li><b>@lang('languages.cpu'): </b>{{ $product->specifications->cpu ?? '' }}</li>
                                    <li><b>@lang('languages.ram'): </b>{{ $product->specifications->ram ?? '' }}</li>
                                    <li><b>@lang('languages.memory_stick'): </b>{{ $product->specifications->memory_stick ?? '' }}</li>
                                    <li><b>@lang('languages.internal_memory'): </b>{{ $product->specifications->internal_memory ?? '' }}</li>
                                    <li><b>@lang('languages.battery'): </b>{{ $product->specifications->battery ?? '' }}</li>
                                </ul>
                            </div>
                            <div id="reviews" class="container tab-pane fade">
                                @if(!empty($comment))
                                @foreach($comment as $value)
                                <div class="reviews-submitted">
                                    <div class="reviewer">{{ $value->user_name ?? '' }} - <span>{{ $value->created_at ?? '' }}</span></div>
                                    <p>
                                        {{ $value->comments ?? '' }}
                                    </p>
                                </div>
                                @endforeach
                                @endif
                                @if(isset(auth()->user()->id))
                                <div class="reviews-submit">
                                    <form action="{{ route('report.create') }}" method="post">
                                        @csrf
                                        <div class="row form">
                                            <input type="hidden" value="{{ auth()->user()->id ?? 0 }}" name="user_id">
                                            <input type="hidden" value="{{ $product->id ?? 0 }}" name="product_id">
                                            <input type="hidden" value="{{ auth()->user()->username ?? '' }}" name="user_name">
                                            <input type="hidden" value="{{ $product->name ?? '' }}" name="product_name">

                                            <div class="col-sm-12">
                                                <textarea placeholder="{{ __('languages.review') }}" name="comments"></textarea>
                                            </div>
                                            <div class="col-sm-12">
                                                <button>@lang('languages.submit')</button>
                                            </div>
                                        </div>
                                    </form>
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product">
                    <div class="section-header">
                        <h1>@lang('languages.new_product')</h1>
                    </div>

                    <div class="row align-items-center product-slider product-slider-3">
                        @foreach($newProduct as $item)
                        <div class="col-lg-3">
                            <div class="product-item">
                                <div class="product-title">
                                    <a href="{{route('web.product.detail', $item->id ?? '')}}">{{ $item->name ?? '' }}</a>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <div class="product-image">
                                    <a href="{{route('web.product.detail', $item->id ?? '')}}">
                                        <img src="{{ asset($item->image_url ?? '') }}" alt="Product Image">
                                    </a>
                                    <div class="product-action">
                                        <a href="{{route('web.product.detail', $item->id ?? '')}}"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-price">
                                    <h3>{{ number_format($item->price ?? 0)}}<span>{{ config('project.currency') }}</span></h3>
                                    <a class="btn" href="{{ route('web.order.build-now', $item->id ?? 0) }}"><i class="fa fa-shopping-cart"></i>@lang('languages.buy_now')</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Side Bar Start -->
            <div class="col-lg-4 sidebar">
                <div class="sidebar-widget category">
                    <h2 class="title">@lang('languages.category')</h2>
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
                                <a href="{{route('web.product.detail', $item->id ?? '')}}">{{ $item->name ?? '' }}</a>
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
                                    <img src="{{ asset($item->image_url ?? '') }}" alt="Product Image">
                                </a>
                                <div class="product-action">
                                    <a href="{{route('web.product.detail', $item->id ?? '')}}"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-price">
                                <h3>{{ number_format($item->price ?? 0)}}<span>{{ config('project.currency') }}</span></h3>
                                <a class="btn" href="{{ route('web.order.build-now', $item->id ?? 0) }}"><i class="fa fa-shopping-cart"></i>@lang('languages.buy_now')</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="sidebar-widget brands">
                    <h2 class="title">@lang('languages.brand')</h2>
                    <ul>
                        @foreach($brands as $item)
                        <li><a href="{{ route('web.product', ['brand_id' => $item->id ?? '', 'category_id' => request('category_id') ?? '', 'name' => request('name') ?? '', 'tags' => request('tags') ?? '']) }}">{{ $item->name ?? '' }} </a><span>{{ $item->products->count() }}</span></li>
                        @endforeach
                    </ul>
                </div>

                <div class="sidebar-widget tag">
                    <h2 class="title">@lang('languages.tags')</h2>
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
            <div class="brand-item"><img src="{{ asset($item->image_url ?? '') }}" alt=""></div>
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