@extends('driver.layouts.app') 

@section('title')
    @isset($order)
        @lang('app.order') #{{$order->order_id}}
    @endisset
@endsection
@section('header')
<link href="{{ asset('assets/css/components/portlets/portlet.css')}}" rel="stylesheet" type="text/css" />
@endsection


@section('content')

<div class="widget portlet-widget">
    <div class="widget-content widget-content-area">
        <div class="portlet portlet-danger">
            <div class="portlet-title portlet-danger  d-flex justify-content-between">
                <div class="caption  align-self-center">
                    <span class="caption-subject text-uppercase white"> @lang('app.orderid') #{{$order->order_id}}</span>
                </div>
                <div class="actions  align-self-center">
                    <div class="btn-group">
                        <a href="{{ $awb_url }}" class="btn btn-rounded btn-primary">@lang('app.awb')</a> 
                    </div>
                </div>
            </div>
            <div class="portlet-body portlet-common-body">
                <div class="row">
                    <div class="col-md-6">
                            <p class="text-uppercase">@lang('app.reference_id')<p>
                            <p class="text-muted">
                                @isset($order)
                                    {{$order->reference_id}}
                                @endisset
                            </p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-uppercase">@lang('app.date')<p>
                        <p class="text-muted">
                            @isset($order)
                                {{ $order->created_at->format('d-m-Y') }}
                            @endisset
                        </p>
                    </div>
                </div>
             
             
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-uppercase">@lang('app.company')<p>
                        <p class="text-muted">
                            @isset($order)
                                {{ $order->company->company_name }}
                            @endisset
                        </p>
                    </div>
                    <div class="col-md-6">
                            <p class="text-uppercase">@lang('app.addedby')<p>
                            <p class="font-red-mint">
                                @isset($order)
                                {{ $order->customer->name }}
                            @endisset
                            </p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <small class="text-muted">@lang('app.pickup_details')</small>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">@lang('app.dropoff_details')</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                            <p class="text-uppercase">@lang('app.pickup_location')<p>
                            <p class="text-muted">
                                @isset($order)
                                    {{$order->company->company_address }}
                                 @endisset
                            </p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-uppercase">@lang('app.dropoff_location')<p>
                        <p class="text-muted">
                            @isset($order)
                            {{ $order->city . ', ' . $order->region }}
                            <br>
                            @if ($order->location($order->id) != NULL)
                                <small>{{ $order->location($order->id)->address }}</small> 
                                <small>@lang('app.deliverytime') : {{ $order->location($order->id)->delivery_date }}</small> 
                            @endif
                            @endisset
                        </p>
                    </div>
                </div>
             
             
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-uppercase">@lang('app.sender_name')<p>
                        <p class="text-muted">
                            @isset($order)
                                {{$order->company->company_name}}
                            @endisset
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-uppercase">@lang('app.recipient_name')<p>
                        <p class="text-muted">
                            @isset($order)
                                {{$order->name }}
                            @endisset
                        </p>
                    </div>
                </div>
             
             
                <div class="row">
                    <div class="col-md-6">
                            <p class="text-uppercase">@lang('app.sender_phone')<p>
                            <p class="text-muted">
                                @isset($order)
                                    {{$order->company->company_phone}}
                                @endisset
                            </p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-uppercase">@lang('app.recipient_phone')<p>
                        <p class="text-muted">
                            @isset($order)
                                    {{$order->phone }}
                            @endisset
                        </p>
                    </div>
                </div>
            
                <hr>
             
                <div class="row">
                    <div class="col-md-6">
                        <h3>@lang('app.box_count') </h3>
                        <h3>{{$order->box_count }} </h3>
                    </div>
                    <div class="col-md-6">
                        <h3>@lang('app.cod_amount') </h3>
                        <h3>{{$order->cod_amount . '.00 '  }} @lang('app.ras') </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection