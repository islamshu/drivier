@extends('customer.layouts.app')

@section('title')
@lang('app.branches')
@endsection


@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_html5.css')}}">    
<link href="{{ asset('plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/file-upload/file-upload-with-preview.css') }}" rel="stylesheet" type="text/css" />
<style>
    .modal {
        top: 180px;
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
                        <h4>@lang('app.branches')</h4>
                    </div>                 
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right padding-top-5px">
                        <a href="{{ url(route('users.customer.create'))}}" class="btn btn-classic btn-primary">
                            <i class="flaticon-square-plus"></i>
                        </a>
                    </div> 
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive mb-4">
                    <table id="html5-extension" class="table table-striped table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th># </th>
                                <th> @lang('app.branch_name') </th>
                                <th> @lang('app.name') </th>
                                <th> @lang('app.email') </th>
                                <th> @lang('app.roles')</th>
                                <th> @lang('app.action') </th>
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
<script src="{{ asset('plugins/table/datatable/datatables.js')}}"></script>
<script src="{{ asset('plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('plugins/table/datatable/button-ext/jszip.min.js')}}"></script>    
<script src="{{ asset('plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
<script src="{{ asset('plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>

<script>

   
    $('#html5-extension').DataTable( {
        ajax: "{{ url(route('users.customer.index')) }}",
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
                    { data: 'id', name: 'id' },
                    { data: 'branch_name', name: 'branch_name' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'roles', name: 'roles' },
                    { data: 'action', name: 'action' },
                   
                ],
        buttons: {
            buttons: [
                { extend: 'copy', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.copy')"},
                { extend: 'csv', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.csv')" },
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
            "search" : "@lang('app.search')",
        }
    } );
</script>
@endpush