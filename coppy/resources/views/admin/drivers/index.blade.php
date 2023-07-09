
@extends('admin.layouts.app')

@section('title')
@lang('app.drivers')
@endsection


@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/custom_dt_html5.css')}}">    
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/custom_dt_customer.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/ui-kit/tabs-accordian/custom-tabs.css')}}" />
@endsection

@section('content')

@include('message')

<div class="row" id="cancel-row">
                
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                        {{-- <h4>@lang('app.drivers')</h4> --}}

                        <ul class="nav nav-pills mb-3 mt-3 nav-fill" id="justify-pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="justify-pills-home-tab" data-toggle="pill" href="#justify-pills-home" role="tab" aria-controls="justify-pills-home" aria-selected="true">@lang('app.all')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="justify-pills-profile-tab" data-toggle="pill" href="#justify-pills-profile" role="tab" aria-controls="justify-pills-profile" aria-selected="false">@lang('app.active')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="justify-pills-contact-tab" data-toggle="pill" href="#justify-pills-contact" role="tab" aria-controls="justify-pills-contact" aria-selected="false">@lang('app.pending')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="justify-pills-block-tab" data-toggle="pill" href="#justify-pills-block" role="tab" aria-controls="justify-pills-block" aria-selected="false">@lang('app.block')</a>
                            </li>
                        </ul>
                    </div>                 
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right padding-top-5px">
                        <a href="{{ url(route('drivers.create'))}}" class="btn btn-classic btn-primary" >
                            <i class="flaticon-square-plus"></i>
                             @lang('app.add')
                        </a>
                    </div> 
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="tab-content" id="justify-pills-tabContent">
                    <div class="tab-pane fade show active" id="justify-pills-home" role="tabpanel" aria-labelledby="justify-pills-home-tab">
                        <div class="table-responsive mb-4">
                            <table id="html5-extension" class="table table-striped table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> @lang('app.fname') </th>
                                        <th> @lang('app.lname') </th>
                                        <th> @lang('app.login_info')</th>
                                        <th> @lang('app.contract_type')</th>
                                        <th> @lang('app.vehicle')</th>
                                        <th> @lang('app.status')</th>
                                        <th> @lang('app.action') </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="justify-pills-profile" role="tabpanel" aria-labelledby="justify-pills-profile-tab">
                       {{-- Active --}}
                       <div class="table-responsive mb-4">
                            <table id="active-extension" class="table table-striped table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> @lang('app.fname') </th>
                                        <th> @lang('app.lname') </th>
                                        <th> @lang('app.login_info')</th>
                                        <th> @lang('app.contract_type')</th>
                                        <th> @lang('app.vehicle')</th>
                                        <th> @lang('app.status')</th>
                                        <th> @lang('app.action') </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="justify-pills-contact" role="tabpanel" aria-labelledby="justify-pills-contact-tab">
                        {{-- pending --}}
                        <div class="table-responsive mb-4">
                            <table id="pending-extension" class="table table-striped table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> @lang('app.fname') </th>
                                        <th> @lang('app.lname') </th>
                                        <th> @lang('app.login_info')</th>
                                        <th> @lang('app.contract_type')</th>
                                        <th> @lang('app.vehicle')</th>
                                        <th> @lang('app.status')</th>
                                        <th> @lang('app.action') </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="justify-pills-block" role="tabpanel" aria-labelledby="justify-pills-block-tab">
                        {{-- block --}}
                        <div class="table-responsive mb-4">
                            <table id="block-extension" class="table table-striped table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> @lang('app.fname') </th>
                                        <th> @lang('app.lname') </th>
                                        <th> @lang('app.login_info')</th>
                                        <th> @lang('app.contract_type')</th>
                                        <th> @lang('app.vehicle')</th>
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
        ajax: "{{ url(route('drivers.index')) }}",
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
                    { data: 'id', name: 'id' },
                    { data: 'fname', name: 'fname' },
                    { data: 'lname', name: 'lname' },
                    { data: 'login_info', name: 'login_info' },
                    { data: 'contract_type', name: 'contract_type' },
                    { data: 'vehicle', name: 'vehicle' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action' },
                   
                ],
        buttons: {
            buttons: [
                { extend: 'copy', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.copy')" },
                { extend: 'csv', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.csv')"},
                { extend: 'excel', className: 'btn btn-classic btn-success btn-sm mb-4'  , text: "@lang('app.excel')"},
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
    });



    $('#active-extension').DataTable( {
        ajax: "{{ url(route('drivers.index.active')) }}",
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
                    { data: 'id', name: 'id' },
                    { data: 'fname', name: 'fname' },
                    { data: 'lname', name: 'lname' },
                    { data: 'login_info', name: 'login_info' },
                    { data: 'contract_type', name: 'contract_type' },
                    { data: 'vehicle', name: 'vehicle' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action' },
                   
                ],
        buttons: {
            buttons: [
                { extend: 'copy', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.copy')" },
                { extend: 'csv', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.csv')"},
                { extend: 'excel', className: 'btn btn-classic btn-success btn-sm mb-4'  , text: "@lang('app.excel')"},
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
    });



    $('#pending-extension').DataTable( {
        ajax: "{{ url(route('drivers.index.pending')) }}",
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
                    { data: 'id', name: 'id' },
                    { data: 'fname', name: 'fname' },
                    { data: 'lname', name: 'lname' },
                    { data: 'login_info', name: 'login_info' },
                    { data: 'contract_type', name: 'contract_type' },
                    { data: 'vehicle', name: 'vehicle' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action' },
                   
                ],
        buttons: {
            buttons: [
                { extend: 'copy', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.copy')" },
                { extend: 'csv', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.csv')"},
                { extend: 'excel', className: 'btn btn-classic btn-success btn-sm mb-4'  , text: "@lang('app.excel')"},
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
    });



    $('#block-extension').DataTable( {
        ajax: "{{ url(route('drivers.index.block')) }}",
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
                    { data: 'id', name: 'id' },
                    { data: 'fname', name: 'fname' },
                    { data: 'lname', name: 'lname' },
                    { data: 'login_info', name: 'login_info' },
                    { data: 'contract_type', name: 'contract_type' },
                    { data: 'vehicle', name: 'vehicle' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action' },
                   
                ],
        buttons: {
            buttons: [
                { extend: 'copy', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.copy')" },
                { extend: 'csv', className: 'btn btn-classic btn-success btn-sm mb-4' , text: "@lang('app.csv')"},
                { extend: 'excel', className: 'btn btn-classic btn-success btn-sm mb-4'  , text: "@lang('app.excel')"},
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
    });

    
</script>
@endpush