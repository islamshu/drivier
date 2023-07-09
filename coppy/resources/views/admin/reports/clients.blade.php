@extends('admin.layouts.app')

@section('title')
@lang('app.clients')
@endsection


@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/custom_dt_html5.css')}}">    
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/custom_dt_customer.css')}}">
@endsection

@section('content')

@include('message')

<div class="row" id="cancel-row">
                
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('app.clients')</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive mb-4">
                    <table id="clientsTable" class="table table-striped table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th> @lang('app.name') </th>
                                <th> @lang('app.phone') </th>
                                <th> @lang('app.city')</th>
                                <th> @lang('app.region') </th>
                                <th> @lang('app.age') </th>
                                <th> @lang('app.gender') </th>
                                <th> @lang('app.nationality') </th>
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


    $('#clientsTable').DataTable( {
        ajax: "{{ url(route('clients.index')) }}",
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
                    { data: 'name', name: 'name' },
                    { data: 'phone', name: 'phone' },
                    { data: 'city', name: 'city' },
                    { data: 'region', name: 'region' },
                    { data: 'age', name: 'age' },
                    { data: 'gender', name: 'gender' },
                    { data: 'nationality', name: 'nationality' },
                   
                ],
        buttons: {
            buttons: [
                { extend: 'copy', className: 'btn btn-classic btn-primary btn-sm mb-4' , text: "@lang('app.copy')" },
                { extend: 'csv', className: 'btn btn-classic btn-primary btn-sm mb-4' , text: "@lang('app.csv')"},
                { extend: 'excel', className: 'btn btn-classic btn-primary btn-sm mb-4', text: "@lang('app.excel')" },
                { extend: 'print', className: 'btn btn-classic btn-primary btn-sm mb-4' , text: "@lang('app.print')"}
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