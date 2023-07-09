@extends('customer.layouts.app')

@section('title')
@lang('app.dashboard')
@endsection

@section('header')
<link href="{{ asset('public/assets/css/ecommerce-dashboard/style.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @include('message')

    <div class="row">
        <div class="col-xl-4 col-lg-12 col-md-6 col-sm-12">
            <div class="row">

                <div class="col-xl-12 col-lg-6">
                    <div class="widget-content-area br-4 mb-4 layout-spacing">
                        <div class="widget  t-order-widget">
                            <div class="row">
                                <div class="col-md-5 col-sm-5 col-12 text-md-left text-center pr-0 mt-sm-0 mt-4  order-1 order-sm-0">
                                    <p class="t-o-txt mb-3 mb-sm-5 mt-3">@lang('app.total_today_orders')</p>
                                    <p class="t-o-value">{{ isset($ordersCount) ? $ordersCount : 0 }} <i class="flaticon-arrow-up"></i></p>
                                    <div class="t-o-icon">
                                        <i class="flaticon-cart-2"></i>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-7 col-12">
                                    <div class="cogs  mt-sm-5 mt-3  ml-md-auto mx-auto"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-6">
                    <div class="widget-content-area br-4 layout-spacing">
                       
                    </div>
                </div>

            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 layout-spacing">
            <div class="row">

                <div class="col-xl-12 mb-4">
                    <div class="widget-content widget-content-area br-4">                                    
                        <div class="total-visits">                                        
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-6 mb-3">
                                    <p class="t-v-value mb-0">{{ isset($totalOrders) ? $totalOrders : 0}}</p>
                                </div>

                                <div class="col-md-12">
                                    <p class="t-v-txt d-flex">@lang('app.total_orders') <i class="flaticon-profits-1 align-self-center ml-2"></i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 mb-4">
                    <div class="widget-content widget-content-area br-4">                                    
                        <div class="unique-visits">                                        
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-6 mb-3">
                                    <p class="u-v-value mb-0 d-flex">{{ isset($totalDeliveredOrders) ? $totalDeliveredOrders : 0}}</p>
                                </div>
                                <div class="col-md-12">
                                    <p class="u-v-txt mb-0">@lang('app.delivered_orders') <i class="flaticon-up-arrow-3 align-self-center ml-2"></i></p>
                                </div>
                            </div>                                        
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 mb-4">
                    <div class="widget-content widget-content-area br-4">                                    
                        <div class="page-views">                                        
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-6 mb-3">
                                    <p class="p-v-value mb-0 d-flex">{{ isset($totalReturnedOrders) ? $totalReturnedOrders : 0}}</p>
                                </div>
                                <div class="col-md-12">
                                    <p class="p-v-txt mb-0">@lang('app.returned_orders') <i class="flaticon-down-arrow-3 align-self-center ml-2"></i></p>
                                </div>
                            </div>                                        
                        </div>
                    </div>
                </div>

            </div>
        </div>

        
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 layout-spacing">
            <div class="row">

                <div class="col-xl-12 mb-4">
                    <div class="widget-content widget-content-area br-4">                                    
                        <div class="total-visits">                                        
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-6 mb-3">
                                    <p class="t-v-value mb-0">{{ isset($totalOrdersPayment) ? $totalOrdersPayment : 0}} @lang('app.ras')</p>
                                </div>

                                <div class="col-md-12">
                                    <p class="t-v-txt d-flex">@lang('app.total_amount')  <i class="flaticon-profits-1 align-self-center ml-2"></i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 mb-4">
                    <div class="widget-content widget-content-area br-4">                                    
                        <div class="unique-visits">                                        
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-6 mb-3">
                                    <p class="u-v-value mb-0 d-flex">{{ isset($totalOrdersPaid) ? $totalOrdersPaid : 0}} @lang('app.ras')</p>
                                </div>
                                <div class="col-md-12">
                                    <p class="u-v-txt mb-0">@lang('app.total_amount_received') <i class="flaticon-up-arrow-3 align-self-center ml-2"></i></p>
                                </div>
                            </div>                                        
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-sm-">
                    <div class="widget-content widget-content-area br-4">                                    
                        <div class="page-views">                                        
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-6 mb-3">
                                    <p class="p-v-value mb-0 d-flex">{{ isset($totalOrdersUnpaid) ? $totalOrdersUnpaid : 0}} @lang('app.ras')</p>
                                </div>
                                <div class="col-md-12">
                                    <p class="p-v-txt mb-0">@lang('app.total_amount_remaining') <i class="flaticon-down-arrow-3 align-self-center ml-2"></i></p>
                                </div>
                            </div>                                        
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection