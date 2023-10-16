<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => __('languages.edit_category').' - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@lang('languages.dashboard')</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">@lang('languages.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{route('showCate')}}">@lang('languages.category')</a></li>
                    <li class="breadcrumb-item active">@lang('languages.edit')</li>
                    <li class="breadcrumb-item active">{{ $category->name ?? "" }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">@lang('languages.edit_category')</h5>

                            <!-- General Form Elements -->
                            <form action="{{ route('updateCate', $category->id) }}" method="post" id="edit-profile" class="form-horizontal">
                                @csrf
                                <fieldset>

                                    <div class="control-group col-md-6">
                                        <label class="control-label">@lang('languages.category_name') <span style="color: red;"> *</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <input class="form-control" name="name" value="{!! old('name') !!}" type="text" />
                                            @else
                                            <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                                            @endif
                                            @error ('name')
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
                                            <input type="number" class="form-control" name="sort_order" value="{{ $category->sort_order ?? 0 }}">
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
                                                <option value="0" {{ (old('active') ?? $category->active) == 0 ? 'selected' : '' }}>@lang('languages.no')</option>
                                                <option value="1" {{ (old('active') ?? $category->active) == 1 ? 'selected' : '' }}>@lang('languages.yes')</option>
                                            </select>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">@lang('languages.save')</button>
                                        <a href="{{ route('showCate') }}" class="btn btn-danger">@lang('languages.cancel')</a>
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