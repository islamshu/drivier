@extends('layouts.landing')

@section('title')
@lang('app.homepage')
@endsection

@section('content')
<div class="bloc tc-white bloc-bg-texture texture-darken-strong bg-shutterstock-1251741952 l-bloc" id="bloc-18">
    <div class="container bloc-lg">
        <div class="row">
            <div class="order-lg-1 order-md-1 order-sm-1 order-1 col-lg-8 offset-lg-2">
                <h1 class="mg-md h1-color hero-text mx-auto d-block text-lg-center"><strong>A fleet of vehicles you can trust.</strong><br></h1>
                <p class="p-bloc-18-style text-lg-center">Whatever the reason, we have the right vehicle for you, with various options and sizes available. Our dry freight/refrigeration trucks have the most premier, high-quality cooling units and hwasung refrigerating systems on the market.
                    Facts are, we own our entire fleet of trucks, so you will never have to worry about the reliability of our deliveries.<br></p>
                <div class="row voffset-lg-xs row-margin-top">
                    <div class="offset-md-0 col-md-6 bloc-bloc-1-margin-top col-sm-8 offset-sm-2 col-lg-12 offset-lg-0">
                        <h3 class="mg-md h3-style text-lg-center text-sm-center text-center tc-white"><strong>Be part of our journey!</strong><br></h3>
                        <div class="text-center"><a href="{{ url(route('customer.register')) }}" class="btn btn-lg btn-rd btn-persian-red">Deliver with us</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- bloc-18 END -->
<!-- bloc-22 -->
<div class="bloc bgc-gainsboro tc-liver l-bloc" id="bloc-22">
    <div class="container bloc-lg">
        <div class="row">
            <div class="col-md-6 align-self-center order-lg-1 order-md-1"><img src="{{ asset('landing/img/pngguru.com%20%281%29.png')}}" class="img-fluid mx-auto d-block" alt="pngguru.com%20(1)" /></div>
            <div class="align-self-center col-md-6">
                <h2 class="mg-md text-lg-right text-md-right tc-persian-red"><strong>Hyundai HD 78 Truck</strong><br></h2>
                <h3 class="mg-md h3-bloc-19-style text-lg-right text-md-right tc-liver"><strong>Diesel (Dry Freight)</strong><br></h3>
                <p class="p-bloc-19-style text-lg-right text-md-right"><strong>Size:</strong> 5.00 x 2.35 x 2.20 cu m<br><strong>Weight Capacity:</strong> 4, 5 &amp; 6Ton <br><strong>Flooring:</strong> Aluminum Flooring<br></p>
                <a href="{{ url(route('customer.register')) }}" class="btn btn-lg btn-rd btn-persian-red btn-more-info-margin-top float-lg-right float-md-right">Book Now</a></div>
        </div>
    </div>
</div>
<!-- bloc-22 END -->
<!-- bloc-16 -->
<div class="bloc bgc-gainsboro none bg-gradient tc-white l-bloc" id="bloc-16">
    <div class="container bloc-lg">
        <div class="row">
            <div class="col-md-6 align-self-center col-lg-6 offset-lg-0 order-lg-0"><img src="{{ asset('landing/img/hyundai_hd120.png')}}" class="img-fluid mx-auto d-block" alt="pngguru.com%20(1)" /></div>
            <div class="align-self-center col-md-6">
                <h2 class="mg-md tc-white"><strong>Hyundai HD 78 Truck&nbsp;</strong><br></h2>
                <h3 class="mg-md h3-bloc-19-style tc-white"><strong>Diesel (Refrigeration)</strong><br></h3>
                <p class="p-bloc-19-style"><strong>Size:</strong> 5.00 x 2.35 x 2.20 cu m<br><strong>Weight Capacity:</strong> 4, 5 &amp; 6Ton <br><strong>Cooling Brand:</strong> HWASUNG HT 100 <br><strong>Temp:</strong> +15C<br><strong>Flooring:</strong> Aluminum Flooring<br></p>
                <a
                    href="{{ url(route('customer.register')) }}" class="btn btn-lg btn-rd btn-persian-red btn-more-info-margin-top">Book Now</a>
            </div>
        </div>
    </div>
</div>
<!-- bloc-16 END -->
<!-- bloc-19 -->
<div class="bloc bgc-gainsboro tc-liver none l-bloc" id="bloc-19">
    <div class="container bloc-lg">
        <div class="row">
            <div class="col-md-6 align-self-center col-lg-6 offset-lg-0 order-lg-1">
                <img src="{{ asset('landing/img/cattle%20truck.png') }}" class="img-fluid mx-auto d-block" alt="pngguru.com%20(1)" />
            </div>
            <div class="align-self-center col-md-6">
                <h2 class="mg-md tc-persian-red text-lg-right"><strong>Isuzu Truck Dyna</strong><span class="text-span-color"></span><br></h2>
                <h3 class="mg-md h3-bloc-19-style tc-liver text-lg-right"><strong>Diesel (Dry Freight)</strong><br></h3>
                <p class="p-bloc-19-style text-lg-right"><strong>Size:</strong> 5.00 x 2.20 cu m<br><strong>Weight Capacity:</strong> 4, 5 &amp; 6Ton <br><strong>Flooring:</strong> Aluminum Flooring<br></p><a href="{{ url(route('customer.register')) }}" class="btn btn-lg btn-rd btn-persian-red btn-more-info-margin-top float-lg-right">Book Now</a></div>
        </div>
    </div>
</div>
<!-- bloc-19 END -->
<!-- bloc-20 -->
<div class="bloc bgc-gainsboro bg-gradient tc-white l-bloc" id="bloc-20">
    <div class="container bloc-lg">
        <div class="row">
            <div class="col-md-6 align-self-center order-lg-0 order-md-0">
                <img src="{{ asset('landing/img/pickup-reefer.png') }}" class="img-fluid mx-auto d-block" alt="kindpng_227210" />
            </div>
            <div class="align-self-center col-md-6">
                <h2 class="mg-md tc-white"><strong>ISUZU DMAX 2.5 Diesel</strong><br></h2>
                <h3 class="mg-md h3-bloc-20-style tc-white"><strong>Refrigerating Pickup&nbsp;</strong><br></h3>
                <p class="p-bloc-20-style"><strong>Size:</strong> 32 x 175 x160 cu m<br><strong>Weight Capacity:</strong> 1 Ton <br><strong>Cooling Brand:</strong> HWASUNG HT 50 RT<br><strong>Temp:</strong> +15C<br><strong>Flooring:</strong> Aluminum Flooring<br></p>
                <a
                    href="{{ url(route('customer.register')) }}" class="btn btn-lg btn-rd btn-persian-red btn-more-info-margin-top">Book Now</a>
            </div>
        </div>
    </div>
</div>
<!-- bloc-20 END -->
<!-- bloc-21 -->
<div class="bloc bgc-gainsboro tc-liver l-bloc" id="bloc-21">
    <div class="container bloc-lg">
        <div class="row">
            <div class="col-md-6 align-self-center order-lg-1 order-md-1"><img src="{{ asset('landing/img/nissan_urvan.png') }}" class="img-fluid mx-auto d-block" alt="pngguru.com%20(1)" /></div>
            <div class="align-self-center col-md-6 order-md-0">
                <h2 class="mg-md text-lg-right text-md-right tc-persian-red"><strong>Nissan Urvan NV350 2.5 Petrol</strong></h2>
                <h3 class="mg-md h3-bloc-21-style text-lg-right text-md-right tc-liver"><strong>Dry Freight Van</strong></h3>
                <p class="p-bloc-21-style text-lg-right text-md-right"><strong>Size:</strong>1.35 x 1.54 x 2.86 cu m<br><strong>Weight Capacity:</strong> 1.5 Ton<br><strong>Flooring:</strong> Aluminum Flooring</p><a href="{{ url(route('customer.register')) }}" class="btn btn-lg btn-rd float-lg-right btn-more-info-margin-top btn-persian-red float-md-right">Book Now</a></div>
        </div>
    </div>
</div>
<!-- bloc-21 END -->
<!-- bloc-22 -->
<div class="bloc bgc-gainsboro bg-gradient tc-white l-bloc" id="bloc-22">
    <div class="container bloc-lg">
        <div class="row">
            <div class="col-md-6 align-self-center order-lg-1 order-md-0"><img src="{{ asset('landing/img/dmax_doubledoor.png') }}" class="img-fluid mx-auto d-block" alt="kindpng_227210" /></div>
            <div class="align-self-center col-md-6 order-lg-1">
                <h2 class="mg-md tc-white"><strong>Isuzu DMAX 2.5 Diesel</strong><br></h2>
                <h3 class="mg-md h3-bloc-22-style tc-white">Double Cab Pickup<br></h3>
                <p class="p-bloc-22-style"><strong>Size:</strong> 1.48 x 1.53 cu m<br><strong>Weight Capacity:</strong> 1 Ton&nbsp;<br></p><a href="{{ url(route('customer.register')) }}" class="btn btn-lg btn-rd btn-persian-red btn-more-info-margin-top">Book Now</a></div>
        </div>
    </div>
</div>
<!-- bloc-22 END -->
<!-- bloc-26 -->
<div class="bloc bgc-gainsboro tc-liver l-bloc" id="bloc-26">
    <div class="container bloc-lg">
        <div class="row">
            <div class="col-md-6 order-md-1 align-self-center order-lg-1"><img src="{{ asset('landing/img/Isuzu_D-Max_Mk2f_SingleCab_Ute_SX.png') }}" class="img-fluid mx-auto d-block" alt="kindpng_227210" /></div>
            <div class="align-self-center col-md-6">
                <h2 class="mg-md text-lg-right text-md-right tc-persian-red"><strong>Isuzu DMAX 2.5 Diesel</strong><br></h2>
                <h3 class="mg-md h3-bloc-22-style text-lg-right text-md-right tc-liver"><strong>Single Cab Pickup</strong><br></h3>
                <p class="p-bloc-22-style text-lg-right text-md-right"><strong>Size:</strong> 2.30 x 1.53 cu m<br><strong>Weight Capacity:</strong> 1 Ton&nbsp;<br></p><a href="{{ url(route('customer.register')) }}" class="btn btn-lg btn-rd float-lg-right btn-more-info-margin-top btn-persian-red float-md-right">Book Now</a></div>
        </div>
    </div>
</div>
<!-- bloc-26 END -->
<!-- bloc-27 -->
<div class="bloc bgc-gainsboro bg-gradient tc-white l-bloc" id="bloc-27">
    <div class="container bloc-lg">
        <div class="row">
            <div class="col-md-6 align-self-center order-lg-0 order-md-0"><img src="{{ asset('landing/img/Dokker.png') }}" class="img-fluid mx-auto d-block" alt="kindpng_227210" /></div>
            <div class="align-self-center col-md-6">
                <h2 class="mg-md tc-white"><strong>Renault Dokkar Van&nbsp;</strong><br></h2>
                <p class="p-bloc-22-style"><strong>Size:</strong> 1.85 x 1.08 x 1.27 <br><strong>Weight Capacity:</strong> 750KG<br></p><a href="{{ url(route('customer.register')) }}" class="btn btn-lg btn-rd btn-more-info-margin-top btn-persian-red">Book Now</a></div>
        </div>
    </div>
</div>
<!-- bloc-27 END -->
<!-- bloc-23 -->
<div class="bloc bgc-gainsboro tc-liver l-bloc" id="bloc-23">
    <div class="container bloc-lg">
        <div class="row">
            <div class="col-md-6 align-self-center order-md-0 order-lg-1"><img src="{{ asset('landing/img/hyundai_20accentltdsd5a_angularfront_frostwhitepearl.png') }}" class="img-fluid mx-auto d-block" alt="kindpng_227210" /></div>
            <div class="align-self-center col-md-6">
                <h2 class="mg-md text-lg-right tc-persian-red"><strong>Hyundai Accent 1.6</strong><br></h2>
                <p class="p-bloc-22-style text-lg-right text-md-right"><strong>Size:</strong> Food / Small items delivery<br><strong>Weight Capacity:</strong> Small items<br></p><a href="{{ url(route('customer.register')) }}" class="btn btn-lg btn-rd btn-more-info-margin-top btn-persian-red float-lg-right">Book Now</a></div>
        </div>
    </div>
</div>
<!-- bloc-23 END -->
<!-- ScrollToTop Button --><a class="bloc-button btn btn-d scrollToTop" onclick="scrollToTarget('1',this)"><span class="fa fa-chevron-up"></span></a>
<!-- ScrollToTop Button END-->
<!-- Bloc Group -->
<!-- Bloc Group -->
<div class="bloc-group">
    <!-- bloc-15 -->
    <div class="bloc none bloc-tile-2 bgc-persian-red tc-white d-bloc" id="bloc-15">
        <div class="container bloc-md">
            <div class="row align-items-center">
                <div class="col-12 align-self-center col-lg-8 offset-lg-2 col-sm-10 offset-sm-1">
                    <h2 class="mg-md tc-white h2-bloc-15-style"><strong>Want to know more?</strong></h2>
                    <p class="p-27-style">If your company is looking for ways to make your deliveries more efficient and cost-effective, get in touch with us today to find out more on how we can help.</p><a href="{{ url('/contact') }}" class="btn btn-lg btn-rd btn-style ">Contact Us</a></div>
            </div>
        </div>
    </div>
    <!-- bloc-15 END -->
    <!-- bloc-16 -->
    <div class="bloc none bloc-tile-2 bloc-bg-texture texture-darken bg-shutterstock-429499837 l-bloc" id="bloc-16">
        <div class="container bloc-md">
            <div class="row">
                <div class="col-12"></div>
            </div>
        </div>
    </div>
    <!-- bloc-16 END -->
</div>
@endsection