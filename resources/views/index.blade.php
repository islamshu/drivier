@extends('layouts.landing')

@section('title')
@lang('app.homepage')
@endsection


@section('content')
<!-- Start Banner Area -->
<section class="banner-area bg-1 jarallax" data-jarallax='{"speed": 0.3}'>
	<div class="d-table">
		<div class="d-table-cell">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-9">
						<div class="banner-content">
							<span class="top-title wow fadeInDown" data-wow-delay="1s">{{ Config('app.name')}}</span>
							<h1 class="wow fadeInDown" data-wow-delay="1s">@lang('app.landing_title1')</h1>
								
							<p class="wow fadeInLeft" data-wow-delay="1s">@lang('app.landing_desc1')</p>

							<div class="banner-btn wow fadeInUp" data-wow-delay="1s">
								<a href="{{ url(route('customer.register')) }}" class="default-btn">
									<span>@lang('app.registernow')</span>
								</a>
								<a href="{{ url(route('customer.login')) }}" class="default-btn active">
									<span>@lang('app.login')</span>
								</a>
							</div>
						</div>
					</div>

					<div class="col-lg-3">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Banner Area -->

<!-- Start About Us Area -->
<section class="about-us-area pt-100 pb-70" id="features">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="about-content">
					<span class="top-title">@lang('app.features')</span>
					<h2>@lang('app.deliverwithus')</h2>
					
					<ul>
						<li><i class="bx bx-check"></i> @lang('app.feature1')</li>
						<li><i class="bx bx-check"></i> @lang('app.feature2')</li>
						<li><i class="bx bx-check"></i> @lang('app.feature3')</li>
						<li><i class="bx bx-check"></i> @lang('app.feature4')</li>
						<li><i class="bx bx-check"></i> @lang('app.feature5')</li>
						<li><i class="bx bx-check"></i> @lang('app.feature6')</li>
						<li><i class="bx bx-check"></i> @lang('app.feature7')</li>
						<li><i class="bx bx-check"></i> @lang('app.feature8')</li>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="about-img">
					<img src="{{ asset('landing/img/product-4.jpg') }}" alt="Image">
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End About Us Area -->

<!-- Start Services Area -->
<section class="services-area bg-color pt-100 pb-70" id="about">
	<div class="container">
		<div class="section-title">
			<h2>@lang('app.whoneedourservices')</h2>
		</div>

		<div class="row">
			<div class="col-lg-4 col-sm-6">
				<div class="single-services-box">
					<i class="flaticon-fast-delivery-1"></i>
					<h3>@lang('app.whoneedourservices1')</h3>
				</div>
			</div>

			<div class="col-lg-4 col-sm-6">
				<div class="single-services-box">
					<i class="flaticon-boat"></i>
					<h3>@lang('app.whoneedourservices2')</h3>
				</div>
			</div>

			<div class="col-lg-4 col-sm-6 offset-sm-3 offset-lg-0">
				<div class="single-services-box">
					<i class="flaticon-airplane"></i>
					<h3>@lang('app.whoneedourservices3')</h3>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Services Area -->

<!-- Start Choose Us Area -->
<section class="choose-us-area pt-100 pb-70">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="choose-us-content">
					<h2>@lang('app.joinusasdriver')</h2>
					<p>@lang('app.joinusasdriver_title')</p>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="choose-us-img">
					<img src="{{ asset('landing/img/courier-man.png') }}" alt="Image">
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Choose Us Area -->

<!-- Start Shipment Area -->
<section class="shipment-area ptb-100 jarallax" data-jarallax='{"speed": 0.3}'>
	<div class="container">
		<div class="shipment-content">
			<span class="top-title">{{ Config('app.name')}}</span>
			<h2>@lang('app.landing_title1')</h2>
			<p>@lang('app.landing_desc1')</p>

			<div class="shipment-btn">
				<a href="{{ url(route('customer.register'))}}" class="default-btn">
					<span>@lang('app.registernow')</span>
				</a>
				<a href="{{ url(route('customer.login'))}}" class="default-btn active">
					<span>@lang('app.login')</span>
				</a>
			</div>
		</div>
	</div>
</section>
<!-- End Shipment Area -->

@endsection

