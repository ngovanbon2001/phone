<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>mPurpose - Multipurpose Feature Rich Bootstrap Template</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">

	<link rel="stylesheet" href="{{asset('front-end/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('front-end/css/icomoon-social.css')}}">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="{{asset('front-end/css/leaflet.css')}}" />
	<!--[if lte IE 8]>
		    <link rel="stylesheet" href="css/leaflet.ie.css" />
		<![endif]-->
	<link rel="stylesheet" href="{{asset('front-end/css/main.css')}}">

	<script src="{{asset('front-end/js/modernizr-2.6.2-respond-1.1.0.min.js')}}"></script>

	<!-- Include Toastr library -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
	<!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->


	<!-- Navigation & Logo-->
	<div class="mainmenu-wrapper">
		<div class="container">
			<div class="menuextras">
				<div class="extras">
					<ul>
						<li class="shopping-cart-items"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> <a href="{{ route('cart', auth()->user()->id ?? 0) }}"><b>{{ count(session()->get('cart-'. (auth()->user()->id ?? 0)) ?? []) }} items</b></a></li>
						<li class="{{ isset(auth()->user()->id) ? 'hidden' : '' }}"><a href="{{ route('login') }}">Login</a></li>
						<li class="nav-item {{ !(isset(auth()->user()->id)) ? 'hidden' : '' }}">
							<a class="nav-link collapsed" href="{{ route('user.logout') }}">
								<i class="bi bi-box-arrow-in-right"></i>
								<span>Logout</span>
							</a>
						</li><!-- End Login Page Nav -->
						<li><p>{{ auth()->user()->username ?? '' }}</p></li>
					</ul>
				</div>
			</div>
			<nav id="mainmenu" class="mainmenu">
				<ul>
					<li class="logo-wrapper"><a href="index.html"><img src="{{ asset('front-end/img/mPurpose-logo.png') }}" alt="Multipurpose Twitter Bootstrap Template"></a></li>
					<li class="{{(Route::currentRouteName() == 'web.home') ? 'active' : ''}}">
						<a href="{{ route('web.home') }}">Home</a>
					</li>
					<li class="{{(Route::currentRouteName() == 'web.product' || Route::currentRouteName() == 'web.product.detail') ? 'active' : ''}}">
						<a href="{{ route('web.product') }}">Product</a>
					</li>
					<li>
						<a href="features.html">Features</a>
					</li>
				</ul>
				@if(!in_array(Route::currentRouteName(), App\Constants\Common::HIDDEN_SEARCH))
				<div class="row" style="display: flex; justify-content: center; padding: 10px;">
					<form method="get" action="{{ route('web.product') }}">
						<div class="input-group">
							<input class="form-control input-md" id="appendedInputButtons" name="name" type="text">
							<span class="input-group-btn">
								<button class="btn btn-md" type="submit">Search</button>
							</span>
						</div>
					</form>
				</div>
				@endif
			</nav>
		</div>
	</div>

	@yield('content')

	<!-- Footer -->
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="col-footer col-md-3 col-xs-6">
					<h3>Our Latest Work</h3>
					<div class="portfolio-item">
						<div class="portfolio-image">
							<a href="page-portfolio-item.html"><img src="{{ asset('front-end/img/portfolio6.jpg') }}" alt="Project Name"></a>
						</div>
					</div>
				</div>
				<div class="col-footer col-md-3 col-xs-6">
					<h3>Navigate</h3>
					<ul class="no-list-style footer-navigate-section">
						<li><a href="page-blog-posts.html">Blog</a></li>
						<li><a href="page-portfolio-3-columns-2.html">Portfolio</a></li>
						<li><a href="page-products-3-columns.html">eShop</a></li>
						<li><a href="page-services-3-columns.html">Services</a></li>
						<li><a href="page-pricing.html">Pricing</a></li>
						<li><a href="page-faq.html">FAQ</a></li>
					</ul>
				</div>

				<div class="col-footer col-md-4 col-xs-6">
					<h3>Contacts</h3>
					<p class="contact-us-details">
						<b>Address:</b> 123 Fake Street, LN1 2ST, London, United Kingdom<br />
						<b>Phone:</b> +44 123 654321<br />
						<b>Fax:</b> +44 123 654321<br />
						<b>Email:</b> <a href="mailto:getintoutch@yourcompanydomain.com">getintoutch@yourcompanydomain.com</a>
					</p>
				</div>
				<div class="col-footer col-md-2 col-xs-6">
					<h3>Stay Connected</h3>
					<ul class="footer-stay-connected no-list-style">
						<li><a href="#" class="facebook"></a></li>
						<li><a href="#" class="twitter"></a></li>
						<li><a href="#" class="googleplus"></a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="footer-copyright">&copy; 2013 mPurpose. All rights reserved.</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Javascripts -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>
		window.jQuery || document.write('<script src="{{asset("front-end/js/jquery-1.9.1.min.js")}}"><\/script>')
	</script>
	<script src="{{asset('front-end/js/bootstrap.min.js')}}"></script>
	<script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
	<script src="{{asset('front-end/js/jquery.fitvids.js')}}"></script>
	<script src="{{asset('front-end/js/jquery.sequence-min.js')}}"></script>
	<script src="{{asset('front-end/js/jquery.bxslider.js')}}"></script>
	<script src="{{asset('front-end/js/main-menu.js')}}"></script>
	<script src="{{asset('front-end/js/template.js')}}"></script>

</body>

</html>
<style>
	.hidden {
		display: none;
	}
</style>