@extends('customer.layouts.app')

@section('title')
    @lang('app.payment_gateway')
@endsection

@section('header')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/timedropper/timedropper.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
    
<div class="row" id="cancel-row">
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <div class="tab-content" id="justify-pills-tabContent">
                    <div class="tab-pane fade show active" id="justify-pills-home" role="tabpanel" aria-labelledby="justify-pills-home-tab">
                        <div class="row col-sm-50 col-50">
                            <div class="col-sm-1 col-12">
                                <div>
                                    <img class="fit-image" src="{{ asset('public/assets/img/mada.png')}}" width="105px" height="55px">
                                </div>
                            </div>
                            <div class="col-sm-1 col-12">
                                <div>
                                    <img class="fit-image" src="{{ asset('public/assets/img/visa.jpg')}}" width="105px" height="55px"> 
                                </div>
                            </div>
                            <div class="col-sm-1 col-12">
                                <div>
                                    <img class="fit-image" src="{{ asset('public/assets/img/master.jpg') }}" width="105px" height="55px">
                                </div>
                            </div>
                            <div class="col-sm-1 col-12">
                                <div>
                                    <img class="fit-image" src="{{ asset('public/assets/img/amex.png')}}" width="105px" height="55px">
                                </div>
                            </div>
                            <div class="col-sm-1 col-12">
                                <div>
                                    <img class="fit-image" src="{{ asset('public/assets/img/stc.png')}}" width="105px" height="55px">
                                </div>
                            </div>
                    
                            <br>
                        </div>
                        
                        @include('message')

                        {{-- @if(session()->has('success'))
                            <div class="alert alert-success text-center">
                                {{session()->get('success')}}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            </div>
                        @endif
                    
                        @if(session()->has('fail'))
                            <div class="alert alert-danger text-center">
                                {{session()->get('fail')}}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            </div>
                        @endif --}}
                    
                        <br>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">@lang('app.fname')</label>
                                    <input type="text" class="form-control" id="givenName" >
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">@lang('app.lname')</label>
                                    <input type="text" class="form-control" id="surname" >
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">@lang('app.email')</label>
                                <input type="email" class="form-control" id="email" >
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="address">@lang('app.address') 1</label>
                                    <input type="text" class="form-control" id="street1" placeholder="">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="address2">@lang('app.address') 2</label>
                                    <input type="text" class="form-control" id="city" placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3 d-none">
                                    <label for="address">الدولة</label>
                                    <input type="text" class="form-control" id="country" placeholder="">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="address2">@lang('app.postcode') </label>
                                    <input type="text" class="form-control" id="postcode" placeholder="">
                                </div>
                                <div class="col-md-6  mb-3">
                                    <label for="">@lang('app.state')</label>
                                    <input type="text" class="form-control" id="state" aria-describedby="state" placeholder="" name="state">
                                </div>
                            </div>
                                
                            <div class="mb-3">
                                <label for="">@lang('app.amount_to_pay')</label>
                                <input type="text" class="form-control" id="amount" aria-describedby="amount" placeholder="" name="amount">
                            </div>
                            <a id="checkout" href="{{route('customer.payment.checkout')}}"
                               role="button" class="btn  btn-success px-3 waves-effect waves-light"> ادفع مدى
                            </a>
                            <a id="checkout_credit_card" href="{{route('customer.payment.checkout_card')}}"
                               role="button" class="btn  btn-success px-3 waves-effect waves-light"> ادفع ماستر أو فيزا
                            </a>
                            <a id="checkout_STC_PAY" href="{{route('customer.payment.checkout_STC_PAY')}}"
                               role="button" class="btn  btn-success px-3 waves-effect waves-light"> ادفع STC_PAY
                            </a>
                            <div id="showPayForm"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')

    <script>
        $(document).on('click', '#checkout', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'get',
                url: "{{route('customer.payment.checkout')}}",
                data: {
                    amount: $('#amount').val(),
                    email: $('#email').val(),
                    street1: $('#street1').val(),
                    city: $('#city').val(),
                    state: $('#state').val(),
                    country: $('#country').val(),
                    postcode: $('#postcode').val(),
                    givenName: $('#givenName').val(),
                    surname: $('#surname').val(),
                },
                success: function (data) {
                    if (data.status == true) {
                        $('#showPayForm').empty().html(data.content);
                    } else {
                    }
                }, error: function (reject) {
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '#checkout_credit_card', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'get',
                url: "{{route('customer.payment.checkout_card')}}",
                data: {
                    amount: $('#amount').val(),
                    email: $('#email').val(),
                    street1: $('#street1').val(),
                    city: $('#city').val(),
                    state: $('#state').val(),
                    country: $('#country').val(),
                    postcode: $('#postcode').val(),
                    givenName: $('#givenName').val(),
                    surname: $('#surname').val(),

        },
                success: function (data) {
                    if (data.status == true) {
                        $('#showPayForm').empty().html(data.content);
                    } else {
                    }
                }, error: function (reject) {
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '#checkout_STC_PAY', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'get',
                url: "{{route('customer.payment.checkout_STC_PAY')}}",
                data: {
                    amount: $('#amount').val(),
                    email: $('#email').val(),
                    street1: $('#street1').val(),
                    city: $('#city').val(),
                    state: $('#state').val(),
                    country: $('#country').val(),
                    postcode: $('#postcode').val(),
                    givenName: $('#givenName').val(),
                    surname: $('#surname').val(),
                },
                success: function (data) {
                    if (data.status == true) {
                        $('#showPayForm').empty().html(data.content);
                    } else {
                    }
                }, error: function (reject) {
                }
            });
        });
    </script>
@endpush
