@extends('admin.layouts.app') 

@section('title')
@lang('app.companies')
@endsection

@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/custom_dt_html5.css')}}">    
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/custom_dt_customer.css')}}">    
<style>
  .table > thead > tr > th {
    color: #000 !important;
  }
</style>

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
@endsection
@section('content')

@include('message')

<div class="row" id="cancel-row">
                
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                        <h4>@lang('app.companies')</h4>
                    </div>    
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right padding-top-5px">
                        <a  href="{{ url(route('companies.create'))}}" class="btn btn-classic btn-primary">
                            {{-- <i class="flaticon-square-plus"></i> --}}
                            @lang('app.add') @lang('app.company')
                        </a>
                    </div>              
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive mb-4">
                    <table id="html5-extension" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                              <th> # </th>
                              <th> @lang('app.name') </th>
                              <th> @lang('app.phone') </th>
                              <th> @lang('app.company_type') </th>
                              <th> @lang('app.address') </th>
                              <th> @lang('app.date')</th>
                              <th> @lang('app.action')</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
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
<script>
    $('#html5-extension').DataTable( {
        ajax: "{{ url(route('companies.index')) }}",
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
                  { data: 'id', name: 'id'  },
                  { data: 'name', name: 'name' },
                  { data: 'phone', name: 'phone' },
                  { data: 'type', name: 'type' },
                  { data: 'address', name: 'address' },
                  { data: 'date', name: 'date' },
                  { data: 'action', name: 'action' },
                   
                ],

        "order": [[ 4, "desc" ]],
        buttons: {
            buttons: [
                { extend: 'copy', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.copy')" },
                { extend: 'csv', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.csv')"},
                { extend: 'excel', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.excel')"},
                { extend: 'print', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.print')"}
            ]
        },
        "language": {
            "paginate": {
              "previous": "<i class='flaticon-arrow-left-1'></i>",
              "next": "<i class='flaticon-arrow-right'></i>"
            },
            "info": "@lang('app.paginate') _PAGE_ @lang('app.of') _PAGES_",
            "search" : "@lang('app.search')",
        },
        "lengthMenu": [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "All"] // change per page values here
        ],
        // set the initial value
        "pageLength": 10,
    } );
</script>
@endpush


