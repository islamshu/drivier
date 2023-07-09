@extends('admin.layouts.app') 

@section('title')
@lang('app.admin_list')
@endsection

@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/custom_dt_html5.css')}}">    
@endsection
@section('content')
@include('message')

<div class="row" id="cancel-row">
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                        <h4>@lang('app.admin_list')</h4>
                    </div>                 
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right padding-top-10px">
                        <a href="{{ route('admin.register') }}" class="btn btn-classic btn-success">@lang('app.addadmin')</a>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive mb-4">
                    <table id="html5-extension" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th> @lang('app.id') </th>
                                <th> @lang('app.name') </th>
                                <th> @lang('app.email') </th>
                                <th> @lang('app.city') </th>
                                <th> @lang('app.role') </th>
                                <th> @lang('app.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            
           
                            
                        </tbody>
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
        ajax: "{{ url(route('admin.show')) }}",
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'city', name: 'city' },
                    { data: 'role', name: 'role' },
                    { data: 'control', name: 'control' },
                   
                ],
        buttons: {
            buttons: [
                { extend: 'copy', className: 'btn btn-success btn-rounded btn-sm mb-4' , text: "@lang('app.copy')" },
                { extend: 'csv', className: 'btn btn-success btn-rounded btn-sm mb-4' , text: "@lang('app.csv')"},
                { extend: 'excel', className: 'btn btn-success btn-rounded btn-sm mb-4' , text: "@lang('app.excel')"},
                { extend: 'print', className: 'btn btn-success btn-rounded btn-sm mb-4' , text: "@lang('app.print')"}
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