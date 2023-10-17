<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => __('languages.profile').' - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@lang('languages.dashboard')</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">@lang('languages.home')</a></li>
                    <li class="breadcrumb-item active">@lang('languages.profile')</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <h2>{{ auth()->guard("admin")->user()->username }}</h2>
                            <div class="social-links mt-2">
                                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">@lang('languages.overview')</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">@lang('languages.edit_profile')</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">@lang('languages.change_password')</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                    <h5 class="card-title">@lang('languages.profile_details')</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">@lang('languages.full_name')</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->guard("admin")->user()->username }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">@lang('languages.phone_number')</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->guard("admin")->user()->phone }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">@lang('languages.email')</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->guard("admin")->user()->email }}</div>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <!-- Profile Edit Form -->
                                    <form method="post" action="{{ route('updateProfile', auth()->guard('admin')->user()->id) }}">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">@lang('languages.full_name')</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="username" type="text" class="form-control" id="fullName" value="{{ auth()->guard('admin')->user()->username }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">@lang('languages.phone_number')</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control" id="Phone" value="{{ auth()->guard('admin')->user()->phone }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">@lang('languages.email')</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" disabled class="form-control" id="Email" value="{{ auth()->guard('admin')->user()->email }}">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">@lang('languages.save')</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form method="post" action="{{ route('user.change-password', auth()->guard('admin')->user()->id) }}">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">@lang('languages.current_password')</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="curpassword" type="password" value="{!! old('curpassword') !!}" class="form-control" id="currentPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">@lang('languages.password')</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" value="{!! old('password') !!}" class="form-control" id="newPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password_confirmation" class="col-md-4 col-lg-3 col-form-label">@lang('languages.re_enter_password')</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password_confirmation" type="password"  value="{!! old('password_confirmation') !!}" class="form-control" id="renewPassword">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">@lang('languages.change_password')</button>
                                        </div>
                                    </form><!-- End Change Password Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                    @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li style="color: #dc3545;">{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    @include ('admin.common.footer')
</body>

</html>