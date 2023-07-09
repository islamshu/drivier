@extends('layouts.landing')

@section('title')
@lang('app.homepage')
@endsection


@section('content')
<!-- bloc-26 -->
<div class="bloc bgc-persian-red d-bloc" id="bloc-26">
    <div class="container ">
        <div class="row">
            <div class="col">
                <h1 class="mg-md text-lg-center tc-white text-center h1-bloc-26-style">We are your delivery partner</h1>
            </div>
        </div>
    </div>
</div>
<!-- bloc-26 END -->
<!-- bloc-27 -->
<div class="bloc l-bloc" id="bloc-27">
    <div class="container bloc-md">
        <div class="row">
            <div class="col-md-4"><img src="{{ asset('public/landing/img/restaurant.png') }}" class="img-fluid mx-auto d-block" alt="restaurant" /></div>
            <div class="col-md-4"><img src="{{ asset('public/landing/img/Pharmacy.png') }}" class="img-fluid mx-auto d-block" alt="Pharmacy" /></div>
            <div class="col-md-4"><img src="{{ asset('public/landing/img/warehouse.png') }}" class="img-fluid mx-auto d-block" alt="warehouse" /></div>
        </div>
    </div>
</div>
<!-- bloc-27 END -->
<!-- bloc-28 -->
<div class="bloc" id="bloc-28">
    <div class="container bloc-sm">
        <div class="row row-38-margin-bottom">
            <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 bgc-white drop-shaddow">
                <h1 class="mg-md text-lg-center h1-margin-bottom text-md-center text-center tc-black">How to Join Us</h1>
                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-3 col-md-3">
                        <div class="text-center">
                            <a href="javascript:;" class="btn btn-lg btn-rd btn-persian-red btn-clean number-button">1</a>
                        </div>
                        <h5 class="mg-md text-lg-center text-center tc-black">Submit your information</h5>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3 col-md-3 joinus-border">
                        <div class="text-center"><a href="javascript:;" class="btn btn-lg btn-rd btn-clean btn-persian-red number-button">2</a></div>
                        <h5 class="mg-md text-lg-center text-center tc-black">Our team&nbsp;will contact you<br><br></h5>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3 col-md-3 joinus-border">
                        <div class="text-center"><a href="javascript:;" class="btn btn-rd btn-persian-red btn-lg number-button">3</a>
                            <h5 class="mg-md text-lg-center btn-resize-mode h5-15-style tc-black">Setup your<br>company profile<br></h5>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 joinus-border">
                        <div class="text-center"><a href="javascript:;" class="btn btn-lg btn-rd btn-persian-red number-button">√<br></a></div>
                        <h5 class="mg-md text-lg-center text-center tc-black">Start making your orders</h5>
                    </div>
                </div>
                <div class="row row-bloc-28-margin-bottom">
                    <div class="col-lg-4 offset-lg-4">
                        <div class="text-center"><a href="{{ url(route('customer.register'))}}" class="btn btn-lg btn-persian-red btn-rd btn-apply-now-margin-top btn-block">Apply Now</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- bloc-28 END -->

<div class="bloc-group">
    <!-- bloc-15 -->
    <div class="bloc none bloc-tile-2 bgc-persian-red tc-white d-bloc" id="bloc-15">
        <div class="container bloc-md">
            <div class="row align-items-center">
                <div class="col-12 align-self-center col-lg-8 offset-lg-2 col-sm-10 offset-sm-1">
                    <h2 class="mg-md tc-white h2-bloc-15-style"><strong>Want to know more?</strong></h2>
                    <p class="p-27-style">If your company is looking for ways to make your deliveries more efficient and cost-effective, get in touch with us today to find out more on how we can help.</p>
                    <a href="{{ url('/contact')}}" class="btn btn-lg btn-rd btn-style ">Contact Us</a></div>
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
<!-- Bloc Group END -->
@endsection