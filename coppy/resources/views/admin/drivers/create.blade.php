@extends('admin.layouts.app')

@section('title')
@lang('app.add')
@endsection

@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/datepicker/datedropper.min.css') }}">
<link href="{{ asset('public/assets/css/design-css/design.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/plugins/date_time_pickers/bootstrap_date_range_picker/daterangepicker.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('public/plugins/date_time_pickers/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('public/plugins/timepicker/jquery.timepicker.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('public/plugins/date_time_pickers/custom_datetimepicker_style/custom_datetimepicker.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/select2/select2.min.css') }}">

@endsection

@section('content')

@include('message')

<div class="row" id="cancel-row">
                
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('app.add')</h4>
                    </div>          
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form  action="{{ url(route('drivers.store'))}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h6>@lang('app.company_info')</h6>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.fname') <span class="required">&#9733;</span></label>
                                <input type="text" class="form-control" name="fname" value="{{ old('fname')}}" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.lname') <span class="required">&#9733;</span></label>
                                <input type="text" class="form-control" name="lname" value="{{ old('lname')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.phone') <span class="required">&#9733;</span></label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone')}}" id="ph-number" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.password') <span class="required">&#9733;</span></label>
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.email')</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.app_lang')</label>
                                <select name="language" class="form-control">
                                    <option value="ar">@lang('app.ar')</option>
                                    <option value="en">@lang('app.en')</option>
                                    <option value="ar_en">@lang('app.ar_en')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.birthdate')</label>
                                <input type="text" class="form-control" name="birthdate" id="birthdate"  data-format="Y-m-d" data-lang="{{ LaravelLocalization::getCurrentLocale() }}" data-modal="false" data-large-default="false" data-large-mode="false">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.birthdate_hijri')</label>
                                <input type="text" class="form-control" name="birthdate_hijri" value="{{ old('birthdate_hijri')}}" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.nationality')</label>
                                <select name="country_id" class="placeholder js-states form-control">
                                    @isset($countries)
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->code . " - ". $country->name  }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.person_name')</label>
                                <input type="text" class="form-control" name="person_name" value="{{ old('person_name')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.state_num')</label>
                                <input type="text" class="form-control" name="state_num" value="{{ old('state_num')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>@lang('app.state_expire_date')</label>
                            <div class="input-control text mb-5" data-role="datepicker">
                                <input type="text" name="state_expire_date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>@lang('app.city') <span class="required">&#9733;</span></label>
                                <select name="city_id" class="custom-select">
                                    @isset($cities)
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}">{{  $city->name }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.vehicle') <span class="required">&#9733;</span></label>
                                <select name="vehicle_id" class="placeholder js-states form-control">
                                    <option value="0">@lang('app.select')</option>
                                    @isset($vehicles)
                                        @foreach($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}">{{ $vehicle->car_id .' | '. $vehicle->carName . ' | ' . $vehicle->reg_number }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.license_type')</label>
                                <select name="license_type" class="placeholder js-states form-control">
                                    <option value="0">@lang('app.license_private')</option>
                                    <option value="1">@lang('app.license_public')</option>
                                    <option value="2">@lang('app.license_temp')</option>
                                    <option value="3">@lang('app.license_bike')</option>
                                    <option value="4">@lang('app.license_taxi')</option>
                                    <option value="5">@lang('app.license_move1')</option>
                                    <option value="6">@lang('app.license_move2')</option>
                                    <option value="7">@lang('app.license_move3')</option>
                                    <option value="8">@lang('app.license_machine')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.license_num')</label>
                                <input type="text" class="form-control" name="license_num" value="{{ old('license_num')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>@lang('app.license_expire_date')</label>
                            <div class="input-control text mb-5" data-role="datepicker">
                                <input type="text" name="license_expire_date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.contract_type')</label>
                                <select name="type" class="form-control">
                                    <option value="0">@lang('app.monthly_salary')</option>
                                    <option value="1">@lang('app.daily')</option>
                                    <option value="2">@lang('app.perorder')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.salary')</label>
                                <input type="text" class="form-control" name="salary" value="{{ old('salary')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.bank_name')</label>
                                <input type="text" class="form-control" name="bank_name" value="{{ old('bank_name')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.bank_num')</label>
                                <input type="text" class="form-control" name="bank_num" value="{{ old('bank_num')}}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h6>@lang('app.workingtime')</h6>
                    

                    <table class="table table-bordered">
                        <tr>
                            <th>@lang('app.saturday')</th>
                            <th>@lang('app.sunday')</th>
                            <th>@lang('app.monday')</th>
                            <th>@lang('app.tuesday')</th>
                            <th>@lang('app.wednesday')</th>
                            <th>@lang('app.thursday')</th>
                            <th>@lang('app.friday')</th>
                            <th>@lang('app.filter')</th>
                            <th>@lang('app.action')</th>
                        </tr>
                        <tr>
                            <td>
                                <div class="n-chk">
                                    <label class="new-control new-checkbox checkbox-primary">
                                      <input type="checkbox" name="day[0][saturday]" class="new-control-input" checked >
                                      <span class="new-control-indicator"></span>  &nbsp;
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="n-chk">
                                    <label class="new-control new-checkbox checkbox-primary">
                                      <input type="checkbox" name="day[0][sunday]" class="new-control-input" checked >
                                      <span class="new-control-indicator"></span>  &nbsp;
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="n-chk">
                                    <label class="new-control new-checkbox checkbox-primary">
                                      <input type="checkbox" name="day[0][monday]" class="new-control-input" checked >
                                      <span class="new-control-indicator"></span>  &nbsp;
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="n-chk">
                                    <label class="new-control new-checkbox checkbox-primary">
                                      <input type="checkbox" name="day[0][tuesday]" class="new-control-input" checked >
                                      <span class="new-control-indicator"></span>  &nbsp;
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="n-chk">
                                    <label class="new-control new-checkbox checkbox-primary">
                                      <input type="checkbox" name="day[0][wednesday]" class="new-control-input" checked >
                                      <span class="new-control-indicator"></span>  &nbsp;
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="n-chk">
                                    <label class="new-control new-checkbox checkbox-primary">
                                      <input type="checkbox" name="day[0][thursday]" class="new-control-input" checked >
                                      <span class="new-control-indicator"></span>  &nbsp;
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="n-chk">
                                    <label class="new-control new-checkbox checkbox-primary">
                                      <input type="checkbox" name="day[0][friday]" class="new-control-input" checked >
                                      <span class="new-control-indicator"></span>  &nbsp;
                                    </label>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0"> <input type="text" class="form-control" name="day[0][from_time]" value="00:00"> </p>
                                <p class="mb-0">-- </p>
                                <p class="mb-0"><input type="text" class="form-control" name="day[0][to_time]"  value="01:00"></p>
                            </td>
                            <td>
                                <button class="btn btn-danger delete_item" type="button">
                                    <i class="flaticon-delete"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="rowsAdded"></tr>

                    </table>
                    
                    <div class="form-group text-right padding-top-5px">
                        <button id="addItem" class="btn btn-secondary mt-4" type="button"> 
                        <i class="flaticon-add-circle-outline"></i>  @lang('app.add') 
                        </button>
                    </div>

                    <hr>
                    <h6>@lang('app.required_files')</h6>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.driver_image')</label>
                                <input type="file" class="form-control" name="driver_image">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.car_image')</label>
                                <input type="file" class="form-control" name="car_image">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.license_image')</label>
                                <input type="file" class="form-control" name="license_image">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.state_image')</label>
                                <input type="file" class="form-control" name="state_image">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.insurance_image')</label>
                                <input type="file" class="form-control" name="insurance_image">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.car_isemara')</label>
                                <input type="file" class="form-control" name="car_isemara">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.bank_card')</label>
                                <input type="file" class="form-control" name="bank_card">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.account_number_image')</label>
                                <input type="file" class="form-control" name="account_number_image">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">@lang('app.add') @lang('app.driver')</button>
                </form>
            </div>
        </div>
    </div>

</div>


  

@endsection




@push('script')
<script>

    var x = 0;
    $(document).on('click' , '#addItem' , function(e) {
        e.preventDefault();
        x++;

   
        var new_row = '<tr id="rowid'+x+'">' +
                            '<td>' +
                                '<div class="n-chk">' +
                                    '<label class="new-control new-checkbox checkbox-primary">' +
                                      '<input type="checkbox" name="day['+x+'][saturday]" class="new-control-input" checked >' +
                                      '<span class="new-control-indicator"></span>  &nbsp;' +
                                    '</label>' +
                                '</div>' +
                            '</td>' +
                            '<td>' +
                                '<div class="n-chk">' +
                                    '<label class="new-control new-checkbox checkbox-primary">' +
                                      '<input type="checkbox" name="day['+x+'][sunday]" class="new-control-input" checked >' +
                                      '<span class="new-control-indicator"></span>  &nbsp;' +
                                    '</label>' +
                                '</div>' +
                            '</td>' +
                            '<td>' +
                                '<div class="n-chk">' +
                                    '<label class="new-control new-checkbox checkbox-primary">' +
                                      '<input type="checkbox" name="day['+x+'][monday]" class="new-control-input" checked >' +
                                      '<span class="new-control-indicator"></span>  &nbsp;' +
                                    '</label>' +
                                '</div>' +
                            '</td>' +
                            '<td>' +
                                '<div class="n-chk">' +
                                    '<label class="new-control new-checkbox checkbox-primary">' +
                                      '<input type="checkbox" name="day['+x+'][tuesday]" class="new-control-input" checked >' +
                                      '<span class="new-control-indicator"></span>  &nbsp;' +
                                    '</label>' +
                                '</div>' +
                            '</td>' +
                            '<td>' +
                                '<div class="n-chk">' +
                                    '<label class="new-control new-checkbox checkbox-primary">'+
                                      '<input type="checkbox" name="day['+x+'][wednesday]" class="new-control-input" checked >' +
                                      '<span class="new-control-indicator"></span>  &nbsp;' +
                                    '</label>' +
                                '</div>' +
                            '</td>' +
                            '<td>' +
                                '<div class="n-chk">' +
                                    '<label class="new-control new-checkbox checkbox-primary">' +
                                      '<input type="checkbox" name="day['+x+'][thursday]" class="new-control-input" checked >' +
                                      '<span class="new-control-indicator"></span>  &nbsp;' +
                                    '</label>' +
                                '</div>' +
                            '</td>' +
                            '<td>' +
                                '<div class="n-chk">' +
                                    '<label class="new-control new-checkbox checkbox-primary">' +
                                      '<input type="checkbox" name="day['+x+'][friday]" class="new-control-input" checked >' +
                                      '<span class="new-control-indicator"></span>  &nbsp;' +
                                    '</label>' +
                                '</div>' +
                            '</td>' +
                            '<td>' +
                                '<p class="mb-0"> <input type="text" class="form-control" name="day['+x+'][from_time]" value="12:00"> </p>' +
                                '<p class="mb-0">-- </p>' +
                                '<p class="mb-0"><input type="text" class="form-control" name="day['+x+'][to_time]"  value="24:00"></p>' +
                            '</td>' +
                            '<td>' +
                                '<button class="btn btn-danger delete_item" type="button">' +
                                    '<i class="flaticon-delete"></i>' +
                                '</button>' +
                            '</td>' +
                        '</tr>';


      $(new_row).insertAfter($('.rowsAdded'));


    });


    $(document).on('click','.delete_item',function(){

        $(this).closest("tr").remove();

        // var id = $(this).closest("tr").prop("id").replace('rowid', '');
    });



</script>
<script src="{{ asset('public/plugins/datepicker/datedropper.min.js') }}"></script>
<script src="{{ asset('public/plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('public/plugins/input-mask/input-mask.js?v=11') }}"></script>
<script src="{{ asset('public/assets/js/design-js/design.js') }}"></script>
<script src="{{ asset('public/plugins/date_time_pickers/bootstrap_date_range_picker/moment.min.js') }}"></script>
<script src="{{ asset('public/plugins/date_time_pickers/bootstrap_date_range_picker/daterangepicker.js') }}"></script>
<script src="{{ asset('public/plugins/timepicker/jquery.timepicker.js') }}"></script>
<script src="{{ asset('public/plugins/date_time_pickers/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('public/plugins/date_time_pickers/bootstrap_date_range_picker/daterangepicker_examples.js') }}"></script>
<script src="{{ asset('public/plugins/timepicker/custom-timepicker.js') }}"></script>
<script src="{{ asset('public/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('public/plugins/select2/custom-select2.js') }}"></script>
<script>
    $('#birthdate').dateDropper();
    // $('#state_expire_date').dateDropper();
    // $('#license_expire_date').dateDropper();
</script>

@endpush