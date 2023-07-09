@extends('customer.layouts.app')

@section('title')
@lang('app.paymentsReport')
@endsection


@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_html5.css')}}">    
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_miscellaneous.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
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
                <form action="{{ url(route('customer.report.payments'))}}" method="GET">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="status" class="form-control">
                                    <option value="delivered">@lang('app.delivered')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-classic btn-success">@lang('app.filter')</button>
                            </div>
                        </div>
                    </div>
                </form>
                <br>
                <hr>
                <br>
                <div class="table-responsive mb-4">
                    <table id="column-filter" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th >#</th>
                                <th>@lang('app.id')</th>
                                <th>@lang('app.status')</th>
                                <th>@lang('app.cod_amount')</th>
                                <th>@lang('app.deliverey_fee') <br>/ @lang('app.return_fee')</th>
                                <th>@lang('app.net_amount')</th>
                                <th>@lang('app.paymentStatus')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($orders)
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration  }}</td>
                                        <td> {{ $order->order_id }} </td>
                                        <td> 
                                            @if ($order->status == 'delivered')
                                                <span class="badge badge-success">@lang('app.delivered')</span>
                                            @else
                                                <span class="badge badge-danger">@lang('app.returned')</span>
                                            @endif
                                        </td>
                                        <td> {{ $order->cod_amount }} @lang('app.ras')</td>
                                        <td> {{ $order->status == 'delivered' ? $company->delivery_fee : $company->return_fee }} @lang('app.ras') </td>
                                        <td> {{ $order->net_amount }} </td>
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
                                <td></td>
                                <td> <strong class="text-danger"> {{ $orders->sum('net_amount') }} @lang('app.ras')</strong> </td>
                                <td></td>
                            </tr>
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

// function multiCheck(tb_var) {
//     tb_var.on("change", ".chk-parent", function() {
//         var e=$(this).closest("table").find("td:first-child .child-chk"), a=$(this).is(":checked");
//         $(e).each(function() {
//             a?($(this).prop("checked", !0), $(this).closest("tr").addClass("active")): ($(this).prop("checked", !1), $(this).closest("tr").removeClass("active"))
//         })
//     }),
//     tb_var.on("change", "tbody tr .new-control", function() {
//         $(this).parents("tr").toggleClass("active")
//     })
// }

// function checkall(clickchk, relChkbox) {

//     var checker = $('#' + clickchk);
//     var multichk = $('.' + relChkbox);


//     checker.click(function () {
//         multichk.prop('checked', $(this).prop('checked'));
//     });    
// }

    var table = $('#column-filter');
    table.DataTable({
        // headerCallback:function(e, a, t, n, s) {
        //     e.getElementsByTagName("th")[0].innerHTML='<label class="new-control new-checkbox checkbox-primary m-auto">\n<input type="checkbox" id="allOrders" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
        // },
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
                    { data: 'id', name: 'id' },
                    { data: 'order_id', name: 'order_id' },
                    { data: 'status', name: 'status' },
                    { data: 'cod_amount', name: 'cod_amount' },
                    { data: 'deliverey_fee', name: 'deliverey_fee' },
                    { data: 'amount', name: 'amount' },
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
        // columnDefs:[ {
        //     targets:0, width:"30px", className:"", orderable:!1, render:function(e, a, t, n) {
        //         return'<label class="new-control new-checkbox checkbox-primary  m-auto">\n<input type="checkbox" class="new-control-input child-chk select-customers-info"  id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
        //     }
        // }],
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

    
    // $(function() {
    //     $('.datedropper').dateDropper();
    // });
</script>
@endpush