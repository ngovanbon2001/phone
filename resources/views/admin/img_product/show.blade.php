<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => __('languages.detail').' - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@lang('languages.dashboard')</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">@lang('languages.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{route('indexProduct')}}">@lang('languages.product')</a></li>
                    <li class="breadcrumb-item active">{{ $product->name ?? '' }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->


        <section class="section">
            <div class="row align-items-top">

                <div class="card" style="padding-top: 1%;">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <img src="{{ asset('images/' . $product->image_url) }}" style="width: 150px;" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <div><b>@lang('languages.category'): </b>{{ $product->category->name }}</div>
                                    <div><b>@lang('languages.brand'): </b>{{ $product->brand->name }}</div>
                                    <p class="card-text">{!! $product->description !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <button id="btn-image" type="button" class="btn btn-primary">@lang('languages.image')</button>
        <button id="btn-color" type="button" class="btn btn-primary">@lang('languages.color')</button>

        <div class="row">
            <div class="col-lg-6">
                <div id="message">
                    @if (session()->has('message'))
                    &emsp;
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif

                    @if (session()->has('message-error'))
                    &emsp;
                    <div class="alert alert-danger">
                        {{ session('message-error') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <section class="section image">
            &emsp;
            <div class="row">
                <div class="col-lg-12">

                    <h2>@lang('languages.add_image')</h2>
                    <form action="{{ route('storeImage') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" value="{{ $product->id ?? 0 }}" name="product_id">
                        <div class="row">
                            <div class="control-group col-md-6">
                                <label class="control-label">@lang('languages.image')</label>
                                <div class="controls">
                                    <input type="file" class="form-control" name="image_url[]" multiple> <br>
                                    @error ('image_url')
                                    <label class="error">{{ $message }}</label>
                                    @enderror
                                    @error ('image_url.*')
                                    <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="control-group col-md-6">
                                <label class="control-label">@lang('languages.sort')</label>
                                <div class="controls">
                                    <input type="number" class="form-control" name="sort_order" value="{!! old('sort_order', 0) !!}">
                                    @error ('sort_order')
                                    <label class="error">{{ $message }}</label>
                                    @enderror
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                        </div>

                        <div class="control-group col-md-6">
                            <button type="submit" class="btn btn-primary">@lang('languages.up_load')</button>
                        </div> <!-- /control-group -->
                    </form>
                </div>
                <div class="col-lg-12">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="widget-content">
                                <table style="width:100%" class="table table-striped">

                                    <thead>
                                        <tr>
                                            <th style="width:5%; text-align: center;">@lang('languages.num')</th>
                                            <th style="width:15%; text-align: center;">@lang('languages.image')</th>
                                            <th style="width:52%;"></th>
                                            <th style="width:8%; text-align: center;">@lang('languages.sort')</th>
                                            <th style="width:10%; text-align: center;">@lang('languages.action')</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($images as $key => $imageList)
                                        <tr>
                                            <td style="text-align: center;">{{ $key + 1 }}</td>
                                            <td style="text-align: center;"><img src="{{ asset('images/' . $imageList->image_url) }}" width="150px" alt="Khong tai duoc"></td>
                                            <td></td>
                                            <td style="text-align: center;">{{ $imageList->sort_order }}</td>
                                            <td style="text-align: center;">
                                                <?php $message =  __('languages.delete_confirm') ?>
                                                <form method="post" action="">
                                                    <input value="{{ $imageList->id }}" type="hidden" name="id" id="imageId">
                                                    <a class="btn btn-danger" href="{{ route('destroyImage', [$imageList->id, $product->id]) }}" onclick="return confirm('{{ $message }}');"><i class="bi bi-trash"></i></a>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>
                        </div>

                    </div>
                </div><!-- End Left side columns -->

            </div>
        </section>
        <section class="section color">
            &emsp;
            <div class="row">
                <div class="col-lg-12">

                    <h2>@lang('languages.color')</h2>
                    <form action="{{ route('version.store') }}" method="post">
                        @csrf

                        <input type="hidden" value="{{ $product->id ?? 0 }}" name="product_id">
                        <div class="row">
                            <div class="control-group col-md-6">
                                <label class="control-label">@lang('languages.color') <span style="color: red;">*</span></label>
                                <div class="controls">
                                    <?php ($product->productColor) ? $color = array_map(function($item) {
                                        return $item['color'];
                                    }, $product->productColor->toArray() ?? []) : []; 
                                    ?>
                                    <select name="color" class="form-select" placeholder="{{ __('languages.select_color') }}">
                                        @foreach(config('project.color') as $key => $value)
                                        @if(!in_array($key, $color))
                                        <option value="{{ $key }}" {{ ($key == old('color')) ? 'selected' : '' }}>{{ __($value) }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div> <!-- /control-group -->

                            <div class="control-group col-md-6">
                                <label class="control-label">@lang('languages.amount') <span style="color: red;">*</span></label>
                                <div class="controls">
                                    <input type="number" class="form-control" name="amount_color" value="{!! old('amount_color', 0) !!}">
                                    @error ('amount_color')
                                    <label class="error">{{ $message }}</label>
                                    @enderror
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                        </div>

                        <div class="control-group col-md-6">
                            <button type="submit" class="btn btn-primary">@lang('languages.save')</button>
                        </div> <!-- /control-group -->
                    </form>
                </div>
                <div class="col-lg-12">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="widget-content">
                                <table style="width:100%" class="table table-striped">

                                    <thead>
                                        <tr>
                                            <th style="width:5%; text-align: center;">@lang('languages.num')</th>
                                            <th style="width:15%; text-align: center;">@lang('languages.product')</th>
                                            <th style="width:52%; text-align: center;">@lang('languages.color')</th>
                                            <th style="width:8%; text-align: center;">@lang('languages.amount')</th>
                                            <th style="width:10%; text-align: center;">@lang('languages.action')</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if($product->productColor)
                                        @foreach ($product->productColor as $key => $value)
                                        <tr>
                                            <td style="text-align: center;">{{ $key + 1 }}</td>
                                            <td style="text-align: center;">{{ $product->name ?? '' }}</td>
                                            <td style="text-align: center;">{{ (isset($value['color']) && $value['color'] !== '') ? __(config('project.color')[$value->color]) : '' }}</td>
                                            <td style="text-align: center;">{{ $value->amount_color ?? '' }}</td>
                                            <td style="text-align: center;">
                                                <?php $message =  __('languages.delete_confirm') ?>
                                                <form method="post" action="">
                                                    <input value="{{ $value->id }}" type="hidden" name="id" id="imageId">
                                                    <a class="btn btn-danger" href="{{ route('destroyImage', [$value->id, $product->id]) }}" onclick="return confirm('{{ $message }}');"><i class="bi bi-trash"></i></a>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>

                                </table>

                            </div>
                        </div>

                    </div>
                </div><!-- End Left side columns -->

            </div>
        </section>
    </main><!-- End #main -->

    @include ('admin.common.footer')
</body>

</html>
<script>
    $(document).ready(function() {
        $('section.image').hide();
        $('section.color').hide();
        var image = 0;
        var color = 0;
        $('#btn-image').on('click', function() {
            if (image == 0) {
                image = 1;
                $('section.image').show();
            } else {
                image = 0;
                $('section.image').hide();
            }
        });
        $('#btn-color').on('click', function() {
            if (color == 0) {
                color = 1;
                $('section.color').show();
            } else {
                color = 0;
                $('section.color').hide();
            }
        });
    });
</script>