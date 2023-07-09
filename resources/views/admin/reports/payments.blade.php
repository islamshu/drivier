@extends('admin.layouts.app')

@section('title')
@lang('app.paymentsReport')
@endsection


@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_html5.css')}}">    
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_miscellaneous.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/datepicker/datedropper.min.css') }}">
@endsection

@section('content')

@include('message')

<div class="row" id="cancel-row">
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('app.paymentsReport')</h4>
                    </div>                 
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ url(route('report.payments.index')) }}" method="GET"> 
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.company')</label>
                                <select class="placeholder js-states form-control" id="company" name="company_id">
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
                        <br>
                        <button type="submit" class="btn btn-classic btn-primary btn-lg">@lang('app.filter')</button>
                    </div>
                    
                </form>



                @isset($company)
                    <div class="table-responsive mb-4">
                        <form action="{{ url(route('report.makePaid.index'))}}" method="POST">
                            @csrf
                            <table id="column-filter" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="checkbox-column">#</th>
                                        <th>@lang('app.id')</th>
                                        <th>@lang('app.company') </th>
                                        <th>@lang('app.client') </th>
                                        <th>@lang('app.phone') </th>
                                        <th>@lang('app.status')</th>
                                        <th>@lang('app.driverName')</th>
                                        <th>@lang('app.driverPhone')</th>
                                        <th>@lang('app.deliverey_fee')</th>
                                        <th>@lang('app.distance')</th>
                                        <th>@lang('app.time')</th>
                                        <th>@lang('app.price')</th>
                                        <th>@lang('app.created_at')</th>
                                        <th>@lang('app.updated_at')</th>
                                        <th>@lang('app.canceled_at')</th>
                                        <th>@lang('app.canceled_after')</th>
                                        <th>@lang('app.paymentStatus')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($orders)
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>
                                                    <label class="new-control new-checkbox checkbox-primary   m-auto">
                                                    <input type="checkbox"  name="orders[{{ $order->id}}]" class="new-control-input child-chk select-customers-info"  id="customer-all-info{{$order->id}}">
                                                        <span class="new-control-indicator"></span>
                                                        <span style="visibility:hidden">c</span>
                                                    </label>
                                                </td>
                                                <td> <a class="text-primary" target="_blank" href="{{ url(route('orders.show' , [$order->id])) }}"> {{ $order->order_id}} </a> </td>
                                                <td> {{ $order->customer->branch_name }} </td>
                                                <td> {{ $order->name}} </td>
                                                <td>{{ $order->phone}} </td>
                                                <td> 
                                                    @if ($order->status == 'unassigned')
                                                    {{ trans('app.unassigned')}} 
                                                    @elseif ($order->status == 'assign_to_driver') 
                                                    {{ trans('app.assign_to_driver')}} 
                                                    @elseif ($order->status == 'to_be_delivered') 
                                                    {{ trans('app.to_be_delivered')}} 
                                                    @elseif ($order->status == 'rescheduled') 
                                                    {{ trans('app.rescheduled')}} 
                                                    @elseif ($order->status == 'car_damage') 
                                                    {{ trans('app.car_damage')}} 
                                                    @elseif ($order->status == 'delivered') 
                                                    {{ trans('app.delivered')}} 
                                                    @elseif ($order->status == 'canceled') 
                                                    {{ trans('app.canceled')}}
                                                    @endif
                                                </td>
                                                <td> 
                                                    @if ($order->driver)
                                                        {{ $order->driver->fname .' ' . $order->driver->lname}}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td> 
                                                    @if ($order->driver)
                                                        {{ $order->driver->phone}} 
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $order->delivery_fees}} </td>
                                                <td> {{ $order->approx_km . ' '. trans('app.km') ?? 'N/A' }} </td>
                                                <td> {{ $order->approx_time ?? 'N/A' }} </td>
                                                <td> {{ $order->cod_amount ?? 'N/A' }} </td>
                                                <td> {{ $order->created_at ?? 'N/A' }} </td>
                                                <td> {{ $order->updated_at ?? 'N/A' }} </td>
                                                <td> {{ $order->canceled_at ?? 'N/A' }} </td>
                                                <td> {{ $order->canceled_after ?? 'N/A' }} </td>
                                                <td> 
                                                    @if ($order->payment == 0)
                                                        <span class="badge badge-danger">@lang('app.unpaid')</span>
                                                    @else
                                                        <span class="badge badge-success">@lang('app.paid')</span>
                                                    @endif    
                                                </td>
                                            </tr>
                                        @endforeach
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right"> <strong>@lang('app.total')</strong> </td>
                                        <td> <strong>{{ $orders->sum('cod_amount') }} @lang('app.ras')</strong> </td>
                                        <td> <strong class="text-danger"> {{ $orders->sum('delivery_fees') }} @lang('app.ras')</strong> </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                                @endisset
                            </table>

                            <div class="form-group">
                                <button type="submit" class="btn btn-classic btn-success makePayed" style="display:none;">@lang('app.paid')</button>
                            </div>
                        </form>
                    </div>
                @endisset
            </div>
        </div>
    </div>

</div>


  

@endsection


@push('script')
<script src="{{ asset('plugins/table/datatable/datatables.js')}}"></script>
<script src="{{ asset('plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('plugins/table/datatable/button-ext/jszip.min.js')}}"></script>    
<script src="{{ asset('plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
<script src="{{ asset('plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('plugins/select2/custom-select2.js') }}"></script>
<script src="{{ asset('plugins/datepicker/datedropper.min.js') }}"></script>
<script>




$(document).on('click' , 'input[type="checkbox"]' , function() {

    if ($(this).prop("checked") == true) {
         $('.makePayed').show();
    }else if ($(this).prop("checked") == false) {
        $('.makePayed').hide();
    }
});

$('#allOrders').first().click(function(){

    $('tbody tr td .checkbox').each(function(index) {
        $(this).click();                       
    });
});


$(function() {
    $('.datedropper').dateDropper();
});

    var table = $('#column-filter');
    table.DataTable({

        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
                    { data: 'id', name: 'id' },
                    { data: 'order_id', name: 'order_id' },
                    { data: 'status', name: 'status' },
                    { data: 'cod_amount', name: 'cod_amount' },
                    { data: 'deliverey_fee', name: 'deliverey_fee' },
                    { data: 'action', name: 'action' },
                ],
        buttons: {
            buttons: [
                { extend: 'copy', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.copy')"},
                { extend: 'csv', className: 'btn btn-classic btn-success btn-sm mb-4'  , text: "@lang('app.csv')"},
                { extend: 'excel', className: 'btn btn-classic btn-success btn-sm mb-4', text: "@lang('app.excel')"},
                { extend: 'print', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.print')" }
            ]
        },
        
        "language": {
            "paginate": {
              "previous": "<i class='flaticon-arrow-left-1'></i>",
              "next": "<i class='flaticon-arrow-right'></i>"
            },
            "info": "@lang('app.paginate') _PAGE_ @lang('app.of') _PAGES_",
            "search" : "@lang('app.search')",
        }
    });

    // multiCheck(cf);


</script>
@endpush