<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => __('languages.edit_product').' - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@lang('languages.dashboard')</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">@lang('languages.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{route('indexProduct')}}">@lang('languages.product')</a></li>
                    <li class="breadcrumb-item active">@lang('languages.edit')</li>
                    <li class="breadcrumb-item active">{{ $product->name ?? "" }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">@lang('languages.edit_product')</h5>

                            <!-- General Form Elements -->
                            <form action="{{ route('updateProducts', $product->id ?? '') }}" enctype="multipart/form-data" method="post" id="edit-profile" class="form-horizontal">
                                @csrf
                                <fieldset>
                                    <div class="row">
                                        <div class="control-group col-md-6">
                                            <label class="control-label">@lang('languages.category') <span style="color: red;">*</span></label>
                                            <div class="controls">
                                                <select class="form-select" name="category_id">
                                                    <option value="">-----</option>
                                                    @foreach ($getCategories as $categoryList)
                                                    <option value="{{ $categoryList->id ?? '' }}" {{ (old('category_id') ?? $category->id ?? '') == $categoryList->id ? 'selected' : '' }}>
                                                        {{ $categoryList->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error ('category_id')
                                                <label class="error">{{ $message }}</label>
                                                @enderror
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->

                                        <div class="control-group col-md-6">
                                            <label class="control-label">@lang('languages.brand') <span style="color: red;">*</span></label>
                                            <div class="controls">
                                                <select class="form-select" name="brand_id">
                                                    <option value="">-----</option>
                                                    @foreach ($getBrands as $brandList)
                                                    <option value="{{ $brandList->id ?? '' }}" {{ (old('brand_id') ?? $brand->id ?? '') == $brandList->id ? 'selected' : '' }}>
                                                        {{ $brandList->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error ('brand_id')
                                                <label class="error">{{ $message }}</label>
                                                @enderror
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">@lang('languages.product_name') <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <input type="text" class="form-control" name="name" value="{!! old('name') !!}">
                                            @else
                                            <input type="text" class="form-control" name="name" value="{{ $product->name ?? '' }}">
                                            @endif

                                            @error ('name')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="row">
                                        <div class="control-group col-md-6">
                                            <label class="control-label">@lang('languages.price') <span style="color: red;">*</span></label>
                                            <div class="controls">
                                                @if ($errors->any())
                                                <input class="form-control" name="price" value="{!! old('price') !!}" type="text" />
                                                @else
                                                <input class="form-control" name="price" value="{{ $product->price ?? '' }}" type="text" />
                                                @endif
                                                @error ('price')
                                                <label class="error">{{ $message }}</label>
                                                @enderror
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->

                                        <div class="control-group col-md-6">
                                            <label class="control-label">@lang('languages.old_price')</label>
                                            <div class="controls">
                                                @if ($errors->any())
                                                <input class="form-control" name="old_price" value="{!! old('old_price') !!}" type="text" />
                                                @else
                                                <input class="form-control" name="old_price" value="{{ $product->old_price ?? '' }}" type="text" />
                                                @endif
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">@lang('languages.tags')</label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <input class="form-control" name="tags" value="{!! old('tags') !!}" type="text" />
                                            @else
                                            <input class="form-control" name="tags" value="{{ $product->tags ?? '' }}" type="text" />
                                            @endif
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="row">
                                        <div class="control-group col-md-6">
                                            <label class="control-label">@lang('languages.best_sell')</label>
                                            <div class="controls">
                                                <select class="form-select" name="is_best_sell">
                                                    <option value="0" {{ (old('is_best_sell') ?? $product->is_best_sell ?? 0) == 0 ? 'selected' : '' }}>@lang('languages.no')</option>
                                                    <option value="1" {{ (old('is_best_sell') ?? $product->is_best_sell ?? 0) == 1 ? 'selected' : '' }}>@lang('languages.yes')</option>
                                                </select>
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->

                                        <div class="control-group col-md-6">
                                            <label class="control-label">@lang('languages.new_product')</label>
                                            <div class="controls">
                                                <select class="form-select" name="is_new">
                                                    <option value="0" {{ (old('is_new') ?? $product->is_new ?? 0) == 0 ? 'selected' : '' }}>@lang('languages.no')</option>
                                                    <option value="1" {{ (old('is_new') ?? $product->is_new ?? 0) == 1 ? 'selected' : '' }}>@lang('languages.yes')</option>
                                                </select>
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                    </div>

                                    <div class="row">
                                        <div class="control-group col-md-6">
                                            <label class="control-label">@lang('languages.sort') <span style="color: red;">*</span></label>
                                            <div class="controls">
                                                @if ($errors->any())
                                                <input class="form-control" name="sort_order" value="{!! old('sort_order', 0) !!}" type="number" />
                                                @else
                                                <input type="number" class="form-control" name="sort_order" value="{{ $product->sort_order ?? 0 }}">
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
                                                    <option value="0" {{ (old('active') ?? $product->active ?? 0) == 0 ? 'selected' : '' }}>@lang('languages.no')</option>
                                                    <option value="1" {{ (old('active') ?? $product->active ?? 0) == 1 ? 'selected' : '' }}>@lang('languages.yes')</option>
                                                </select>
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                    </div>

                                    <div class="row">
                                        <div class="control-group col-md-6">
                                            <label class="control-label">@lang('languages.image')</label>
                                            <div class="controls">
                                                <input type="hidden" name="oldImage" value="{{ $product->image_url ?? 0 }}">
                                                <input id="imageInput" class="form-control" name="image_url" type="file" />
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->

                                        <div class="control-group col-md-6">
                                            <div class="controls">
                                                <img id="imagePreview" width="150px" src="{{ asset($product->image_url ?? '') }}" alt="">
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                    </div>

                                    <!-- Specifications-->
                                    <div class="row">
                                        <div class="control-group col-md-4">
                                            <label class="control-label">@lang('languages.screen') <span style="color: red;">*</span></label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="specifications[screen]" value="{{ old('specifications.screen') ?? $product->specifications->screen ?? '' }}">
                                                @error ('specifications.screen')
                                                <label class="error">{{ $message }}</label>
                                                @enderror
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->

                                        <div class="control-group col-md-4">
                                            <label class="control-label">@lang('languages.operating_system') <span style="color: red;">*</span></label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="specifications[operating_system]" value="{{ old('specifications.operating_system') ?? $product->specifications->operating_system ?? '' }}">
                                                @error ('specifications.operating_system')
                                                <label class="error">{{ $message }}</label>
                                                @enderror
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->

                                        <div class="control-group col-md-4">
                                            <label class="control-label">@lang('languages.rear_camera') <span style="color: red;">*</span></label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="specifications[rear_camera]" value="{{ old('specifications.rear_camera') ?? $product->specifications->rear_camera ?? '' }}">
                                                @error ('specifications.rear_camera')
                                                <label class="error">{{ $message }}</label>
                                                @enderror
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                    </div>

                                    <div class="row">
                                        <div class="control-group col-md-4">
                                            <label class="control-label">@lang('languages.front_camera') <span style="color: red;">*</span></label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="specifications[front_camera]" value="{{ old('specifications.front_camera') ?? $product->specifications->front_camera ?? '' }}">
                                                @error ('specifications.front_camera')
                                                <label class="error">{{ $message }}</label>
                                                @enderror
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->

                                        <div class="control-group col-md-4">
                                            <label class="control-label">@lang('languages.cpu') <span style="color: red;">*</span></label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="specifications[cpu]" value="{{ old('specifications.cpu') ?? $product->specifications->cpu ?? '' }}">
                                                @error ('specifications.cpu')
                                                <label class="error">{{ $message }}</label>
                                                @enderror
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->

                                        <div class="control-group col-md-4">
                                            <label class="control-label">@lang('languages.ram') <span style="color: red;">*</span></label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="specifications[ram]" value="{{ old('specifications.ram') ?? $product->specifications->ram ?? '' }}">
                                                @error ('specifications.ram')
                                                <label class="error">{{ $message }}</label>
                                                @enderror
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                    </div>

                                    <div class="row">
                                        <div class="control-group col-md-4">
                                            <label class="control-label">@lang('languages.internal_memory') <span style="color: red;">*</span></label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="specifications[internal_memory]" value="{{ old('specifications.internal_memory') ?? $product->specifications->internal_memory ?? ''}}">
                                                @error ('specifications.internal_memory')
                                                <label class="error">{{ $message }}</label>
                                                @enderror
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->

                                        <div class="control-group col-md-4">
                                            <label class="control-label">@lang('languages.memory_stick') <span style="color: red;">*</span></label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="specifications[memory_stick]" value="{{ old('specifications.memory_stick') ?? $product->specifications->memory_stick ?? '' }}">
                                                @error ('specifications.memory_stick')
                                                <label class="error">{{ $message }}</label>
                                                @enderror
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->

                                        <div class="control-group col-md-4">
                                            <label class="control-label">@lang('languages.battery') <span style="color: red;">*</span></label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="specifications[battery]" value="{{ old('specifications.battery') ?? $product->specifications->battery ?? '' }}">
                                                @error ('specifications.battery')
                                                <label class="error">{{ $message }}</label>
                                                @enderror
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                    </div>
                                    <!-- End Specifications-->

                                    <div class="control-group">
                                        <label class="control-label">@lang('languages.description')</label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <textarea id="textareaDescription" name="description" class="tinymce-editor">{!! old('description') !!}</textarea>
                                            @else
                                            <textarea id="textareaDescription" name="description" class="tinymce-editor">{{ $product->description ?? '' }}</textarea>
                                            @endif
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">@lang('languages.save')</button>
                                        <a href="{{ route('indexProduct') }}" class="btn btn-danger">@lang('languages.cancel')</a>
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
    <script type="text/javascript">
        $('.form-control-chosen').chosen({
            allow_single_deselect: true,
            width: '100%'
        });
    </script>
</body>

</html>