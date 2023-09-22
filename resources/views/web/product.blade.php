@extends('layouts.app')

@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active">Product List</li>
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
                                        <input type="email" value="Search">
                                        <button><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="product-short">
                                        <div class="dropdown">
                                            <div class="dropdown-toggle" data-toggle="dropdown">Product short by</div>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item">Newest</a>
                                                <a href="#" class="dropdown-item">Popular</a>
                                                <a href="#" class="dropdown-item">Most sale</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="product-price-range">
                                        <div class="dropdown">
                                            <div class="dropdown-toggle" data-toggle="dropdown">Product price range</div>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item">$0 to $50</a>
                                                <a href="#" class="dropdown-item">$51 to $100</a>
                                                <a href="#" class="dropdown-item">$101 to $150</a>
                                                <a href="#" class="dropdown-item">$151 to $200</a>
                                                <a href="#" class="dropdown-item">$201 to $250</a>
                                                <a href="#" class="dropdown-item">$251 to $300</a>
                                                <a href="#" class="dropdown-item">$301 to $350</a>
                                                <a href="#" class="dropdown-item">$351 to $400</a>
                                                <a href="#" class="dropdown-item">$401 to $450</a>
                                                <a href="#" class="dropdown-item">$451 to $500</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($products as $item)
                    <div class="col-md-4">
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
                                    <a href="#"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-price">
                                <h3><span>$</span>{{ number_format($item->price) }}</h3>
                                <a class="btn" onclick="document.getElementById('cart-add-{{ $item->id ?? 0 }}').submit()" href="#"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                            </div>
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
                    @endforeach
                </div>

                <!-- Pagination Start -->
                <div class="col-md-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="{{ $products->appends(request()->except('page'))->previousPageUrl() }}" tabindex="-1">Previous</a>
                            </li>
                            @foreach($products->links()->getData()["elements"][0] as $key => $item)
                            <li class="page-item {{(isset(request()->query()['page']) && request()->query()['page'] == $key) ? 'active' : ''}}"><a class="page-link" href="{{ $item }}">{{ $key }}</a></li>
                            @endforeach
                            <li class="page-item">
                                <a class="page-link" href="{{ $products->appends(request()->except('page'))->nextPageUrl() }}">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- Pagination Start -->
            </div>

            <!-- Side Bar Start -->
            <div class="col-lg-4 sidebar">
                <div class="sidebar-widget category">
                    <h2 class="title">Category</h2>
                    <nav class="navbar bg-light">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa fa-female"></i>Fashion & Beauty</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa fa-child"></i>Kids & Babies Clothes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa fa-tshirt"></i>Men & Women Clothes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa fa-mobile-alt"></i>Gadgets & Accessories</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa fa-microchip"></i>Electronics & Accessories</a>
                            </li>
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
                                    <a href="#"><i class="fa fa-search"></i></a>
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
                        <li><a href="#">Nulla </a><span>(45)</span></li>
                        <li><a href="#">Curabitur </a><span>(34)</span></li>
                        <li><a href="#">Nunc </a><span>(67)</span></li>
                        <li><a href="#">Ullamcorper</a><span>(74)</span></li>
                        <li><a href="#">Fusce </a><span>(89)</span></li>
                        <li><a href="#">Sagittis</a><span>(28)</span></li>
                    </ul>
                </div>

                <div class="sidebar-widget tag">
                    <h2 class="title">Tags Cloud</h2>
                    <a href="#">Lorem ipsum</a>
                    <a href="#">Vivamus</a>
                    <a href="#">Phasellus</a>
                    <a href="#">pulvinar</a>
                    <a href="#">Curabitur</a>
                    <a href="#">Fusce</a>
                    <a href="#">Sem quis</a>
                    <a href="#">Mollis metus</a>
                    <a href="#">Sit amet</a>
                    <a href="#">Vel posuere</a>
                    <a href="#">orci luctus</a>
                    <a href="#">Nam lorem</a>
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