@extends('layouts.app')
@section('title')
<title>NhatMai SHOP - @lang('languages.product')</title>
@endsection

@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">@lang('languages.home')</a></li>
            <li class="breadcrumb-item"><a href="{{ route('web.product') }}">@lang('languages.product')</a></li>
            <li class="breadcrumb-item active">@lang('languages.product_list')</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product List Start -->
<div class="product-view">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-view-top">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="product-search">
                                        <form action="{{ route('web.product') }}" method="get">
                                            <input type="hidden" name="brand_id" value="{{ request('brand_id') ?? '' }}">
                                            <input type="hidden" name="category_id" value="{{ request('category_id') ?? '' }}">
                                            <input type="hidden" name="tags" value="{{ request('tags') ?? '' }}">
                                            <input type="text" name="name" placeholder="{{ __('languages.product_name') }}" value="{{ request('name') ?? '' }}">
                                            <button type="submit"><i class="fa fa-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="product-short">
                                        <select id="brandSelect" class="form-control input-sm select-search">
                                            <option value="">@lang('languages.brand')</option>
                                            @foreach($brands as $item)
                                            <option value="{{ $item->id ?? '' }}" {{ ((request('brand_id') ?? '') == $item->id) ? 'selected' : ''  }}>{{ $item->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="product-price-range">
                                        <select id="categorySelect" class="form-control input-sm select-search">
                                            <option value="">@lang('languages.category')</option>
                                            @foreach($categories as $item)
                                            <option value="{{ $item->id ?? '' }}" {{ ((request('category_id') ?? '') == $item->id) ? 'selected' : ''  }}>{{ $item->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($products as $item)
                    <div class="col-md-4">
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

                <!-- Pagination Start -->
                <div class="col-md-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="{{ $products->appends(request()->except('page'))->previousPageUrl() }}" tabindex="-1">@lang('languages.previous')</a>
                            </li>
                            @foreach($products->links()->getData()["elements"][0] as $key => $item)
                            <li class="page-item {{(isset(request()->query()['page']) && request()->query()['page'] == $key) ? 'active' : ''}}"><a class="page-link" href="{{ $item }}">{{ $key }}</a></li>
                            @endforeach
                            <li class="page-item">
                                <a class="page-link" href="{{ $products->appends(request()->except('page'))->nextPageUrl() }}">@lang('languages.next')</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- Pagination Start -->
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
<!-- Product List End -->

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

    $(document).ready(function() {
        $("#brandSelect").change(function() {
            var selectedBrandId = $(this).val();

            var url = "{{ route('web.product') }}";
            var queryParams = {
                category_id: "{{ request('category_id') }}",
                brand_id: selectedBrandId,
                name: "{{ request('name') }}",
                tags: "{{ request('tags') }}"
            };

            var queryString = $.param(queryParams);
            url += '?' + queryString;

            window.location.href = url;
        });

        $("#categorySelect").change(function() {
            var selectedCategoryId = $(this).val();

            var url = "{{ route('web.product') }}";
            var queryParams = {
                category_id: selectedCategoryId,
                brand_id: "{{ request('brand_id') }}",
                name: "{{ request('name') }}",
                tags: "{{ request('tags') }}"
            };

            var queryString = $.param(queryParams);
            url += '?' + queryString;

            window.location.href = url;
        });
    });
</script>
@endsection