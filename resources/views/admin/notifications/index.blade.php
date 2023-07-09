@extends('admin.layouts.app')

@section('title')
@lang('app.notification')
@endsection

@section('header')
<link href="{{ asset('assets/css/analytics-dashboard/style.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/accounting-dashboard/style.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/modules/modules-widgets.css')}}" rel="stylesheet" type="text/css" />
<style>
    .new-control {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
</style>
@endsection

@section('content')

@include('message')
 

<div class="row">
    <div class="col-xl-6 col-12 layout-spacing">
        <div class="widget-content widget-content-area p-0 br-4">
            <div class="news-feeds">
                <div class="news-feeds-header">
                    <div class="row">
                        <div class="col-md-7 col-sm-7 col-7 mb-4 mb-sm-0">
                            <h6 class="mb-0">@lang('app.notification')</h6>
                        </div>
                        <div class="col-md-5 col-sm-5 col-5 text-right">
                            {{-- <div class="">View all</div> --}}
                        </div>
                    </div>
                </div>

                <div class="news-feeds-body">
                    <div class="table-responsive  mt-3">
                        <table class="table">
                            <tbody>
                                @isset($orders)
                                    @foreach ($orders as $order)
                                        @foreach ($order->alerts as $alert)
                                        <tr>
                                            <td>
                                                <a href="{{ url(route('orders.show' , [$alert->order->id])) }}">
                                                    <div class="n-chk">
                                                        <label class="new-control new-checkbox checkbox-danger mb-0">
                                                        
                                                            <span class="d-flex justify-content-center">
                                                                <span class="news-feeds-item">
                                                                    <span class="media d-sm-flex d-block">
                                                                        <span class="usr-icon mr-4">
                                                                            <i class="bg-light-danger flaticon-bell"></i>
                                                                        </span>
                                                                        <span class="media-body">
                                                                            <span class="news-feeds-text {{ $alert->read == 1 ? 'text-muted' : ''}} "> {{ $alert->message }} </span>
                                                                            <span class="meta-time d-block mb-0">{{ Carbon\Carbon::createFromTimeStamp(strtotime($alert->created_at))->diffForHumans() }}</span>
                                                                        </span>
                                                                    </span>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endforeach
                                @endisset   
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="text-center padding10">
                       {{ $orders->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-xl-6 col-12 layout-spacing">
        <div class="widget-content widget-content-area p-0 br-4">
            <div class="news-feeds">
                <div class="news-feeds-header">
                    <div class="row">
                        <div class="col-md-7 col-sm-7 col-7 mb-4 mb-sm-0">
                            <h6 class="mb-0">@lang('app.orders')</h6>
                        </div>
                        <div class="col-md-5 col-sm-5 col-5 text-right">
                            {{-- <div class="">View all</div> --}}
                        </div>
                    </div>
                </div>

                <div class="news-feeds-body">
                    <div class="table-responsive  mt-3">
                        <table class="table">
                            <tbody> 
                                @isset($orders)
                                   @foreach ($orders as $order)
                                        @foreach ($order->logs as $log)
                                            <tr>
                                                <td>
                                                    <a href="{{ url(route('orders.show' , [$log->order_id]))}}">
                                                        <div class="n-chk">
                                                            <label class="new-control new-checkbox checkbox-danger mb-0">
                                                                <span class="d-flex justify-content-center">
                                                                    <span class="news-feeds-item">
                                                                        <span class="media d-sm-flex d-block">
                                                                            <span class="usr-icon mr-4">
                                                                                <i class="bg-light-success flaticon-like-3"></i>
                                                                            </span>
                                                                            <span class="media-body">
                                                                                <span class="news-feeds-text"><span class="user-name">{{ $log->order->order_id}}</span> {{ LaravelLocalization::getCurrentLocale() == 'ar' ? $log->note_ar : $log->note_en }} @lang('app.by') <span class="action">{{ $log->change_by_user }}</span></span>
                                                                                <span class="meta-time d-block mb-0">{{ Carbon\Carbon::createFromTimeStamp(strtotime($log->created_at))->diffForHumans() }}</span>
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                   @endforeach
                                @endisset

                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="text-center padding10">
                        {{ $orders->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="widget-content widget-content-area p-0 br-4">
    <div class="news-feeds">
        <div class="news-feeds-header">
            <div class="row">
                <div class="col-md-7 col-sm-7 col-7 mb-4 mb-sm-0">
                    <h6 class="mb-0">@lang('app.driver_notification')</h6>
                </div>
                <div class="col-md-5 col-sm-5 col-5 text-right">
                    
                </div>
            </div>
        </div>

        <div class="news-feeds-body">
            <div class="table-responsive  mt-3">
                <table class="table">
                    <tbody> 
                        @isset($drivers)
                            @foreach ($drivers as $driver)

                                @if ($driver->state_expire_date <= \Carbon\Carbon::now()->format('Y.m.d'))
                                <tr>
                                    <td>
                                        <a href="{{ url(route('drivers.show' , [$driver->id])) }}" >
                                            <div class="n-chk">
                                                <label class="new-control new-checkbox checkbox-danger mb-0">
                                                
                                                    <span class="d-flex justify-content-center">
                                                        <span class="news-feeds-item">
                                                            <span class="media d-sm-flex d-block">
                                                                <span class="usr-icon mr-4">
                                                                    <i class="bg-light-success flaticon-like-3"></i>
                                                                </span>
                                                                <span class="media-body">
                                                                    <span class="news-feeds-text"><span class="user-name"> إقامة السائق {{ $driver->fname . ' ' . $driver->lname }} إنتهت بتاريخ  </span> </span>
                                                                    <span class="meta-time d-block mb-0">{{ $driver->license_expire_date }}</span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                @endif

                                @if ($driver->license_expire_date <= \Carbon\Carbon::now()->format('Y.m.d'))
                                <tr>
                                    <td>
                                        <a href="{{ url(route('drivers.show' , [$driver->id])) }}" >
                                            <div class="n-chk">
                                                <label class="new-control new-checkbox checkbox-danger mb-0">
                                                    <span class="d-flex justify-content-center">
                                                        <span class="news-feeds-item">
                                                            <span class="media d-sm-flex d-block">
                                                                <span class="usr-icon mr-4">
                                                                    <i class="bg-light-success flaticon-like-3"></i>
                                                                </span>
                                                                <span class="media-body">
                                                                    <span class="news-feeds-text"><span class="user-name"> رخصة السائق  {{ $driver->fname . ' ' . $driver->lname }}</span> إنتهت بتاريخ</span>
                                                                    <span class="meta-time d-block mb-0">{{ $driver->license_expire_date }}</span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        @endisset

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
