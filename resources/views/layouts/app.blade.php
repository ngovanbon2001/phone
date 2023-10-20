<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	@yield('title')
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="eCommerce HTML Template Free Download" name="keywords">
	<meta content="eCommerce HTML Template Free Download" name="description">

	<!-- Favicon -->
	<link href="img/favicon.ico" rel="icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Source+Code+Pro:700,900&display=swap" rel="stylesheet">

	<!-- CSS Libraries -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link href="{{ asset('fe/lib/slick/slick.css') }}" rel="stylesheet">
	<link href="{{ asset('fe/lib/slick/slick-theme.css') }}" rel="stylesheet">

	<!-- Template Stylesheet -->
	<link href="{{ asset('fe/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('fe/css/login-google.css') }}" rel="stylesheet">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

</head>

<body>
	<!-- Top bar Start -->
	<div class="top-bar">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<i class="fa fa-envelope"></i>
					ngovanbon2001@email.com
				</div>
				<div class="col-sm-6">
					<i class="fa fa-phone-alt"></i>
					+012-345-6789
				</div>
			</div>
		</div>
	</div>
	<!-- Top bar End -->

	<!-- Nav Bar Start -->
	<div class="nav">
		<div class="container-fluid">
			<nav class="navbar navbar-expand-md bg-dark navbar-dark">
				<a href="#" class="navbar-brand">MENU</a>
				<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
					<div class="navbar-nav mr-auto">
						<a href="{{ route('web.home') }}" class="nav-item nav-link {{ (Route::currentRouteName() == 'web.home') ? 'active' : '' }}">@lang('languages.home')</a>
						<a href="{{ route('web.product') }}" class="nav-item nav-link {{ ((Route::currentRouteName() == 'web.product') || (Route::currentRouteName() == 'web.product.detail')) ? 'active' : '' }}">@lang('languages.product')</a>
						@if(isset(auth()->user()->id))
						<a href="{{ route('order.show', auth()->user()->id ?? 0) }}" class="nav-item nav-link {{ (Route::currentRouteName() == 'order.show') ? 'active' : '' }}">@lang('languages.order')</a>
						@endif
						<a href="{{ route('cart', auth()->user()->id ?? 0) }}" class="nav-item nav-link {{ (Route::currentRouteName() == 'cart' ) ? 'active' : '' }}">@lang('languages.cart')</a>
					</div>
					<div class="navbar-nav ml-auto">
						<div class="nav-item dropdown">
							<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
								<img src="{{ asset(config('languages')[session()->get('locale') ?? 'vn']['flag-image'] ?? '') }}" alt="no image">
								<span>{{ config('languages')[session()->get('locale') ?? 'vn']['display'] ?? '' }}</span>
							</a>
							<div class="dropdown-menu">
								@foreach (config('languages') as $key => $value)
								<a href="{{ route('change.language', $value['flag-icon'] ?? 'vn') }}" class="dropdown-item">
									<img src="{{ asset($value['flag-image'] ?? '') }}" alt="no image">
									&emsp14;
									<span>{{ $value['display'] ?? '' }}</span>
								</a>
								@endforeach
							</div>
						</div>
						<div class="nav-item dropdown">
							<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ auth()->user()->username ?? __('languages.user_account') }}</a>
							<div class="dropdown-menu">
								@if(!isset(auth()->user()->id))
								<a href="{{ route('login') }}" class="dropdown-item">@lang('languages.login')</a>
								<a href="{{ route('register') }}" class="dropdown-item">@lang('languages.register')</a>
								@endif
								@if(isset(auth()->user()->id))
								<a class="dropdown-item d-flex align-items-center" href="{{ route('user.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
									<i class="bi bi-box-arrow-right"></i>
									<form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;" class="d-none">
										@csrf
									</form>
									<span>@lang('languages.logout')</span>
								</a>
								@endif
							</div>
						</div>
					</div>
				</div>
			</nav>
		</div>
	</div>
	<!-- Nav Bar End -->

	<!-- Bottom Bar Start -->
	<div class="bottom-bar">
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-md-3">
					<div class="logo">
						<a href="{{ route('web.home') }}">
							<h1>NHAT MAI</h1>
						</a>
					</div>
				</div>
				<div class="col-md-6">
					<div class="search">
						<form method="get" action="{{ route('web.product') }}">
							<input type="hidden" name="brand_id" value="{{ request('brand_id') ?? '' }}">
							<input type="hidden" name="category_id" value="{{ request('category_id') ?? '' }}">
							<input type="hidden" name="tags" value="{{ request('tags') ?? '' }}">
							<input type="text" name="name" placeholder="{{ __('languages.product_name') }}" value="{{ request('name') ?? '' }}">
							<button type="submit"><i class="fa fa-search"></i></button>
						</form>
					</div>
				</div>
				<div class="col-md-3">
					<div class="user">
						<a href="{{ route('cart', auth()->user()->id ?? 0) }}" class="btn cart">
							<i class="fa fa-shopping-cart"></i>
							<span id="total-items">{{ count(session()->get('cart-'. (auth()->user()->id ?? 0)) ?? []) }}</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Bottom Bar End -->

	@yield('content')

	<!-- Footer Start -->
	<div class="footer">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-widget">
						<h2>@lang('languages.get_in_touch')</h2>
						<div class="contact-info">
							<p><i class="fa fa-map-marker"></i>Thôn Na - Thanh Xuân - Sóc Sơn - Hà Nội</p>
							<p><i class="fa fa-envelope"></i>ngovanbon2001@example.com</p>
							<p><i class="fa fa-phone"></i>+123-456-7890</p>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6">
					<div class="footer-widget">
						<h2>@lang('languages.follow_us')</h2>
						<div class="contact-info">
							<div class="social">
								<a href=""><i class="fab fa-twitter"></i></a>
								<a href=""><i class="fab fa-facebook-f"></i></a>
								<a href=""><i class="fab fa-linkedin-in"></i></a>
								<a href=""><i class="fab fa-instagram"></i></a>
								<a href=""><i class="fab fa-youtube"></i></a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6">
					<div class="footer-widget">
						<h2>@lang('languages.company_info')</h2>
						<ul>
							<li><a href="#">@lang('languages.about_us')</a></li>
							<li><a href="#">@lang('languages.privacy_policy')</a></li>
							<li><a href="#">@lang('languages.terms_condition')</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-3 col-md-6">
					<div class="footer-widget">
						<h2>@lang('languages.purchase_info')</h2>
						<ul>
							<li><a href="#">@lang('languages.payment_policy')</a></li>
							<li><a href="#">@lang('languages.shipping_policy')</a></li>
							<li><a href="#">@lang('languages.return_policy')</a></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="row payment align-items-center">
				<div class="col-md-6">
					<div class="payment-method">
						<h2>@lang('languages.we_accept'):</h2>
						<img src="{{ asset('fe/img/payment-method.png') }}" alt="Payment Method" />
					</div>
				</div>
				<div class="col-md-6">
					<div class="payment-security">
						<h2>@lang('languages.secured_by'):</h2>
						<img src="{{ asset('fe/img/godaddy.svg') }}" alt="Payment Security" />
						<img src="{{ asset('fe/img/norton.svg') }}" alt="Payment Security" />
						<img src="{{ asset('fe/img/ssl.svg') }}" alt="Payment Security" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer End -->

	<!-- Footer Bottom Start -->
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-6 copyright">
					<p>Copyright &copy; <a href="#">Your Site Name</a>. All Rights Reserved</p>
				</div>

				<div class="col-md-6 template-by">
					<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
					<p>Designed By <a href="https://htmlcodex.com">HTML Codex</a></p>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer Bottom End -->

	<!-- Back to Top -->
	<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

	<!-- JavaScript Libraries -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
	<script src="{{ asset('fe/lib/easing/easing.min.js') }}"></script>
	<script src="{{ asset('fe/lib/slick/slick.min.js') }}"></script>

	<!-- Template Javascript -->
	<script src="{{ asset('fe/js/main.js') }}"></script>
	<script src="{{ asset('fe/js/custom.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

	@yield('script-custom')
	<style>
		label.error {
			color: #ca1d1d;
		}

		span.invalid-feedback {
			color: #ca1d1d;
		}
	</style>
	<script>
		setTimeout(function() {
			$(".alert").alert("close");
		}, 3000);
	</script>
</body>

</html>