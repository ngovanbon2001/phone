@extends('layouts.app')

@section('content')
<section>
    <!-- Homepage Slider -->
    <div class="homepage-slider">
        <div id="sequence">
            <ul class="sequence-canvas">
                @foreach ($banners as $key => $item)
                <!-- Slide 1 -->
                <li class="{{'bg'.$key+1}}">
                    <!-- Slide Title -->
                    <h2 class="title">{{$item->title ?? ""}}</h2>
                    <!-- Slide Text -->
                    <h3 class="subtitle">{!!$item->content ?? ""!!}</h3>
                    <!-- Slide Image -->
                    <img class="slide-img" src="{{asset('images/'.$item->image_url ?? '')}}" alt="Slide 1" />
                </li>
                <!-- End Slide 1 -->
                @endforeach
            </ul>
            <div class="sequence-pagination-wrapper">
                <ul class="sequence-pagination">
                    @foreach ($banners as $key => $item)
                    <li>{{ $key + 1 ?? 0 }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!-- End Homepage Slider -->

    <!-- Our Brands -->
    <div class="section">
        <div class="container">
            <h2>Brands</h2>
            <div class="clients-logo-wrapper text-center row">
                @foreach ($brands as $item)
                <div class="col-lg-1 col-md-1 col-sm-3 col-xs-6"><a href="#"><img src="{{ asset('images/'.$item->image_url ?? '') }}" alt="Client Name"></a></div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Our Brands -->

    <!-- New Product -->
    <div class="section">
        <div class="container">
            <h2>New</h2>
            <div class="row">
                @foreach ($newProduct as $item)
                <div class="col-md-3 col-sm-6">
                    <!-- Product -->
                    <div class="shop-item">
                        <!-- Product Image -->
                        <div class="shop-item-image">
                            <a href="page-product-details.html"><img src="{{asset('images/'.$item->image_url ?? '')}}" alt="Item Name"></a>
                        </div>
                        <!-- Product Title -->
                        <div class="title">
                            <h3><a href="page-product-details.html">{{$item->name ?? ''}}</a></h3>
                        </div>
                        <!-- Product Price-->
                        <div class="price">
                            ${{ number_format($item->price ?? 0)}}
                        </div>
                        <!-- Add to Cart Button -->
                        <div class="actions">
                            <a href="page-product-details.html" class="btn btn-small"><i class="icon-shopping-cart icon-white"></i> Add to Cart</a>
                        </div>
                    </div>
                    <!-- End Product -->
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End New Product -->

    <!-- Discount -->
    <div class="section">
        <div class="container">
            <h2>Low price</h2>
            <div class="row">
                @foreach ($discountProduct as $item)
                <div class="col-md-3 col-sm-6">
                    <!-- Product -->
                    <div class="shop-item">
                        <!-- Product Image -->
                        <div class="shop-item-image">
                            <a href="page-product-details.html"><img src="{{asset('images/'.$item->image_url ?? '')}}" alt="Item Name"></a>
                        </div>
                        <!-- Product Title -->
                        <div class="title">
                            <h3><a href="page-product-details.html">{{$item->name ?? ""}}</a></h3>
                        </div>
                        <!-- Product Price-->
                        <div class="price">
                            ${{ number_format($item->price ?? 0)}}
                        </div>
                        <!-- Add to Cart Button -->
                        <div class="actions">
                            <a href="page-product-details.html" class="btn btn-small"><i class="icon-shopping-cart icon-white"></i> Add to Cart</a>
                        </div>
                    </div>
                    <!-- End Product -->
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Discount -->

</section> <!-- End Section -->
@endsection