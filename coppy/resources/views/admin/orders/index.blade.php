@extends('admin.layouts.app')

@section('title')
@lang('app.orders')
@endsection


@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/custom_dt_html5.css')}}">    
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/custom_dt_customer.css')}}">
<link href="{{ asset('public/assets/css/ui-kit/tabs-accordian/custom-accordions.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/select2/select2.min.css') }}">
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
<style>
    .modal {
        top: 50px;
    }
    .modal-body {
        height: 330px;
        overflow-y: auto;
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
                        {{-- <h4>@lang('app.orders')</h4> --}}

                        <ul class="nav nav-pills mb-3 mt-3 nav-fill" id="justify-pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="justify-pills-home-tab" data-toggle="pill" href="#justify-pills-home" role="tab" aria-controls="justify-pills-home" aria-selected="true">@lang('app.orders')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="justify-pills-profile-tab" data-toggle="pill" href="#justify-pills-profile" role="tab" aria-controls="justify-pills-profile" aria-selected="false">@lang('app.fast_deliverey')</a>
                            </li>
                        </ul>
                        
                    </div>                 
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right padding-top-5px">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importOrders">@lang('app.upload_orders')</button>
                    </div> 
                </div>
            </div>
            
            <div class="widget-content widget-content-area">


                <div class="tab-content" id="justify-pills-tabContent">
                    <div class="tab-pane fade show active" id="justify-pills-home" role="tabpanel" aria-labelledby="justify-pills-home-tab">
                        {{-- Orders --}}
                        <div class="table-responsive mb-4">
                            <table id="html5-extension" class="table table-striped table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> @lang('app.id') </th>
                                        <th> @lang('app.name') </th>
                                        <th> @lang('app.phone') </th>
                                        <th> @lang('app.address') </th>
                                        <th> @lang('app.company') </th>
                                        <th> @lang('app.branch') </th>
                                        <th> @lang('app.price')</th>
                                        <th> @lang('app.distance')</th>
                                        <th> @lang('app.notes')</th>
                                        <th> @lang('app.status') </th>
                                        <th> @lang('app.date') </th>
                                        <th> @lang('app.action') </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="justify-pills-profile" role="tabpanel" aria-labelledby="justify-pills-profile-tab">
                        {{-- Fast --}}
                        <div class="table-responsive mb-4">
                            <table id="fast_deliverey" class="table table-striped table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> @lang('app.id') </th>
                                        <th> @lang('app.name') </th>
                                        <th> @lang('app.company') </th>
                                        <th> @lang('app.deliverey_fee')</th>
                                        <th> @lang('app.status') </th>
                                        <th> @lang('app.date') </th>
                                        <th> @lang('app.action') </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<!-- Change order status -->
<div class="modal fade" id="changeOrderStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title"> @lang('app.status')</h5>
          </div>
        <form  action="{{ url(route('admin.order.changeStatus'))}}" method="POST">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="order_id" id="order_id">
                <div class="form-group">
                    <input type="text" disabled="disabled" class="form-control" name="order_long_id" id="order_long_id">
                </div>
                <div class="form-group">
                    <select name="status" id="status" class="form-control">
                        <option value="0">@lang('app.select')</option>
                        <option value="assign_to_driver">@lang('app.assign_to_driver')</option>
                    </select>
                </div>

                <div class="form-group" id="driverInfo" style="display:none;">
                    <label>@lang('app.driver')</label>
                    <select class="placeholder js-states form-control" id="driver" name="driver_id">
                        @isset($drivers)
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->fname  . ' ' .  $driver->lname }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('app.close')</button>
              <button type="submit" class="btn btn-primary">@lang('app.save')</button>
            </div>
        </form>
      </div>
    </div>
  </div>


  
<!-- change_driver -->
<div class="modal fade" id="change_driver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title"> @lang('app.status')</h5>
          </div>
        <form  action="{{ url(route('admin.order.changeStatus'))}}" method="POST">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="order_id" id="order_id">
                <div class="form-group">
                    <input type="text" disabled="disabled" class="form-control" name="order_long_id" id="order_long_id">
                </div>
                <div class="form-group">
                    <select name="status" id="changeDriver" class="form-control">
                        <option value="0">@lang('app.select')</option>
                        <option value="change_driver">@lang('app.change_driver')</option>
                    </select>
                </div>

                <div class="form-group" id="changeDriverdriverInfo" style="display:none;">
                    <label>@lang('app.driver')</label>
                    <select class="placeholder js-states form-control" id="driver" name="driver_id">
                        @isset($drivers)
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->fname  . ' ' .  $driver->lname }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('app.close')</button>
              <button type="submit" class="btn btn-primary">@lang('app.save')</button>
            </div>
        </form>
      </div>
    </div>
  </div>



  <!-- Import Orders -->
<div class="modal fade" id="importOrders" tabindex="-1" role="dialog" aria-labelledby="importOrdersLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="importOrdersLabel">@lang('app.upload_orders')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ url(route('admin.orders.import'))}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>@lang('app.company')</label>
                    <select name="customer_id" class="custom-select" id="">
                        @isset($customers)
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->branch_name }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
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
</div>

@endsection


@push('script')
<script src="{{ asset('public/plugins/table/datatable/datatables.js')}}"></script>
<script src="{{ asset('public/plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('public/plugins/table/datatable/button-ext/jszip.min.js')}}"></script>    
<script src="{{ asset('public/plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
<script src="{{ asset('public/plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
<script src="{{ asset('public/assets/js/ui-kit/ui-accordions.js')}}"></script>
<script src="{{ asset('public/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('public/plugins/select2/custom-select2.js') }}"></script>
<script>


    $('#html5-extension').DataTable( {
        ajax: "{{ url(route('orders.index')) }}",
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        "order": [[ 0 , "desc" ]],
        columns: [
                    { data: 'loop', name: 'loop' },
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'phone', name: 'phone' },
                    { data: 'region', name: 'address' },
                    { data: 'company', name: 'company' },
                    { data: 'customer', name: 'customer' },
                    { data: 'delivery_fees', name: 'delivery_fees' },
                    { data: 'approx_km', name: 'approx_km' },
                    { data: 'goods_type', name: 'goods_type' },
                    { data: 'status', name: 'status' },
                    { data: 'date', name: 'date' },
                    { data: 'action', name: 'action' },
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

    
    $('#fast_deliverey').DataTable( {
        ajax: "{{ url(route('orders.fast_deliverey')) }}",
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        "order": [[ 0 , "desc" ]],
        columns: [
                    { data: 'loop', name: 'loop' },
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'company', name: 'company' },
                    { data: 'amount', name: 'amount' },
                    { data: 'status', name: 'status' },
                    { data: 'date', name: 'date' },
                    { data: 'action', name: 'action' },
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

        if (status === 'assign_to_driver') {
            $('#driverInfo').fadeToggle();
        }else {
            $('#driverInfo').hide();
        }
    });

    $('#change_driver').on('show.bs.modal' , function(event){
        var target = $(event.relatedTarget);
        var order_id = target.data('orderid');
        var order_long_id = target.data('orderlongid');

        var modal = $(this);
        modal.find('.modal-body #order_long_id').val(order_long_id);
        modal.find('.modal-body #order_id').val(order_id);

    });

    $(document).on('change' , '#changeDriver' , function() {
        var status = this.value;

        if (status === 'change_driver') {
            $('#changeDriverdriverInfo').fadeToggle();
        }else {
            $('#changeDriverdriverInfo').hide();
        }
    });
</script>
@endpush