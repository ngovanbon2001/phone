<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => 'Edit user - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('indexUser')}}">Account</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                    <li class="breadcrumb-item active">{{ $staff->username ?? "" }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit account form</h5>

                            <!-- General Form Elements -->
                            <form action="{{ route('updateUser', $staff->id) }}" method="post" id="edit-profile" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <fieldset>

                                    <div class="row">
                                        <div class="control-group col-md-6">
                                            <label class="control-label">User's name <span style="color: red;">*</span></label>
                                            <div class="controls">
                                                @if ($errors->any())
                                                <input type="text" class="form-control" name="username" value="{!! old('username') !!}">
                                                @else
                                                <input type="text" class="form-control" name="username" value="{{ $staff->username }}">
                                                @endif

                                                @error ('username')
                                                <label class="error">{{ $message }}</label>
                                                @enderror
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->

                                        <div class="control-group col-md-6">
                                            <label class="control-label">Phone <span style="color: red;">*</span></label>
                                            <div class="controls">
                                                @if ($errors->any())
                                                <input type="text" class="form-control" name="phone" value="{!! old('phone') !!}">
                                                @else
                                                <input type="text" class="form-control" name="phone" value="{{ $staff->phone }}">
                                                @endif

                                                @error ('phone')
                                                <label class="error">{{ $message }}</label>
                                                @enderror
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Email <span style="color: red;">*</span></label>
                                        <div class="controls">
                                            @if ($errors->any())
                                            <input type="text" class="form-control" name="email" value="{!! old('email') !!}">
                                            @else
                                            <input type="text" class="form-control" name="email" value="{{ $staff->email }}">
                                            @endif

                                            @error ('email')
                                            <label class="error">{{ $message }}</label>
                                            @enderror
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{ route('indexUser') }}" class="btn btn-danger">Cancel</a>
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