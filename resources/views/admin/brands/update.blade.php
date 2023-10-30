<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => __('languages.edit_brand').' - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@lang('languages.dashboard')</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">@lang('languages.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{route('showBrand')}}">@lang('languages.brand')</a></li>
                    <li class="breadcrumb-item active">@lang('languages.edit')</li>
                    <li class="breadcrumb-item active">{{ $brand->name ?? "" }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">@lang('languages.edit_brand')</h5>

                            <!-- General Form Elements -->
                            <form action="{{ route('updateBrand', $brand->id ?? '') }}" enctype="multipart/form-data" method="post" id="edit-profile" class="form-horizontal">
                                @csrf
                                <fieldset>

                                    <div class="control-group col-md-6">
                                        <label class="control-label">@lang('languages.brand_name') <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <input class="form-control" name="name" value="{!! old('name') !!}" type="text" />
                                            @else
                                            <input type="text" class="form-control" name="name" value="{{ $brand->name ?? ''}}">
                                            @endif
                                            @error ('name')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group col-md-6">
                                        <label class="control-label">@lang('languages.link') <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <input class="form-control" name="link" value="{!! old('link') !!}" type="text" />
                                            @else
                                            <input type="text" class="form-control" name="link" value="{{ $brand->link ?? '' }}">
                                            @endif
                                            @error ('link')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group col-md-6">
                                        <label class="control-label">@lang('languages.sort') <span style="color: red;">*</span></label>
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
                                        <label class="control-label">@lang('languages.status') </label>
                                        <div class="controls">
                                            <select class="form-select" name="active">
                                                <option value="0" {{ (old('active') ?? $brand->active ?? 0) == 0 ? 'selected' : '' }}>@lang('languages.no')</option>
                                                <option value="1" {{ (old('active') ?? $brand->active ?? 0) == 1 ? 'selected' : '' }}>@lang('languages.yes')</option>
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group col-md-6">
                                        <label class="control-label">@lang('languages.image')</label>
                                        <div class="controls">
                                            <input type="hidden" name="imageOld" value="{{ $brand->image_url ?? '' }}">
                                            <input class="form-control" name="image_url" type="file" />
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div>
                                        <div>
                                            <img width="150px" src="{{ asset('images/' . ($brand->image_url ?? '')) }}" alt="">
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