@extends('admin.layouts.app')

@section('title')
@lang('app.orders_by_driver')
@endsection


@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/custom_dt_html5.css')}}">    
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/custom_dt_miscellaneous.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/ecommerce-dashboard/style.css')}}"/>
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
                        <h4>@lang('app.orders_by_driver')</h4>
                    </div>                 
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ url(route('report.orders_by_driver.index')) }}" method="GET"> 
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.driver')</label>
                                <select class="placeholder js-states form-control" id="driver" name="driver_id">
                                    <option value="0">@lang('app.all')</option>
                                    @isset($drivers)
                                        @foreach($drivers as $d)
                                            <option value="{{ $d->id }}">{{ $d->fname . ' ' . $d->lname }}</option>
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
            </div>
        </div>
    </div>

</div>


@isset($orders)

<div class="row">
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        @isset($driver)
                        <h4>{{ $driver->fname . ' ' . $driver->lname}}</h4>
                        @endisset
                    </div>                 
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive">
                    <table class="table table-bordered" id="column-filter">
                        <thead>
                            <th>#</th>
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
                        </thead>

                        @isset($orders)
                            @if ($orders->count() != 0)
                            @foreach ($orders as $order)
                                <tr>
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
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-default">
                                        لا يوجد طلبات لهذا السائق
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @endisset
                    </table>
                    
                    @isset($orders)
                        {{ $orders->links() }}
                    @endisset
                </div>
            </div>
        </div>
    </div>

</div>
@endisset

@endsection


@push('script')
<script src="{{ asset('public/plugins/table/datatable/datatables.js')}}"></script>
<script src="{{ asset('public/plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('public/plugins/table/datatable/button-ext/jszip.min.js')}}"></script>    
<script src="{{ asset('public/plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
<script src="{{ asset('public/plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
<script src="{{ asset('public/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('public/plugins/select2/custom-select2.js') }}"></script>
<script src="{{ asset('public/plugins/datepicker/datedropper.min.js') }}"></script>

<script>
    $(function() {
        $('.datedropper').dateDropper();
    });

    var table = $('#column-filter');
    table.DataTable({

        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',

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
</script>
@endpush