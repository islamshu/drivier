@extends('admin.layouts.app')

@section('title')
    @lang('app.view')
@endsection


@section('header')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/custom_dt_html5.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/custom_dt_customer.css')}}">
    <link href="{{ asset('public/assets/css/ui-kit/tabs-accordian/custom-accordions.css')}}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/select2/select2.min.css') }}">

@endsection

@section('content')


    <div class="row" id="cancel-row">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <div class="tab-content" id="justify-pills-tabContent">
                        <div class="tab-pane fade show active" id="justify-pills-home" role="tabpanel"
                             aria-labelledby="justify-pills-home-tab">

                            <div class="table-responsive mb-4">
                                <table id="html5-extension" class="table table-striped table-bordered table-hover"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th> @lang('app.amount_id') </th>
                                        <th> @lang('app.payment_date') </th>
                                        <th> @lang('app.paymentType') </th>
                                        <th> @lang('app.paymentBrand') </th>
                                        <th> @lang('app.amount') </th>
                                        <th> @lang('app.currency') </th>
                                        <th> @lang('app.bin')</th>
                                        <th> @lang('app.expiration')</th>
                                        <th> @lang('app.ip') </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($payment  as $item)
                                        <tr>
                                            <th> {{$item->amount_id}} </th>
                                            <th> {{$item->created_at}} </th>
                                            <th> {{$item->paymentType}} </th>
                                            <th> {{$item->paymentBrand}} </th>
                                            <th> {{$item->amount}} </th>
                                            <th> {{$item->currency}} </th>
                                            <th> {{$item->bin}} </th>
                                            <th> {{$item->expiryMonth}}/{{$item->expiryYear}} </th>
                                            <th> {{$item->ip}}:{{$item->ipCountry}} </th>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection


@push('script')

@endpush