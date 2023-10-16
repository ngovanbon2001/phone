<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => __('languages.add_brand').' - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@lang('languages.dashboard')</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">@lang('languages.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{route('showBrand')}}">@lang('languages.brand')</a></li>
                    <li class="breadcrumb-item active">@lang('languages.add')</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">@lang('languages.add_brand')</h5>

                            <!-- General Form Elements -->
                            <form action="{{ route('storeBrand') }}" method="post" id="edit-profile" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <fieldset>

                                    <div class="control-group col-md-6">
                                        <label class="control-label">@lang('languages.brand_name') <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="name" value="{!! old('name') !!}">
                                            @error ('name')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group col-md-6">
                                        <label class="control-label">@lang('languages.link') <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            <input type="link" class="form-control" name="link" value="{!! old('link') !!}">
                                            @error ('link')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group col-md-6">
                                        <label class="control-label">@lang('languages.sort') <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            <input type="number" class="form-control" name="sort_order" value="{!! old('sort_order', 0) !!}">
                                            @error ('sort_order')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group col-md-6">
                                        <label class="control-label">@lang('languages.status')</label>
                                        <div class="controls">
                                            <select class="form-select" name="active">
                                                <option value="1" {{ (old('active') ?? 1) == 1 ? 'selected' : '' }}>@lang('languages.yes')</option>
                                                <option value="0" {{ (old('active') ?? 0) == 0 ? 'selected' : '' }}>@lang('languages.no')</option>
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group col-md-6">
                                        <label class="control-label">@lang('languages.image')</label>
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
                                        <button type="submit" class="btn btn-primary">@lang('languages.save')</button>
                                        <a href="{{ route('showBrand') }}" class="btn btn-danger">@lang('languages.cancel')</a>
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