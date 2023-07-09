@extends('admin.layouts.app')

@section('title')
@lang('app.orders_by_company')
@endsection


@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_html5.css')}}">    
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_miscellaneous.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/ecommerce-dashboard/style.css')}}"/>
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
                        <h4>@lang('app.orders_by_company')</h4>
                    </div>                 
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ url(route('report.orders_by_company.index')) }}" method="GET"> 
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
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>{{ $company->company_name}}</h4>
                    </div>                 
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive">
                    <table class="table table-bordered" id="column-filter">
                        <tr>
                            <th>#</th>
                            <th>@lang('app.address')</th>
                            <th>@lang('app.status')</th>
                            <th>@lang('app.date')</th>
                        </tr>

                        @if ($orders->count() != 0)
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->order_id }}</td>
                                    <td>{{ $order->city->name ?? 'N/A' }} / {{ $order->region ?? 'N/A'}}</td>
                                    <td>

                                        @if ($order->status == 'unassigned')
                                            <span class="badge badge-dark"> {{ trans('app.unassigned')}} </span>
                                        @elseif ($order->status == 'assign_to_driver') 
                                            <span class="badge badge-dark"> {{ trans('app.assign_to_driver')}} </span>
                                        @elseif ($order->status == 'to_be_delivered') 
                                            <span class="badge badge-dark"> {{ trans('app.to_be_delivered')}} </span>
                                        @elseif ($order->status == 'rescheduled') 
                                            <span class="badge badge-dark"> {{ trans('app.rescheduled')}} </span>
                                        @elseif ($order->status == 'car_damage') 
                                            <span class="badge badge-dark"> {{ trans('app.car_damage')}} </span>
                                        @elseif ($order->status == 'delivered') 
                                            <span class="badge badge-dark"> {{ trans('app.delivered')}} </span>
                                        @elseif ($order->status == 'canceled') 
                                            <span class="badge badge-danger"> {{ trans('app.canceled')}}</span>
                                        @endif
                                    </td>
                                    <td>{{ $order->created_at->format('Y/m/d') }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-default">
                                        لا يوجد طلبات لهذه الشركة
                                    </div>
                                </td>
                            </tr>
                        @endif
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
<script src="{{ asset('plugins/table/datatable/datatables.js')}}"></script>
<script src="{{ asset('plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('plugins/table/datatable/button-ext/jszip.min.js')}}"></script>    
<script src="{{ asset('plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
<script src="{{ asset('plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('plugins/select2/custom-select2.js') }}"></script>
<script src="{{ asset('plugins/datepicker/datedropper.min.js') }}"></script>

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