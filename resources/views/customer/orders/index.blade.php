@extends('customer.layouts.app') 

@section('title')
@lang('app.orders')
@endsection

@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_html5.css')}}">    
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_customer.css')}}"> 
<link href="{{ asset('plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/file-upload/file-upload-with-preview.css') }}" rel="stylesheet" type="text/css" />
<style>
    .modal {
        top: 100px;
    }
    label {
        color: #000;
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
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                        <h4>@lang('app.orders')</h4>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right pt-2">
                        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importOrders">@lang('app.upload_orders')</button> --}}
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive mb-4">
                    <table id="html5-extension" class="table table-striped table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th> @lang('app.id') </th>
                                <th> @lang('app.orderid') </th>
                                <th> @lang('app.client_info') </th>
                                <th> @lang('app.deliverey_fee')</th>
                                <th> @lang('app.cod_amount')</th>
                                <th> @lang('app.status')</th>
                                <th> @lang('app.action') </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>



{{-- <!-- Modal -->
<div class="modal fade" id="importOrders" tabindex="-1" role="dialog" aria-labelledby="importOrdersLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="importOrdersLabel">@lang('app.upload_orders')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ url(route('customer.order.import'))}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>@lang('app.select_orders_excel')</label>
                    <input type="file" name="orders_file" id="" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('app.close')</button>
              <button type="submit" class="btn btn-primary">@lang('app.upload')</button>
            </div>
        </form>
      </div>
    </div>
</div> --}}

@endsection


@push('script')
<script src="{{ asset('plugins/table/datatable/datatables.js')}}"></script>
<script src="{{ asset('plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('plugins/table/datatable/button-ext/jszip.min.js')}}"></script>    
<script src="{{ asset('plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
<script src="{{ asset('plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
<script>


    var url = "{{ url(route('order.index')) }}";

    $('#html5-extension').DataTable( {
        ajax: url,
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        "order": [[ 0 , "desc" ]],
        columns: [
                    { data: 'id', name: 'id' },
                    { data: 'order_id', name: 'order_id' },
                    { data: 'name', name: 'name' },
                    { data: 'deliverey_fee', name: 'deliverey_fee' },
                    { data: 'amount', name: 'amount' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action' },
                ],
        buttons: {
            buttons: [
                { extend: 'copy', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.copy')" },
                { extend: 'csv', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.csv')"},
                { extend: 'excel', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.excel')"},
                { extend: 'print', className: 'btn btn-classic btn-success btn-sm mb-4', text: "@lang('app.print')" }
            ]
        },
        "language": {
            "paginate": {
              "previous": "<i class='flaticon-arrow-left-1'></i>",
              "next": "<i class='flaticon-arrow-right'></i>"
            },
            "info": "@lang('app.paginate') _PAGE_ @lang('app.of') _PAGES_",
            "search" : "@lang('app.search')"
        }
    } );
</script>
@endpush