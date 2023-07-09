@extends('driver.layouts.app')

@section('title')
@lang('app.dashboard')
@endsection

@section('content')
    @include('message')
    <div class="row">

        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 layout-spacing">
            <div class="widget-content widget-content-area br-4">                                    
                <div class="total-visits">                                        
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-6 mb-3">
                            <p class="t-v-value mb-0">{{ isset($orders) ? $orders : 0}}</p>
                        </div>

                        <div class="col-md-12">
                            <p class="t-v-txt d-flex">@lang('app.total_orders') <i class="flaticon-profits-1 align-self-center ml-2"></i></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 layout-spacing">
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

        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 layout-spacing">
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




@endsection
