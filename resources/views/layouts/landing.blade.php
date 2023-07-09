<!doctype html>
<html lang="ar">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>{{ Config('app.name') }} :: @yield('title')</title>
		<link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('landing/css/owl.theme.default.min.css') }}">
		<link rel="stylesheet" href="{{ asset('landing/css/owl.carousel.min.css') }}">
		<link rel="stylesheet" href="{{ asset('landing/css/animate.min.css') }}">
		<link rel="stylesheet" href="{{ asset('landing/css/boxicons.min.css') }}"> 
		<link rel="stylesheet" href="{{ asset('landing/css/magnific-popup.min.css') }}"> 
		<link rel="stylesheet" href="{{ asset('landing/css/flaticon.css') }}">
		<link rel="stylesheet" href="{{ asset('landing/css/meanmenu.min.css') }}">
		<link rel="stylesheet" href="{{ asset('landing/css/nice-select.min.css') }}">
		<link rel="stylesheet" href="{{ asset('landing/css/odometer.min.css') }}">
		<link rel="stylesheet" href="{{ asset('landing/css/style.css?v=dasdasd') }}">
		<link rel="stylesheet" href="{{ asset('landing/css/responsive.css') }}">
		<link rel="icon" type="image/png" href="{{ asset('wtc_logo_gray.png') }}">
		<link rel="stylesheet" href="{{ asset('fonts/font-ar.css')}}">
		@if (LaravelLocalization::getCurrentLocale() == 'ar')
		<style>
			body {
				font-family: 'Al-Jazeera-Arabic';
				font-weight: 600;
				font-style: normal;
				direction: rtl !important;
			}
			.about-content ,
			.choose-us-content {
				text-align: right
			}
			.about-content ul li i {
				right: 0;
			}
			.about-content ul li  {
				padding-right: 30px;
			}
		</style>
		@else
		<style>
			body {
				font-family: 'Al-Jazeera-Arabic' , sans-serif;
			}
			.about-content ul li i {
				left: 0;
			}
		</style>
		@endif
    </head>

    <body>
		<!-- Start Header Area -->
		<header class="header-area">
			<!-- Start Navbar Area -->
			<div class="navbar-area">
				<div class="mobile-nav">
					<div class="container">
						<div class="mobile-menu">
							<div class="logo">
								<a href="{{ url('/')}}">
									<img src="{{ asset('wtc_logo_gray.png') }}" height="45" width="50" alt="Helpway">
								</a>
							</div>
						</div>
					</div>
				</div>
	
				<div class="desktop-nav">
					<div class="container">
						<nav class="navbar navbar-expand-md navbar-light">
							<a class="navbar-brand" href="{{ url('/')}}">
								<img src="{{ asset('wtc_logo_gray.png') }}" height="45" width="100" alt="Helpway">
							</a>
	
							<div class="collapse navbar-collapse mean-menu">
								<ul class="navbar-nav m-auto">

									<li class="nav-item">
										<a href="{{ url('/') }}" class="nav-link">@lang('app.homepage')</a>
									</li>
		
									<li class="nav-item">
										<a href="#features" class="nav-link">@lang('app.features')</a>
									</li>
									<li class="nav-item">
										<a href="#about" class="nav-link">@lang('app.about')</a>
									</li>
									<li class="nav-item">
										<a href="#" class="nav-link active">
											<img src="{{ asset('assets/img/'.LaravelLocalization::getCurrentLocale().'.png') }}" height="20" width="20" alt=""> 
											<i class="bx bx-chevron-down"></i>
										</a>
										<ul class="dropdown-menu">
											@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
											<li class="nav-item">
												<a class="nav-link" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
													<img src="{{ asset('assets/img/'.$localeCode.'.png') }}" class="flag-width" width="16" height="11" alt=""> 
													&#xA0; {{ $properties['native'] }}
												</a>
											</li>
											@endforeach
											
										</ul>
									</li>

								</ul>
								
								
								<div class="others-option">
									<div class="get-quote">
										<a href="{{ url(route('customer.register'))}}" class="default-btn">
											<span>@lang('app.registernow')</span>
										</a>
									</div>
								</div>
							</div>
						</nav>
					</div>
				</div>
			</div>
			<!-- End Navbar Area -->
		</header>
		<!-- End Header Area -->

		@yield('content')
		<!-- Start Footer Area -->
		<footer class="footer-area text-center pt-100 pb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="single-footer-widget">
							<a href="{{ url('/')}}" class="logo">
								<img src="{{ asset('wtc_logo_gray.png') }}" height="50" width="200" alt="Image">
							</a>
							<ul class="social-icon">
								<li>
									<a href="#">
										<i class="bx bxl-facebook"></i>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="bx bxl-instagram"></i>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="bx bxl-linkedin-square"></i>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="bx bxl-twitter"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>

					{{-- <div class="col-lg-3 col-md-6">
						<div class="single-footer-widget">
							<h3>Services</h3>

							<ul class="import-link">
								<li>
									<a href="#">Sea Freight</a>
								</li>
								<li>
									<a href="#">Air Freight</a>
								</li>
								<li>
									<a href="#">Road Freight</a>
								</li>
								<li>
									<a href="#">Local Delivery</a>
								</li>
								<li>
									<a href="#">Bus Freight</a>
								</li>
								<li>
									<a href="#">Car Freight</a>
								</li>
							</ul>
						</div>
					</div>

					<div class="col-lg-3 col-md-6">
						<div class="single-footer-widget">
							<h3>Company</h3>

							<ul class="import-link">
								<li>
									<a href="about-us.html">About Us</a>
								</li>
								<li>
									<a href="team.html">Team</a>
								</li>
								<li>
									<a href="faq.html">FAQ</a>
								</li>
								<li>
									<a href="blog-column-one.html">Blog</a>
								</li>
								<li>
									<a href="privacy-policy.html">Privacy Policy</a>
								</li>
								<li>
									<a href="terms-conditions.html">Terms And Conditions</a>
								</li>
							</ul>
						</div>
					</div> --}}

					<div class="col-lg-3 col-md-6">
						{{-- <div class="single-footer-widget">
							<h3>Address</h3>

							<ul class="address">
								<li class="location">
									<i class="bx bxs-location-plus"></i>
									9170 Millbrook Rd, Newark, IL 60541 
								</li>
								<li>
									<i class="bx bxs-envelope"></i>
									<a href="mailto:hello@ezio.com">hello@ezio.com</a>
									<a href="mailto:info@ezio.com">info@ezio.com</a>
								</li>
								<li>
									<i class="bx bxs-phone-call"></i>
									<a href="tel:+1-(123)-456-7890">+1 (123) 456 7890</a>
									<a href="tel:+1-(514)-312-6678">+1 (514) 312-6678</a>
								</li>
							</ul>
						</div> --}}
					</div>
				</div>
			</div>
		</footer>
		
		<div class="go-top">
			<i class="bx bx-chevrons-up"></i>
			<i class="bx bx-chevrons-up"></i>
		</div>
		

        <script src="{{ asset('landing/js/jquery.min.js') }}"></script>
        <script src="{{ asset('landing/js/popper.min.js') }}"></script>
        <script src="{{ asset('landing/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('landing/js/meanmenu.min.js') }}"></script>
        <script src="{{ asset('landing/js/wow.min.js') }}"></script>
		<script src="{{ asset('landing/js/owl.carousel.min.js') }}"></script>
		<script src="{{ asset('landing/js/nice-select.min.js') }}"></script>
		<script src="{{ asset('landing/js/magnific-popup.min.js') }}"></script>
		<script src="{{ asset('landing/js/parallax.min.js') }}"></script>
        <script src="{{ asset('landing/js/appear.min.js') }}"></script>
		<script src="{{ asset('landing/js/odometer.min.js') }}"></script>
		<script src="{{ asset('landing/js/smoothscroll.min.js') }}"></script>
		<script src="{{ asset('landing/js/ajaxchimp.min.js') }}"></script>
		<script src="{{ asset('landing/js/custom.js?v=ss') }}"></script>
    </body>
</html>