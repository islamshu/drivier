@extends('driver.layouts.app')

@section('title')
@lang('app.orders')
@endsection


@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_html5.css')}}">    
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_customer.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/datepicker/datedropper.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/timedropper/timedropper.min.css') }}">

@endsection

@section('content')

@include('message')

<div class="row" id="cancel-row">
                
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('app.orders')</h4>
                    </div>                 
                    
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive mb-4">
                    <table id="html5-extension" class="table table-striped table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th> @lang('app.id') </th>
                                <th> @lang('app.name') </th>
                                <th> @lang('app.company') </th>
                                <th> @lang('app.cod_amount')</th>
                                {{-- <th> @lang('app.deliverey_fee') / @lang('app.return_fee')</th> --}}
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

<!-- Change order status -->
<div class="modal fade" id="changeOrderStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title"> @lang('app.status')</h5>
          </div>
        <form  action="{{ url(route('myorders.order.changeStatus'))}}" method="POST">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="order_id" id="order_id">

                <div class="form-group">
                    <input type="text" disabled="disabled" class="form-control" name="order_long_id" id="order_long_id">
                </div>
                <div class="form-group">
                    <select name="status" id="status" class="form-control">
                        <option value="to_be_delivered">@lang('app.to_be_delivered')</option>
                        <option value="rescheduled">@lang('app.rescheduled')</option>
                        <option value="delivered">@lang('app.delivered')</option>
                        <option value="to_be_returned">@lang('app.returned')</option>
                    </select>
                </div>

                <div class="form-row" id="clientInfo" style="display:none;">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>@lang('app.client_age')</label>
                            <input type="text" class="form-control" name="client_age" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>@lang('app.client_nationality')</label>
                            <input type="text" class="form-control" name="client_nationality" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>@lang('app.client_gender')</label>
                            <select name="client_gender" class="form-control">
                                <option value="male">@lang('app.male')</option>
                                <option value="female">@lang('app.female')</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row" id="another_time" style="display:none;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('app.date')</label>
                            <input type="text" class="form-control datedropper"  name="another_date" id="another_date"  data-format="Y-m-d" data-lang="en" data-modal="false" data-large-default="false" data-large-mode="false">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('app.time')</label>
                            <input type="text" class="form-control"  name="timedropper" id="timedropper"  >
                        </div>
                    </div>
                </div>

                <div id="to_be_returned" style="display:none;">
                    <div class="form-group">
                        <label>@lang('app.notes')</label>
                        <textarea name="note" class="form-control" style="border-radius:0;" rows="5"></textarea>
                    </div>
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
<script src="{{ asset('plugins/timedropper/timedropper.min.js') }}"></script>
<script>


    $('#html5-extension').DataTable( {
        ajax: "{{ url(route('myorders.index')) }}",
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'company', name: 'company' },
                    { data: 'amount', name: 'amount' },
                    // { data: 'fees', name: 'fees' },
                    { data: 'status', name: 'status' },
                    { data: 'date', name: 'date' },
                    { data: 'action', name: 'action' },
                ],
        buttons: {
            buttons: [
                { extend: 'copy', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.copy')" },
                { extend: 'csv', className: 'btn btn-classic btn-success btn-sm mb-4'  , text: "@lang('app.csv')"},
                { extend: 'excel', className: 'btn btn-classic btn-success btn-sm mb-4' ,text: "@lang('app.excel')" },
                { extend: 'print', className: 'btn btn-classic btn-success btn-sm mb-4', text: "@lang('app.print')" }
            ]
        },
        "order": [[ 0, "desc" ]],
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
            $('#clientInfo').hide();
            $('#another_time').hide();
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