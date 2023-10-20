<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => __('languages.login').' - Phone Admin'])

<body>
    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('assets/img/logo.png') }}" alt="">
                                    <span class="d-none d-lg-block">PhoneAdmin</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">@lang('languages.login_to_your_account')</h5>
                                        <p class="text-center small">@lang('languages.username_password')</p>
                                    </div>

                                    <form class="row g-3 needs-validation" action="{{route('admin.login.submit')}}" method="post" novalidate>
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">@lang('languages.email')</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="email" class="form-control" id="yourUsername" required>
                                                <div class="invalid-feedback">Please enter your username.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">@lang('languages.password')</label>
                                            <input type="password" name="password" class="form-control" id="yourPassword" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">@lang('languages.login')</button>
                                        </div>
                                    </form>

                                    @if (session()->has('message-error'))
                                    &emsp;
                                    <div class="alert alert-danger">
                                        {{ session('message-error') }}
                                    </div>
                                    @endif

                                </div>
                            </div>

                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                <div class="dropdown">
                                    <button class="dropbtn"><img src="{{ asset(config('languages')[session()->get('locale') ?? 'vn']['flag-image'] ?? '') }}" alt="">&emsp14;<span>{{ config('languages')[session()->get('locale') ?? 'vn']['display'] ?? '' }}</span></button>
                                    <div class="dropdown-content">
                                        @foreach (config('languages') as $key => $value)
                                        <a href="{{ route('change.language', $value['flag-icon'] ?? 'vn') }}"><img src="{{ asset($value['flag-image'] ?? '') }}" alt="no image">
                                            &emsp14;
                                            <span>{{ $value['display'] ?? '' }}</span></a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->
</body>

</html>
<style>
    /* Define the button and its appearance */
    .dropbtn {
        background-color: #4CAF50;
        color: white;
        padding: 12px;
        background-color: #0d6efd;
        border: none;
    }

    /* Style the container (div) that holds the dropdown */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Define the dropdown content (hidden by default) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    }

    /* Style the links inside the dropdown */
    .dropdown-content a {
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        color: #333;
    }

    /* Change color of links on hover */
    .dropdown-content a:hover {
        background-color: #ddd;
    }

    /* Show the dropdown content when the button is clicked */
    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>