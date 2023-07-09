
@extends('admin.layouts.app')

@section('title')
@lang('app.vehicles')
@endsection


@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/custom_dt_html5.css')}}">    
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/table/datatable/custom_dt_customer.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/ui-kit/tabs-accordian/custom-tabs.css')}}" />
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
                        {{-- <h4>@lang('app.vehicles')</h4> --}}
                        <ul class="nav nav-pills mb-3 mt-3 nav-fill" id="justify-pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="justify-pills-home-tab" data-toggle="pill" href="#justify-pills-home" role="tab" aria-controls="justify-pills-home" aria-selected="true">@lang('app.all')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="justify-pills-profile-tab" data-toggle="pill" href="#justify-pills-profile" role="tab" aria-controls="justify-pills-profile" aria-selected="false">@lang('app.active')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="justify-pills-contact-tab" data-toggle="pill" href="#justify-pills-contact" role="tab" aria-controls="justify-pills-contact" aria-selected="false">@lang('app.deactive')</a>
                            </li>
                        </ul>
                    </div>                 
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right padding-top-5px">
                        <button class="btn btn-classic btn-primary" data-toggle="modal" data-target="#createDriver">
                            <i class="flaticon-square-plus"></i>
                        </button>
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
                                        <th> #</th>
                                        <th> @lang('app.carName') </th>
                                        <th> @lang('app.type') </th>
                                        <th> @lang('app.color')</th>
                                        <th> @lang('app.reg_number')</th>
                                        <th> @lang('app.capacity')</th>
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
                                        <th> #</th>
                                        <th> @lang('app.carName') </th>
                                        <th> @lang('app.type') </th>
                                        <th> @lang('app.color')</th>
                                        <th> @lang('app.reg_number')</th>
                                        <th> @lang('app.capacity')</th>
                                        <th> @lang('app.status')</th>
                                        <th> @lang('app.action') </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="justify-pills-contact" role="tabpanel" aria-labelledby="justify-pills-contact-tab">
                        {{-- deactive --}}
                        <div class="table-responsive mb-4">
                            <table id="deactive-extension" class="table table-striped table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> #</th>
                                        <th> @lang('app.carName') </th>
                                        <th> @lang('app.type') </th>
                                        <th> @lang('app.color')</th>
                                        <th> @lang('app.reg_number')</th>
                                        <th> @lang('app.capacity')</th>
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

<!-- Create Driver -->
<div class="modal fade" id="createDriver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title"> @lang('app.vehicles')</h5>
          </div>
        <form  action="{{ url(route('vehicles.store'))}}" method="POST">
            @csrf
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>@lang('app.carName') <span class="required">&#9733;</span> </label>
                            <input type="text" class="form-control" name="carName" value="{{ old('carName') }}" placeholder="@lang('app.carName')">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>@lang('app.type') <span class="required">&#9733;</span> </label>
                            <select name="carType" id="carType" class="form-control">
                                <option value="0">@lang('app.sedan')</option>
                                <option value="1">@lang('app.truck')</option>
                                <option value="2">@lang('app.pickup')</option>
                                <option value="3">@lang('app.coolcar')</option>
                                <option value="4">@lang('app.allcars')</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>@lang('app.reg_number') <span class="required">&#9733;</span> </label>
                            <input type="text" class="form-control" name="reg_number" value="{{ old('reg_number') }}" placeholder="@lang('app.reg_number')">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>@lang('app.year')</label>
                            <input type="text" class="form-control" name="year" value="{{ old('year') }}" placeholder="@lang('app.year')">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>@lang('app.color')</label>
                            <input type="text" class="form-control" name="color" value="{{ old('color') }}" placeholder="@lang('app.color')">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>@lang('app.capacity')</label>
                            <input type="text" class="form-control" name="capacity" value="{{ old('capacity') }}" placeholder="@lang('app.capacity')">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('app.close')</button>
              <button type="submit" class="btn btn-primary">@lang('app.add')</button>
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

<script>


    $('#html5-extension').DataTable( {
        ajax: "{{ url(route('vehicles.index')) }}",
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'type', name: 'type' },
                    { data: 'color', name: 'color' },
                    { data: 'reg_number', name: 'reg_number' },
                    { data: 'capacity', name: 'capacity' },
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
    } );








    $('#active-extension').DataTable( {
        ajax: "{{ url(route('vehicles.index.active')) }}",
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'type', name: 'type' },
                    { data: 'color', name: 'color' },
                    { data: 'reg_number', name: 'reg_number' },
                    { data: 'capacity', name: 'capacity' },
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
    } );





    $('#deactive-extension').DataTable( {
        ajax: "{{ url(route('vehicles.index.deactive')) }}",
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'type', name: 'type' },
                    { data: 'color', name: 'color' },
                    { data: 'reg_number', name: 'reg_number' },
                    { data: 'capacity', name: 'capacity' },
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
    } );

</script>
@endpush