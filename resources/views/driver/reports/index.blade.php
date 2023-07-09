@extends('driver.layouts.app')

@section('title')
@lang('app.payments')
@endsection

@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_html5.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/ecommerce/view_payments.css') }}">

@endsection

@section('content')
<div class="row" id="cancel-row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing text-center">
        <div class="payment-top-section">
            <h4 class="mb-5 card-title">@lang('app.payments')</h4>
            <div class="card-section mx-md-auto">
                <div class="row mt-5">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-5">
                        <div class="p-cards">
                            <i class="ico-cash flaticon-dollar-coin mb-4"></i>
                            <h5> {{ $orders ? $orders->where('status' , 'delivered')->sum('cod_amount') : 0}}  @lang('app.ras')</h5>
                            <h5 class="txt-cash">@lang('app.total')</h5>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-5">
                        <div class="p-cards">
                            <i class="ico-net-bnk flaticon-computer-2 mb-4"></i>
                            <h5>{{ isset($totalOrders) ? $totalOrders : 0}}</h5>
                            <h5 class="txt-net-bnk">@lang('app.total_orders')</h5>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-5">
                        <div class="p-cards">
                            <i class="ico-c-d-card flaticon-square-menu mb-4"></i>
                            <h5>{{ isset($totalDeliveredOrders) ? $totalDeliveredOrders : 0}}</h5>
                            <h5 class="txt-c-d-card">@lang('app.delivered_orders')</h5>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-5">
                        <div class="p-cards">
                            <i class="ico-paypal flaticon-square-cross mb-4"></i>
                            <h5>{{ isset($totalReturnedOrders) ? $totalReturnedOrders : 0}}</h5>
                            <h5 class="txt-paypal">@lang('app.returned_orders')</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('app.payments')</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive mb-4">
                    <table id="ecommerce-product-view" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th> @lang('app.id') </th>
                                <th> @lang('app.cod_amount')</th>
                                <th> @lang('app.status') </th>
                                <th> @lang('app.date') </th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($orders)
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->order_id}}</td>
                                        <td>
                                            @if ($order->status == 'delivered')
                                               {{$order->cod_amount }} @lang('app.ras')
                                            @else
                                                0 
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order->status == 'delivered')
                                                <span class="badge badge-success">@lang('app.delivered')</span>
                                            @else
                                                <span class="badge badge-danger">@lang('app.returned')</span>
                                            @endif
                                        </td>
                                        <td>{{ date('Y-m-d' , strtotime($order->created_at))}}</td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                        @isset($orders)
                            <tfoot>
                                <td colspan="1">
                                   <strong class="text-left">@lang('app.total')</strong> 
                                </td>
                                <td>{{ $orders->where('status' , 'delivered')->sum('cod_amount')}} @lang('app.ras')</td>
                                <td></td>
                                <td></td>
                            </tfoot>
                        @endisset
                    </table>
                </div>
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
<script>


    $('#ecommerce-product-view').DataTable( {
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
                { data: 'id', name: 'id' },
                { data: 'company', name: 'company' },
                { data: 'amount', name: 'amount' },
                { data: 'status', name: 'status' },
                { data: 'date', name: 'date' },
            ],
        buttons: {
            buttons: [
                { extend: 'copy', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.copy')" },
                { extend: 'csv', className: 'btn btn-classic btn-success btn-sm mb-4', text: "@lang('app.csv')" },
                { extend: 'excel', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.excel')" },
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
    } );



    $('#changeOrderStatus').on('show.bs.modal' , function(event){
        var target = $(event.relatedTarget);
        var order_id = target.data('orderid');
        var order_long_id = target.data('orderlongid');

        var modal = $(this);
        modal.find('.modal-body #order_long_id').val(order_long_id);
        modal.find('.modal-body #order_id').val(order_id);
    });


    $(document).on('change' , '#status' , function() {
        var status = this.value;

        if (status.valueOf() === 'delivered') {
            $('#clientInfo').fadeToggle();
            $('#another_time').hide();
            $('#to_be_returned').hide();
        }else if (status.valueOf() === 'rescheduled') {
            $('#another_time').fadeToggle();
            $('#clientInfo').hide();
            $('#to_be_returned').hide();
        }else if (status.valueOf() === 'to_be_returned') {
            $('#to_be_returned').fadeToggle();
        }else {
            $('#clientInfo').hide();
            $('#another_time').hide();
            $('#to_be_returned').hide();
        }
    });

    $('#another_date').dateDropper();
    $('#timedropper').timeDropper();
</script>
@endpush