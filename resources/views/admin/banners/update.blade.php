<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => __('languages.edit_banner').' - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@lang('languages.dashboard')</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">@lang('languages.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{route('indexBanners')}}">@lang('languages.banner')</a></li>
                    <li class="breadcrumb-item active">@lang('languages.edit')</li>
                    <li class="breadcrumb-item active">{{ $banner->title ?? "" }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">@lang('languages.edit_banner')</h5>

                            <!-- General Form Elements -->
                            <form action="{{ route('updateBanners', $banner->id ?? '') }}" enctype="multipart/form-data" method="post" id="edit-profile" class="form-horizontal">
                                @csrf

                                <fieldset>
                                    <div class="control-group col-md-6">
                                        <label class="control-label">@lang('languages.title') <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <input class="form-control" name="title" value="{!! old('title') !!}" type="text" />
                                            @else
                                            <input type="text" class="form-control" name="title" value="{{ $banner->title ?? '' }}">
                                            @endif
                                            @error ('title')
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
                                            <input type="number" class="form-control" name="sort_order" value="{{ $banner->sort_order ?? 0 }}">
                                            @endif
                                            @error ('sort_order')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group col-md-6">
                                        <label class="control-label">@lang('languages.status')</label>
                                        <div class="controls">
                                            <select class="form-select" name="active">
                                                <option value="0" {{ (old('active') ?? $banner->active ?? 0) == 0 ? 'selected' : '' }}>@lang('languages.no')</option>
                                                <option value="1" {{ (old('active') ?? $banner->active ?? 0) == 1 ? 'selected' : '' }}>@lang('languages.yes')</option>
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group col-md-6">
                                        <label class="control-label">@lang('languages.image')</label>
                                        <div class="controls">
                                            <input type="hidden" name="imageOld" value="{{ $banner->image_url ?? '' }}">
                                            <input id="imageInput" value="" class="form-control" name="image_url" type="file" />
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <div class="controls">
                                            <img id="imagePreview" width="150px" src="{{ asset($banner->image_url ?? '') }}" alt="">
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group">
                                        <label class="control-label">@lang('languages.content') <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <textarea id="textareaDescription" name="content" class="tinymce-editor">{!! old('content') !!}</textarea>
                                            @else
                                            <textarea id="textareaDescription" name="content" class="tinymce-editor">{{ $banner->content ?? '' }}</textarea>
                                            @endif
                                            @error ('content')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">@lang('languages.save')</button>
                                        <a href="{{ route('indexBanners') }}" class="btn btn-danger">@lang('languages.cancel')</a>
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