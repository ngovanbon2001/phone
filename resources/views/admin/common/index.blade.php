    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('homeAdmin') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                <span class="d-none d-lg-block">PhoneAdmin</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        @foreach (config('languages') as $key => $value)
                        @if ($key === session()->get('locale') ?? 'vn')
                        <img src="{{ asset($value['flag-image'] ?? '') }}" alt="no image">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ $value['display'] ?? '' }}</span>
                        @endif
                        @endforeach
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

                        @foreach (config('languages') as $key => $value)
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('change.language', $value['flag-icon'] ?? 'vn') }}">
                                <img src="{{ asset($value['flag-image'] ?? '') }}" alt="no image">
                                &emsp14;
                                <span>{{ $value['display'] ?? '' }}</span>
                            </a>

                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @endforeach

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->guard(App\Constants\Common::GUARD_ADMIN)->user()->username ? auth()->guard(App\Constants\Common::GUARD_ADMIN)->user()->username : "" }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ auth()->guard(App\Constants\Common::GUARD_ADMIN)->user()->username ? auth()->guard(App\Constants\Common::GUARD_ADMIN)->user()->username : "" }}</h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('showUser', auth()->guard(App\Constants\Common::GUARD_ADMIN)->user()->id) }}">
                                <i class="bi bi-person"></i>
                                <span>@lang('languages.profile')</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <span>@lang('languages.sign_out')</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('homeAdmin')}}">
                    <i class="bi bi-grid"></i>
                    <span>@lang('languages.dashboard')</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('indexBanners')}}">
                    <i class="ri-bank-card-fill"></i>
                    <span>@lang('languages.banner')</span>
                </a>
            </li><!-- End Banner Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>@lang('languages.brand')</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @foreach($brands as $item)
                    <li>
                        <a href="{{ route('indexProduct', ['brand' => $item->id ?? '']) }}">
                            <i class="bi bi-circle"></i><span>{{ $item->name ?? '' }}</span>
                        </a>
                    </li>
                    @endforeach
                    <li>
                        <a href="{{route('showBrand')}}">
                            <i class="bi bi-circle"></i><span>@lang('languages.list_brand')</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Brand Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>@lang('languages.category')</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @foreach($categories as $item)
                    <li>
                        <a href="{{ route('indexProduct', ['category' => $item->id ?? '']) }}">
                            <i class="bi bi-circle"></i><span>{{ $item->name ?? '' }}</span>
                        </a>
                    </li>
                    @endforeach
                    <li>
                        <a href="{{route('showCate')}}">
                            <i class="bi bi-circle"></i><span>@lang('languages.list_category')</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('indexReport') }}">
                    <i class="bi bi-megaphone"></i>
                    <span>@lang('languages.report')</span>
                </a>
            </li><!-- End Report Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('indexOrder') }}">
                    <i class="bx bxs-cart"></i>
                    <span>@lang('languages.order')</span>
                </a>
            </li><!-- End Order Nav -->

            @if (isset(auth()->guard(App\Constants\Common::GUARD_ADMIN)->user()->permission) && ((int)auth()->guard(App\Constants\Common::GUARD_ADMIN)->user()->permission === App\Constants\Common::ADMIN))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('indexUser') }}">
                    <i class="bi bi-people-fill"></i>
                    <span>@lang('languages.staff')</span>
                </a>
            </li><!-- End Account Nav -->
            @endif

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('customer.list') }}">
                    <i class="ri-user-2-fill"></i>
                    <span>@lang('languages.customer')</span>
                </a>
            </li><!-- End Customer Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('indexProduct') }}">
                    <i class="ri-product-hunt-fill"></i>
                    <span>@lang('languages.product')</span>
                </a>
            </li><!-- End Product Nav -->

            <li class="nav-heading">@lang('languages.pages')</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('showUser', auth()->guard('admin')->user()->id ?? '') }}">
                    <i class="bi bi-person"></i>
                    <span>@lang('languages.profile')</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('contact') }}">
                    <i class="bi bi-envelope"></i>
                    <span>@lang('languages.contact')</span>
                </a>
            </li><!-- End Contact Page Nav -->


            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <span>@lang('languages.logout')</span>
                </a>
            </li><!-- End Login Page Nav -->

        </ul>

    </aside><!-- End Sidebar-->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script type="text/javascript" src="{{asset('assets/activeAll.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js" integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css" integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />