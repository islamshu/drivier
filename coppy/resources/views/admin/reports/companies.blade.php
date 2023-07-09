@extends('admin.layouts.app')

@section('title')
@lang('app.companies')
@endsection


@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/custom_dt_html5.css')}}">    
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/custom_dt_miscellaneous.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/select2/select2.min.css') }}">
<link href="{{ asset('public/assets/css/ecommerce-dashboard/style.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/datepicker/datedropper.min.css') }}">
@endsection

@section('content')

@include('message')

<div class="row" id="cancel-row">
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('app.companies')</h4>
                    </div>                 
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ url(route('report.companies.index')) }}" method="GET"> 
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.company')</label>
                                <select class="placeholder js-states form-control" id="company" name="company_id">
                                    <option value="0">@lang('app.select')</option>
                                    @isset($companies)
                                        @foreach($companies as $comp)
                                            <option value="{{ $comp->id }}">{{ $comp->branch_name }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.from_date')</label>
                                <input type="text" class="form-control datedropper"  name="from_date"  data-format="Y-m-d" data-lang="{{ LaravelLocalization::getCurrentLocale() }}" data-modal="false" data-large-default="true" data-large-mode="true">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.to_date')</label>
                                <input type="text" class="form-control datedropper"  name="to_date"  data-format="Y-m-d" data-lang="{{ LaravelLocalization::getCurrentLocale() }}" data-modal="false" data-large-default="true" data-large-mode="true">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-classic btn-primary btn-lg">@lang('app.filter')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


@isset($company)

<div class="row">

    <div class="col-xl-4 col-lg-12 col-md-6 col-sm-12 layout-spacing">
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

    <div class="col-xl-4 col-lg-12 col-md-6 col-sm-12 layout-spacing">
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

    <div class="col-xl-4 col-lg-12 col-md-6 col-sm-12 layout-spacing">
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


<div class="row">

    <div class="col-xl-4 col-lg-12 col-md-6 col-sm-12 layout-spacing">
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

    <div class="col-xl-4 col-lg-12 col-md-6 col-sm-12 layout-spacing">
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

    <div class="col-xl-4 col-lg-12 col-md-6 col-sm-12 layout-spacing">
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

@endisset

@endsection


@push('script')
<script src="{{ asset('public/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('public/plugins/select2/custom-select2.js') }}"></script>
<script src="{{ asset('public/plugins/datepicker/datedropper.min.js') }}"></script>

<script>
    $(function() {
        $('.datedropper').dateDropper();
    });
</script>

@endpush