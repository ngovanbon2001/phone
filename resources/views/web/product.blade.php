@extends('layouts.app')

@section('content')
<div class="eshop-section section">
    <div class="container">
        <div class="row">
            @foreach ($products as $item)
            <div class="col-md-3 col-sm-6">
                <form action="{{ route('cart.create') }}" method="post" class="cart">
                    @csrf
                    <div class="shop-item">
                        <div class="shop-item-image">
                            <a href="{{route('web.product.detail', $item->id)}}"><img src="{{ asset('images/'.$item->image_url) }}" alt="Item Name"></a>
                        </div>
                        <div class="title">
                            <h3><a href="{{route('web.product.detail', $item->id)}}">{{$item->name}}</a></h3>
                        </div>
                        <div class="price">
                            ${{number_format($item->price)}}
                        </div>
                        <div class="actions">
                            <button class="btn btn-small add-cart"><i class="fa fa-shopping-cart"></i> Add to cart</button>

                            <input type="hidden" value="{{ $item->id }}" name="product_id">
                            <input type="hidden" value="1" name="quantity">
                            <input type="hidden" value="{{ $item->name }}" name="product_name">
                            <input type="hidden" value="{{ $item->image_url }}" name="product_image">
                            <input type="hidden" value="{{ $item->price }}" name="product_price">
                        </div>
                    </div>
                </form>
            </div>
            @endforeach
        </div>
        <div class="pagination-wrapper">
            <ul class="pagination pagination-lg">
                <li><a href="{{ $products->appends(request()->except('page'))->previousPageUrl() }}">Previous</a></li>
                @foreach($products->links()->getData()["elements"][0] as $key => $item)
                <li class="{{(isset(request()->query()['page']) && request()->query()['page'] == $key) ? 'active' : ''}}"><a href="{{$item}}">{{$key}}</a></li>
                @endforeach
                <li><a href="{{ $products->appends(request()->except('page'))->nextPageUrl() }}">Next</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection