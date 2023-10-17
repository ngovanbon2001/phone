<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => __('languages.create_staff').' - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@lang('languages.dashboard')</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">@lang('languages.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{route('indexUser')}}">@lang('languages.staff')</a></li>
                    <li class="breadcrumb-item active">@lang('languages.add')</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">@lang('languages.create_staff')</h5>

                            <!-- General Form Elements -->
                            <form action="{{ route('storeUser') }}" method="post" id="edit-profile" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <fieldset>
                                    <div class="row">
                                        <div class="control-group col-md-6">
                                            <label class="control-label">@lang('languages.staff_name') <span style="color: red;">*</span></label>
                                            <div class="controls">
                                                @if ($errors->any())
                                                <input type="text" class="form-control" name="username" value="{!! old('username') !!}">
                                                @else
                                                @if (isset($staff->username))
                                                <input type="text" class="form-control" name="username" value="{{ $staff->username }}">
                                                @else
                                                <input type="text" class="form-control" name="username" value="{!! old('username') !!}">
                                                @endif
                                                @endif

                                                @error ('username')
                                                <label class="error">{{ $message }}</label>
                                                @enderror
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->

                                        <div class="control-group col-md-6">
                                            <label class="control-label">@lang('languages.phone_number') <span style="color: red;">*</span></label>
                                            <div class="controls">
                                                @if ($errors->any())
                                                <input type="text" class="form-control" name="phone" value="{!! old('phone') !!}">
                                                @else
                                                @if (isset($staff->username))
                                                <input type="text" class="form-control" name="phone" value="{{ $staff->phone }}">
                                                @else
                                                <input type="text" class="form-control" name="phone" value="{!! old('phone') !!}">
                                                @endif
                                                @endif

                                                @error ('phone')
                                                <label class="error">{{ $message }}</label>
                                                @enderror
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                    </div>

                                    <div class="row">
                                        <div class="control-group col-md-6">
                                            <label class="control-label">@lang('languages.email') <span style="color: red;">*</span></label>
                                            <div class="controls">
                                                @if ($errors->any())
                                                <input type="text" class="form-control" name="email" value="{!! old('email') !!}">
                                                @else
                                                @if (isset($staff->username))
                                                <input type="text" class="form-control" name="email" value="{{ $staff->email }}">
                                                @else
                                                <input type="text" class="form-control" name="email" value="{!! old('email') !!}">
                                                @endif
                                                @endif

                                                @error ('email')
                                                <label class="error">{{ $message }}</label>
                                                @enderror
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->

                                        <div class="control-group col-md-6">
                                            <label class="control-label">@lang('languages.permission')</label>
                                            <div class="controls">
                                                <select class="form-select" name="permission">
                                                    <option value="1" {{ (old('permission') !== null && old('permission') == 1) ? 'selected' : '' }}>@lang('languages.staff')</option>
                                                    <option value="0" {{ (old('permission') !== null && old('permission') == 0) ? 'selected' : '' }}>@lang('languages.admin')</option>
                                                </select>
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                    </div>

                                    @if (Request::route()->getName() == "createUser")
                                    <div class="control-group">
                                        <label class="control-label">@lang('languages.password') <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <input type="password" class="form-control" name="password" value="{!! old('password') !!}">
                                            @else
                                            @if (isset($staff->username))
                                            <input type="password" class="form-control" name="password" value="{{ $staff->password }}">
                                            @else
                                            <input type="password" class="form-control" name="password" value="{!! old('password') !!}">
                                            @endif
                                            @endif

                                            @error ('password')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->
                                    @endif

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">@lang('languages.save')</button>
                                        <a href="{{ route('indexUser') }}" class="btn btn-danger">@lang('languages.cancel')</a>
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