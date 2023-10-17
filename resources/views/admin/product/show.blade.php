<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => __('languages.product').' - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@lang('languages.dashboard')</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">@lang('languages.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{route('indexProduct')}}">@lang('languages.product')</a></li>
                    <li class="breadcrumb-item active">@lang('languages.list')</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

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

                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="widget-content">

                                    <form action=" {{ route('indexProduct') }} " method="get">
                                        <div class="search">
                                            <div class="row">
                                                <div class="control-group col-md-4">
                                                    <label class="control-label">@lang('languages.product_name')</label>
                                                    <input id='searchInput' class="form-control" name="name" type='text' placeholder="{{ __('languages.product_name') }}" value="{{ request('name') }}" />
                                                    @error ('name')
                                                    <label class="error">{{ $message }}</label>
                                                    @enderror
                                                </div>

                                                <div class="control-group col-md-4">
                                                    <label class="control-label">@lang('languages.brand')</label>
                                                    <select name="brand" class="form-select">
                                                        <option value="">-----</option>
                                                        @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}" {{ (request('brand') == $brand->id) ? 'selected' : '' }}>{{ $brand->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error ('brand')
                                                    <label class="error">{{ $message }}</label>
                                                    @enderror
                                                </div>

                                                <div class="control-group col-md-4">
                                                    <label class="control-label">@lang('languages.category')</label>
                                                    <select class="form-select" name="category">
                                                        <option value="">-----</option>
                                                        @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{ (request('category') == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error ('category')
                                                    <label class="error">{{ $message }}</label>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="control-group col-md-4">
                                                    <label class="control-label">@lang('languages.new_product')</label>
                                                    <select class="form-select" name="isNew">
                                                        <option value="">-----</option>
                                                        <option value="0" {{ (request('isNew') == '0') ? 'selected' : '' }}>@lang('languages.no')</option>
                                                        <option value="1" {{ (request('isNew') == '1') ? 'selected' : '' }}>@lang('languages.yes')</option>
                                                    </select>
                                                    @error ('isNew')
                                                    <label class="error">{{ $message }}</label>
                                                    @enderror
                                                </div>

                                                <div class="control-group col-md-4">
                                                    <label class="control-label">@lang('languages.best_sell')</label>
                                                    <select class="form-select" name="bestSell">
                                                        <option value="">-----</option>
                                                        <option value="0" {{ (request('bestSell') == '0') ? 'selected' : '' }}>@lang('languages.no')</option>
                                                        <option value="1" {{ (request('bestSell') == '1') ? 'selected' : '' }}>@lang('languages.yes')</option>
                                                    </select>
                                                    @error ('bestSell')
                                                    <label class="error">{{ $message }}</label>
                                                    @enderror
                                                </div>

                                                <div class="control-group col-md-4">
                                                    <label class="control-label"></label>
                                                    <div>
                                                        <button class="btn btn-secondary" name="btnSearch" value="btnSearch"><i class="ri-search-2-line"></i></button> &emsp;
                                                        <a href="{{ route('indexProduct') }}" class="btn btn-secondary"><i class="ri-arrow-go-back-line"></i></a> &emsp;
                                                        <a href="{{ route('createProduct') }}" class="btn btn-primary"> <i class="ri-add-fill"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <table style="width:100%" class="table table-striped">

                                        <thead>
                                            <tr>
                                                <th style="width:2%; text-align: center;">@lang('languages.num')</th>
                                                <th style="width:10%; text-align: center;">@lang('languages.image')</th>
                                                <th style="width:10%; text-align: center;">@lang('languages.product_name')</th>
                                                <th style="width:12%; text-align: center;">@lang('languages.brand')</th>
                                                <th style="width:15%; text-align: center;">@lang('languages.category')</th>
                                                <th style="width:5%; text-align: center;">@lang('languages.price')</th>
                                                <th style="width:7%; text-align: center;">@lang('languages.best_sell')</th>
                                                <th style="width:5%; text-align: center;">@lang('languages.new_product')</th>
                                                <th style="width:2%; text-align: center;">@lang('languages.status')</th>
                                                <th style="width:30%; text-align: center;">@lang('languages.action')</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($products as $productKey => $product)
                                            <tr>
                                                <td style="text-align: center;"> {{ $productKey + 1 }} </td>
                                                <td style="text-align: center;"><img src="{{ asset('images/' . $product->image_url) }}" width="100px" alt="No Image"></td>
                                                <td style="text-align: center;">{{ $product->name }}</td>
                                                <td style="text-align: center;">{{ $product->brand->name }}</td>
                                                <td style="text-align: center;">{{ $product->category->name }}</td>
                                                <td style="text-align: right;">${{ number_format($product->price) }}</td>
                                                @if ($product->is_best_sell == 1)
                                                <td style="text-align: center;"><img src="{{ asset('images/ok-16.png') }}" alt=""></td>
                                                @else
                                                <td></td>
                                                @endif
                                                @if ($product->is_new == 1)
                                                <td style="text-align: center;"><img src="{{ asset('images/ok-16.png') }}" alt=""></td>
                                                @else
                                                <td></td>
                                                @endif
                                                <input type="hidden" value="{{ $product->id }}" class="id" id="idp">
                                                <td style="text-align: center;"><input type="checkbox" class="toggle-position" value="{{ $product->id }}" data-name="{{ $product->name }}" data-url="{{route('active')}}" data-id="{{ $product->id }}" data-on="{{ __('languages.yes') }}" data-off="{{ __('languages.no') }}" data-toggle="toggle" data-width="15" data-height="10" {{ $product->active == 1 ? 'checked' : '' }}></td>
                                                <td style="text-align: center;">
                                                    <input value="{{ $product->id }}" type="hidden" name="id">
                                                    <a class="btn btn-success" href="{{ route('editProducts', $product->id)  }}"><i class="bi bi-pencil-square"></i></a>
                                                    <?php $message =  __('languages.delete_confirm') ?>
                                                    <a class="btn btn-danger" onclick="return confirm('{{ $message }}') ? document.getElementById('product-delete-{{ $product->id }}').submit() : false"><i class="bi bi-trash"></i></a>
                                                    <a class="btn btn-info" href="{{ route('showImage', $product->id) }}"><i class="ri-eye-line"></i></a>
                                                    <form action="{{ route('destroyProducts', $product->id) }}" id="product-delete-{{ $product->id }}" method="post">
                                                        @method('delete')
                                                        @csrf()
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Left side columns -->

            </div>
        </section>

        <section class="section">
            <div class="row">
                <div class="col-lg-12" style="display: flex; justify-content: center;">
                    <!-- Basic Pagination -->
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="{{ $products->appends(request()->except('page'))->previousPageUrl() }}">
                                    << </a>
                            </li>
                            @foreach($products->links()->getData()["elements"][0] as $key => $item)
                            <li class="page-item"><a class="page-link" href="{{$item}}">{{$key}}</a></li>
                            @endforeach
                            <li class="page-item"><a class="page-link" href="{{ $products->appends(request()->except('page'))->nextPageUrl() }}">>></a></li>
                        </ul>
                    </nav><!-- End Basic Pagination -->
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    @include ('admin.common.footer')
</body>

</html>
