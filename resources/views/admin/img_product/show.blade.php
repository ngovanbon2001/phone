<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => 'Image - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('indexProduct')}}">Product</a></li>
                    <li class="breadcrumb-item active">Image</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->


        <section class="section">
            <div class="row align-items-top">

                <div class="card">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <img src="{{ asset('images/' . $product->image_url) }}" style="width: 150px;" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <div><b>Category: </b>{{ $product->category->name }}</div>
                                    <div><b>Brand: </b>{{ $product->brand->name }}</div>
                                    <p class="card-text">{!! $product->description !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-6">

                                <h2>Add Image</h2>
                                <form action="{{ route('storeImage') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                                    <div class="control-group col-md-6">
                                        <label class="control-label">Image</label>
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
                                        <label class="control-label">Sort order</label>
                                        <div class="controls">
                                            <input type="number" class="form-control" name="sort_order" value="{!! old('sort_order', 0) !!}">
                                            @error ('sort_order')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group col-md-6">
                                        <button type="submit" class="btn btn-primary">Up Load</button>
                                    </div> <!-- /control-group -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">

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
                                <table style="width:100%" class="table table-striped">

                                    <thead>
                                        <tr>
                                            <th style="width:5%; text-align: center;">No</th>
                                            <th style="width:15%; text-align: center;">Image</th>
                                            <th style="width:52%;"></th>
                                            <th style="width:8%; text-align: center;">Sort order</th>
                                            <th style="width:10%; text-align: center;">Action</th>
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
                                                <form method="post" action="">
                                                    <input value="{{ $imageList->id }}" type="hidden" name="id" id="imageId">
                                                    <a class="btn btn-danger" href="{{ route('destroyImage', [$imageList->id, $product->id]) }}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="bi bi-trash"></i></a>
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
    </main><!-- End #main -->

    @include ('admin.common.footer')
</body>

</html>
