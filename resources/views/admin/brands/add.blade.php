<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => 'Create Brand - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('showBrand')}}">Brand</a></li>
                    <li class="breadcrumb-item active">Add</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add brand form</h5>

                            <!-- General Form Elements -->
                            <form action="{{ route('storeBrand') }}" method="post" id="edit-profile" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <fieldset>

                                    <div class="control-group col-md-6">
                                        <label class="control-label">Brand name <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="name" value="{!! old('name') !!}">
                                            @error ('name')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group col-md-6">
                                        <label class="control-label">Link <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            <input type="link" class="form-control" name="link" value="{!! old('link') !!}">
                                            @error ('link')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group col-md-6">
                                        <label class="control-label">Sort order <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            <input type="number" class="form-control" name="sort_order" value="{!! old('sort_order', 0) !!}">
                                            @error ('sort_order')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group col-md-6">
                                        <label class="control-label">Active</label>
                                        <div class="controls">
                                            <select class="form-select" name="active">
                                                <option value="1" {{ (old('active') ?? 1) == 1 ? 'selected' : '' }}>Yes</option>
                                                <option value="0" {{ (old('active') ?? 0) == 0 ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group col-md-6">
                                        <label class="control-label">Image</label>
                                        <div class="controls">
                                            <input class="form-control" id="imageInput" name="image_url" type="file" />
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div>
                                        <div>
                                            <img id="imagePreview" width="150px" src="">
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