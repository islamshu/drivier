@extends('customer.layouts.app') 

@section('title')
@lang('app.paymentPage')
@endsection

@section('header')

<link href="{{ asset('assets/css/ecommerce/ecommerce-wizards.css')}}" rel="stylesheet" type="text/css">
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
                
                <form action="{{ $redirectUrl }}" id="paymentForm" class="paymentWidgets">
                    @csrf
                    @foreach ($parameters as $key => $param )
                    <input type="text" name="{{ $param['name'] }}" value="{{ $param['value'] }}">
                    @endforeach
                </form>
                
            </div>
        </div>
    </div>
</div>
        
@endsection


@push('script')
<script>
    document.getElementById("paymentForm").submit();
</script>
@endpush