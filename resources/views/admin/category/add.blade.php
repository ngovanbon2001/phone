<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => 'Create category - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('showCate')}}">Category</a></li>
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
                            <form action="{{ route('addCategory') }}" method="post" id="addCategory" class="form-horizontal">
                                @csrf
                                <fieldset>

                                    <div class="control-group col-md-6">
                                        <label class="control-label">Category's name<span style="color: red;"> *</span></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="name" id="name" value="{!! old('name') !!}">
                                            @error ('name')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="control-group col-md-6">
                                        <label class="control-label">Sort order<span style="color: red;"> *</span></label>
                                        <div class="controls">
                                            <input type="number" class="form-control" name="sort_order" id="sortOrder" value="{!! old('sort_order', 0) !!}">
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

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{ route('showCate') }}" class="btn btn-danger">Cancel</a>
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