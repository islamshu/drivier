@extends('admin.layouts.app')

@section('title')
@lang('app.dashboard')
@endsection

@section('header')
<link href="{{ asset('public/assets/css/analytics-dashboard/style.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/assets/css/accounting-dashboard/style.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/assets/css/modules/modules-widgets.css')}}" rel="stylesheet" type="text/css" />
<style>
    .new-control {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
</style>
@endsection

@section('content')

@include('message')
 

<div class="row layout-spacing">

    <div class="col-md-6 col-12">
        <div class="widget-content-area br-4 mb-4">
            <div class="d-flex justify-content-between t-likes">                                
                <div class="">
                    <p class="mb-0">@lang('app.total_orders')</p>
                    <h5 class="mb-0">{{ isset($orders) ? $orders : 0}}</h5>
                </div>
                <div class="">
                    <i class="flaticon-square-tick"></i>
                </div>
            </div>
        </div>

        <div class="widget-content-area br-4 mb-4">
            <div class="d-flex justify-content-between t-comments">                                
                <div class="">
                    <p class="mb-0">@lang('app.delivered_orders')</p>
                    <h5 class="mb-0">{{ isset($deliverdOrders) ? $deliverdOrders : 0}}</h5>
                </div>
                <div class="">
                    <i class="flaticon-like-3"></i>
                </div>
            </div>
        </div>

        <div class="widget-content-area br-4 mb-4">
            <div class="d-flex justify-content-between t-shares">                                
                <div class="">
                    <p class="mb-0">@lang('app.returned_orders')</p>
                    <h5 class="mb-0">{{ isset($returnedOrders) ? $returnedOrders : 0}}</h5>
                </div>
                <div class="">
                    <i class="flaticon-back-arrow-1"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-12">
        <div class="widget-content widget-content-area p-0 br-4 mb-5">
            <div class="news-feeds">
                <div class="news-feeds-header">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <h6 class="mb-0">@lang('app.orders')</h6>
                        </div>
                    </div>
                </div>

                <div class="news-feeds-body">
                    <div class="table-responsive ">
                        <table class="table">
                            <tbody>
                                @isset($logs)
                                    @foreach ($logs as $order)
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
                                                                                <i class="bg-light-warning flaticon-like-3"></i>
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
                        <a href="{{ url(route('admin.notifications'))}}" class="btn btn-primary"> @lang('app.showall') </a>
                    </div>
                </div>

            </div>
        </div>

        <div class="widget-content widget-content-area h-100 br-4 p-0">
                            
            <div class="usr-list">

                <div class="usr-list-title">
                    <h6 class="mb-0">@lang('app.companies')</h6>
                </div>

                <div class="usr-list-body">
                    <div class="table-responsive mt-4">
                        <table class="table">
                            <tbody>

                                @isset($companies)
                                    @foreach ($companies as $company)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="f-header">
                                                        <img src="{{ asset('public/assets/img/90x90.jpg')}}" class="rounded-circle mr-3" alt="admin-profile">
                                                    </div>
                                                    <div class="f-body  align-self-center">
                                                        <h6>{{ $company->company_name }}</h6>
                                                        <p> @lang('app.companyEmployee') : {{ $company->users->count() }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{ Carbon\Carbon::createFromTimeStamp(strtotime($company->created_at))->diffForHumans() }}
                                            </td>
                                            <td class="action text-right">
                                                <a href="{{ url(route('companies.show' , [$company->id])) }}" ><i class="flaticon-view-3 mb-2 mr-2 bs-tooltip" data-placement="top" title="" data-original-title="View"></i></a>
                                                <a href="{{ url(route('companies.edit' , [$company->id])) }}" ><i class="flaticon-edit-1 mb-2 mr-1 bs-tooltip" data-placement="top" title="" data-original-title="Edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                    <div class="u-l-add-new text-center">
                        <a href="{{ url(route('companies.index'))}}" class="btn btn-primary">@lang('app.showall')</a>
                    </div>
                </div>
                
            </div>

        </div>
        
    </div>
</div>

@endsection
