<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => 'Create banner - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('indexBanners')}}">Banner</a></li>
                    <li class="breadcrumb-item active">Add</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add banner form</h5>

                            <!-- General Form Elements -->
                            <form action="{{ route('storeBanners') }}" method="post" id="edit-profile" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <fieldset>

                                    <div class="control-group col-md-6">
                                        <label class="control-label">Title <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="title" value="{!! old('title') !!}">
                                            @error ('title')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group col-md-6">
                                        <label class="control-label">Sort Order <span style="color: red;">*</span></label>
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
                                            <input class="form-control" id="imageInput" name="image_url" type="file" value="{!! old('image_url') !!}" title="No Image" />
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div>
                                        <div>
                                            <img id="imagePreview" width="150px" src="">
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">Content <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            <textarea id="textareaDescription" name="content" class="tinymce-editor" value="">{!! old('content') !!}</textarea>
                                            @error ('content')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{ route('indexBanners') }}" class="btn btn-danger">Cancel</a>
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