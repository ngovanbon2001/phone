<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => 'Edit Brand - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('showBrand')}}">Brand</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                    <li class="breadcrumb-item active">{{ $brand->name ?? "" }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit brand form</h5>

                            <!-- General Form Elements -->
                            <form action="{{ route('updateBrand', $brand->id) }}" enctype="multipart/form-data" method="post" id="edit-profile" class="form-horizontal">
                                @csrf
                                <fieldset>

                                    <div class="control-group col-md-6">
                                        <label class="control-label">Brand name <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <input class="form-control" name="name" value="{!! old('name') !!}" type="text" />
                                            @else
                                            <input type="text" class="form-control" name="name" value="{{ $brand->name }}">
                                            @endif
                                            @error ('name')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group col-md-6">
                                        <label class="control-label">Link <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <input class="form-control" name="link" value="{!! old('link') !!}" type="text" />
                                            @else
                                            <input type="text" class="form-control" name="link" value="{{ $brand->link }}">
                                            @endif
                                            @error ('link')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group col-md-6">
                                        <label class="control-label">Sort order <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <input class="form-control" name="sort_order" value="{!! old('sort_order', 0) !!}" type="number" />
                                            @else
                                            <input type="number" class="form-control" name="sort_order" value="{{ $brand->sort_order ?? 0 }}">
                                            @endif
                                            @error ('sort_order')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group col-md-6">
                                        <label class="control-label">Active</label>
                                        <div class="controls">
                                            <select class="form-select" name="active">
                                                <option value="0" {{ (old('active') ?? $brand->active) == 0 ? 'selected' : '' }}>No</option>
                                                <option value="1" {{ (old('active') ?? $brand->active) == 1 ? 'selected' : '' }}>Yes</option>
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group col-md-6">
                                        <label class="control-label">Image</label>
                                        <div class="controls">
                                            <input type="hidden" name="imageOld" value="{{ $brand->image_url }}">
                                            <input class="form-control" name="image_url" type="file" />
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div>
                                        <div>
                                            <img width="150px" src="{{ asset('images/' . $brand->image_url) }}" alt="">
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{ route('showBrand') }}" class="btn btn-danger">Cancel</a>
                                    </div> <!-- /form-actions -->

                                </fieldset>
                            </form>
                            <!-- End General Form Elements -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main><!-- End #main -->

    @include ('admin.common.footer')
</body>

</html>