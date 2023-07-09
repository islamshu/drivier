@extends('customer.layouts.app') 

@section('title')
{{ trans('app.createorder')}}
@endsection

@section('header')
<link href="{{ asset('plugins/loaders/csspin.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/loaders/custom-loader.css')}}" rel="stylesheet" type="text/css" />
<style>
    .createorder {
        height: 300px;
    }
</style>    
@endsection

@section('content')

@include('message')

<div class="row">
    <div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>{{ trans('app.createorder')}}</h4>
                    </div>                                                                        
                </div>
            </div>
            <div class="widget-content widget-content-area createorder text-center">

                <div class="cp-spinner cp-bubble"></div>
                <div class="cp-spinner cp-round" style="display: none"></div>

                <h6 id="loadText"></h6>
                @isset($driver)
                    <h6 id="driverSelected" style="display: none">تم إسناد الطلب للسائق : {{ $driver->fname .' ' . $driver->lname }} </h6>
                @endisset

                @isset($no_driver)
                    <h6 id="driverSelected" style="display: none"> {{ $no_driver }} </h6>
                @endisset
            </div>
        </div>
    </div>
</div>
        
@endsection

@push('script')
<script>

$(function(){

    setTimeout(() => {
        
        $('#loadText').text('يتم إختيار أقرب سائق لك');
        setTimeout( () => {
            $('.cp-round').show();

            $('#loadText').hide();
            $('.cp-bubble').hide();
            $('#driverSelected').show();

            setTimeout( () => {
                window.location.href = "{{ route('order.index')}}";
            },1000);
        },3000);

    }, 3000);

});
</script>


@endpush
