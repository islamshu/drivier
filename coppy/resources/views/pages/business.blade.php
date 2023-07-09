@extends('layouts.landing')

@section('title')
@lang('app.homepage')
@endsection


@section('content')
<!-- bloc-10 -->
<div class="bloc bgc-persian-red d-bloc" id="bloc-10">
    <div class="container ">
        <div class="row">
            <div class="col">
                <h1 class="mg-md tc-white text-center h1-bloc-10-style"><strong>Start Delivering with us</strong><br></h1>
            </div>
        </div>
    </div>
</div>
<!-- bloc-10 END -->
<!-- bloc-20 -->
<div class="bloc bg-maps d-bloc" id="bloc-20">
    <div class="container bloc-sm">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2"><img src="{{ asset('public/landing/img/Asset%204.svg')}}" class="img-fluid mx-auto d-block" alt="stock photo-several-cars-vans-trucks-parked-in-parking-lot-for-rent-or-delivery-1251741952" /></div>
        </div>
    </div>
</div>
<!-- bloc-20 END -->
<!-- bloc-11 -->
<div class="bloc bgc-gainsboro tc-black" id="bloc-11">
    <div class="container bloc-md">
        <div class="row">
            <div class="offset-lg-0 col-lg-12 offset-md-0 col-md-12 offset-sm-0 col-sm-12 bloc-margin-top">
                <h2 class="mg-md h2-style tc-black"><strong>Take the stress out of sending or receiving deliveries by signing up for our reliable service now. Registration is quick, easy and will save you time and money in the long-term.</strong><br></h2>
                <p class="p-bloc-11-style"><strong>Through our online business portal, you can:</strong><br></p>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h5 class="mg-md h5-style tc-black"><span class="icon-persian-red fa fa-check-square icon-sm"></span>&nbsp; &nbsp;Create a booking for a delivery to a customer<br></h5>
                        <h5 class="mg-md h5-bloc-11-style tc-black"><span class="icon-persian-red fa fa-check-square"></span>&nbsp; &nbsp;Create a booking for a pick-up from a supplier<br></h5>
                        <h5 class="mg-md h5-3-style tc-black"><span class="icon-persian-red fa fa-check-square"></span>&nbsp; &nbsp;Manage all of your orders through the integrated dashboard<br></h5>
                        <h5 class="mg-md h5-3-style tc-black"><span class="icon-persian-red fa fa-check-square"></span>&nbsp; &nbsp;Track all of your orders and deliveries in real time<br></h5>
                        <h5 class="mg-md h5-3-style tc-black"><span class="icon-persian-red fa fa-check-square"></span>&nbsp; &nbsp;Monitor your payment and accounts at the click of a button<br></h5>
                        <h5 class="mg-md h5-3-style tc-black"><span class="icon-persian-red fa fa-check-square"></span>&nbsp; &nbsp;Create user profiles for different members of your team<br></h5>
                    </div>
                    <div class="col">
                        <h5 class="mg-md h5-3-style tc-black"><span class="icon-persian-red fa fa-check-square"></span>&nbsp; &nbsp;Quickly manage or edit your pick-up or delivery addresses<br></h5>
                        <h5 class="mg-md h5-3-style tc-black"><span class="icon-persian-red fa fa-check-square"></span>&nbsp; &nbsp;Request instant quotes for upcoming jobs<br></h5>
                        <h5 class="mg-md h5-3-style tc-black"><span class="icon-persian-red fa fa-check-square"></span>&nbsp; &nbsp;Browse through the details of our entire fleet<br></h5>
                        <h5 class="mg-md h5-3-style tc-black"><span class="icon-persian-red fa fa-check-square"></span>&nbsp; &nbsp;Quickly access customer support<br></h5>
                        <h5 class="mg-md h5-3-style tc-black"><span class="icon-persian-red fa fa-check-square"></span>&nbsp; &nbsp;Rate our services and provide feedback<br></h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-lg-6 col">
                        <p class="p-21-style"><strong>If you&rsquo;re ready to get started, register now or contact one of our team members to find out more.</strong></p><a href="contact-us.html" class="btn btn-lg btn-rd btn-6-style btn-persian-red float-md-none btn-block">Deliver with us</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- bloc-11 END -->
<!-- bloc-13 -->
<div class="bloc none bg-gradient l-bloc" id="bloc-13">
    <div class="container bloc-md">
        <div class="row">
            <div class="col">
                <h2 class="mg-md tc-white text-lg-center text-md-center text-sm-center text-center h2-bloc-13-style"><strong>Who can benefit from us?</strong></h2>
            </div>
        </div>
        <div class="row">
            <div class="align-self-center col-md-6 col-lg-4 order-lg-0 order-md-1 order-sm-1 order-2">
                <div class="row voffset">
                    <div class="col-lg-12 bloc-margin-bottom">
                        <h4 class="text-center mg-sm text-lg-right tc-white">On Demand any time,<br>any day<br></h4>
                    </div>
                    <div class="col-lg-12 bloc-margin-bottom">
                        <h4 class="text-center mg-sm text-lg-right tc-white">Pharmaceutical<br></h4>
                    </div>
                    <div class="col-lg-12 bloc-margin-bottom">
                        <h4 class="text-center mg-sm text-lg-right tc-white">Healthcare<br></h4>
                    </div>
                    <div class="col-lg-12 bloc-margin-bottom">
                        <h4 class="text-center mg-sm text-lg-right tc-white">Automotive<br></h4>
                    </div>
                    <div class="col-lg-12 bloc-margin-bottom">
                        <h4 class="text-center mg-sm text-lg-right tc-white">Banks<br></h4>
                    </div>
                    <div class="col-lg-12">
                        <h4 class="text-center mg-sm text-lg-right tc-white">Legal<br></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 order-lg-0 order-md-0 offset-md-3 col-md-6 offset-lg-0 col-sm-8 offset-sm-2 order-sm-0 align-self-center">
                <img src="{{ asset('public/landing/img/iphone_mockup_2.png') }}" class="img-fluid mx-auto d-block img-iphone-mockup-style" alt="wtc_iphone_mockup" />
            </div>
            <div class="align-self-center col-md-6 col-lg-4 order-md-1 order-2">
                <div class="row voffset">
                    <div class="col-lg-12 bloc-margin-bottom">
                        <h4 class="text-center text-lg-left mg-sm tc-white">Routed Next day/weekly/monthly Deliveries</h4>
                    </div>
                    <div class="col-lg-12 bloc-margin-bottom">
                        <h4 class="text-center text-lg-left mg-sm tc-white">E Commerce<br></h4>
                    </div>
                    <div class="col-lg-12 bloc-margin-bottom">
                        <h4 class="text-center text-lg-left mg-sm tc-white">Commercial</h4>
                    </div>
                    <div class="col-lg-12 bloc-margin-bottom">
                        <h4 class="text-center text-lg-left mg-sm tc-white h4-color">Office Products<br></h4>
                    </div>
                    <div class="col-lg-12 bloc-margin-bottom">
                        <h4 class="text-center text-lg-left mg-sm tc-white">Mail Distribution<br></h4>
                    </div>
                    <div class="col-lg-12">
                        <h4 class="text-center text-lg-left mg-sm tc-white">Floral<br></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection