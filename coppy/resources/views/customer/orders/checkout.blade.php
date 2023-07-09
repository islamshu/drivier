@extends('customer.layouts.app') 

@section('title')
@lang('app.paymentPage')
@endsection

@section('header')

<link href="{{ asset('public/assets/css/ecommerce/ecommerce-wizards.css')}}" rel="stylesheet" type="text/css">
<style>
    .input-control.required input { border: 1px dashed #b7b7b7; border-radius: 2px; }
        label { color: #3b3f5c; margin-bottom: 14px; }
    .form-control::-webkit-input-placeholder { color: #888ea8; font-size: 15px; }
    .form-control::-ms-input-placeholder { color: #888ea8; font-size: 15px; }
    .form-control::-moz-placeholder { color: #888ea8; font-size: 15px; }
    .form-control {
        border: 1px solid #ccc;
        color: #888ea8;
        font-size: 15px;
        border-radius: 2px;
    }
    .form-control:focus { border-color: #f1f3f1; border-left: solid 3px #3862f5; }
</style>
@endsection

@section('content')

@include('message')

<div class="row">
    <div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow mt-5">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('app.paymentPage')</h4>
                    </div>                                                                        
                </div>
            </div>

            <div class="widget-content widget-content-area">
                <form action="javascript:;" method="post">
                    @csrf
                    
                    <div class="rounded-pills-icon checkout-method">
                        <ul class="nav nav-pills mb-4  justify-content-center" id="rounded-pills-icon-tab" role="tablist">
                            <li class="nav-item ml-2 mr-2">
                                <a class="nav-link mb-2 active text-center" id="rounded-pills-icon-home-tab" data-toggle="pill" href="#rounded-pills-icon-home" role="tab" aria-controls="rounded-pills-icon-home" aria-selected="true"><i class="flaticon-credit-card"></i> @lang('app.paymentWithCard')</a>
                            </li>
                            {{-- <li class="nav-item ml-2 mr-2">
                                <a class="nav-link mb-2 text-center" id="rounded-pills-icon-profile-tab" data-toggle="pill" href="#rounded-pills-icon-profile" role="tab" aria-controls="rounded-pills-icon-profile" aria-selected="false"><i class="flaticon-paypal-logo"></i> PayPal</a>
                            </li> --}}
                            <li class="nav-item ml-2 mr-2">
                                <a class="nav-link mb-2 text-center" id="rounded-pills-icon-contact-tab" data-toggle="pill" href="#rounded-pills-icon-contact" role="tab" aria-controls="rounded-pills-icon-contact" aria-selected="true"><i class="flaticon-dollar-coin"></i> الدفع كاش</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="rounded-pills-icon-tabContent">
                            <div class="tab-pane fade show active" id="rounded-pills-icon-home" role="tabpanel" aria-labelledby="rounded-pills-icon-home-tab">
                                <h5 class="p-methods-title mb-5 mt-5 text-center">@lang('app.paymentWithCard')</h5>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <select class="form-control  mt-1 mb-2" name="cardType">
                                                <option value="0">@lang('app.cardType')</option>
                                                <option value="VISA">@lang('app.visa')</option>
                                                <option value="MADA">@lang('app.mada')</option>
                                                <option value="MASTER">@lang('app.master')</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <input type="text" class="form-control mt-1 mb-2" name="cardHolder" placeholder="@lang('app.cardHolder')">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <input type="text" class="form-control sm-0 mt-1 mb-2" name="cardNumer" placeholder="@lang('app.cardNumer')">
                                    </div>
                                    <div class="col-sm-2 col-12">
                                        <input type="text" class="form-control mt-1 mb-2" name="cardExpireMonth" placeholder="@lang('app.cardExpireMonth')">
                                    </div>
                                    <div class="col-sm-2 col-12">
                                        <input type="text" class="form-control mt-1 mb-2" name="cardExpireYear" placeholder="@lang('app.cardExpireYear')">
                                    </div>
                                    <div class="col-sm-2 col-12">
                                        <input type="text" class="form-control mt-1 mb-2" name="cardCvv" placeholder="@lang('app.cardCvv')">
                                    </div>
                                    <div class="col-md-12 text-center mt-1">
                                        <button type="submit" class="btn btn-success btn-rounded my-5 confirm-credit">@lang('app.payNow')</button>
                                    </div>  
                                </div>
                            </div>
                            {{-- <div class="tab-pane fade" id="rounded-pills-icon-profile" role="tabpanel" aria-labelledby="rounded-pills-icon-profile-tab">
                                <h5 class="p-methods-title mb-5 mt-4 text-center">Paypal</h5>
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <input type="text" class="form-control mt-4 mb-4" placeholder="Enter Your Paypal Email">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <input type="password" class="form-control mt-4 mb-4" placeholder="Enter Your Paypal Password">
                                    </div>
                                    <div class="col-md-12 text-center mt-4">
                                        <button class="btn btn-success btn-rounded my-5 confirm-paypal">Confirm</button>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="tab-pane fade" id="rounded-pills-icon-contact" role="tabpanel" aria-labelledby="rounded-pills-icon-contact-tab">
                                <h5 class="p-methods-title mb-5 mt-4 text-center">الدفع عند الإستلام</h5>
                                <div class="container">
                                    <div class="place-order-cash text-center mx-auto">
                                        <i class="flaticon-coin-icon mb-4"></i>
                                        <p class="mb-4 mt-4">الرجاء تأكيد رغبتك بالدفع عند الإستلام</p>
                                        <button class="btn btn-success btn-rounded my-4  confirm-cash">تأكيد</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        
@endsection
