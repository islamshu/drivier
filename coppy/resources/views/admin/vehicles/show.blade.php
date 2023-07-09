@extends('admin.layouts.app')

@section('title')
@lang('app.view')
@endsection


@section('header')
<link href="{{ asset('public/assets/css/ui-kit/tabs-accordian/custom-accordions.css')}}" rel="stylesheet" type="text/css" />
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
    .card-body h4.mt-4 {
        color: #6156ce;
        font-size: 18px;
    }
</style>

@endsection

@section('content')

@include('message')

<div class="row" id="cancel-row">
                
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('app.view')</h4>
                    </div>          
                </div>
            </div>
            <div class="widget-content widget-content-area">
                @isset($driver)

                    <address class="mb-5">
                        <strong class="text-primary"> {{ $driver->name }}</strong><br>
                        {{ $driver->email }}<br>
                        <abbr title="Phone">@lang('app.phone'):</abbr> {{ $driver->phone }}
                    </address>
                    <address>
                        <strong class="text-primary">@lang('app.company_info')</strong><br>
                        <strong>@lang('app.id_num'): {{ $driver->id_num  }}</strong><br>
                        <strong>@lang('app.salary'): {{ $driver->salary  }} @lang('app.ras')</strong><br>
                        <strong>@lang('app.city'): {{ $driver->city->name   }}</strong><br>
                    </address>
                @endisset

                <hr>
                

                @isset($orders)
                <strong  class="text-primary">@lang('app.ratings')</strong>
                <br>
                <br>
                <div id="accordion">
                    @foreach ($orders as $order)

                    <div class="card mb-1">
                        <div class="card-header" id="headingOne{{ $order->id}}">
                            <h5 class="mb-0 mt-0">
                            <span class="" data-toggle="collapse" data-target="#collapse{{ $order->order_id}}" aria-expanded="true" aria-controls="collapseOne" role="menu">
                                # {{ $order->order_id}}
                            </span>
                            </h5>
                        </div>

                        <div id="collapse{{ $order->order_id}}" class="collapse" aria-labelledby="headingOne{{ $order->id}}" data-parent="#accordion">
                            <div class="card-body">
                                
                                @isset($order->ratings)
                                    
                                    <br>
                                    @foreach ($order->ratings as $item)
                                        
                                        <h4 class="mt-4">{{ $item->question->question_ar }}</h4>

                                        @if ($item->rating == 1)
                                            <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                            <span class="flaticon-star-full" style="font-size:20px"></span>
                                            <span class="flaticon-star-full" style="font-size:20px"></span>
                                            <span class="flaticon-star-full" style="font-size:20px"></span>
                                            <span class="flaticon-star-full" style="font-size:20px"></span>
                                        @elseif($item->rating == 2)
                                            <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                            <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                            <span class="flaticon-star-full" style="font-size:20px"></span>
                                            <span class="flaticon-star-full" style="font-size:20px"></span>
                                            <span class="flaticon-star-full" style="font-size:20px"></span>
                                        @elseif($item->rating == 3)
                                            <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                            <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                            <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                            <span class="flaticon-star-full" style="font-size:20px"></span>
                                            <span class="flaticon-star-full" style="font-size:20px"></span>
                                        @elseif($item->rating == 4)
                                            <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                            <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                            <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                            <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                            <span class="flaticon-star-full" style="font-size:20px"></span>
                                        @elseif($item->rating == 5)
                                            <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                            <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                            <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                            <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                            <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                        @endif
                                        <br>
                                    @endforeach
                                @endisset 
                            </div>
                        </div>
                    </div>

                        
                    @endforeach
                </div>
                @endisset
            </div>
        </div>
    </div>

</div>


  

@endsection

@push('script')
<script src="{{ asset('public/assets/js/ui-kit/ui-accordions.js')}}"></script>
@endpush