<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} :: @lang('app.joinusasdriver') </title>
    <link rel="icon" type="image/x-icon" href="{{asset('public/favicon.png')}}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('fonts/font-ar.css')}}">
    @if (LaravelLocalization::getCurrentLocale() == 'ar')
        {{-- <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" > --}}
        <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap-ar.min.css')}}">
    @else
        <link href="{{ asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    @endif
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/datepicker/datedropper.min.css') }}">
    <link href="{{ asset('assets/css/design-css/design.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/date_time_pickers/bootstrap_date_range_picker/daterangepicker.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/date_time_pickers/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/timepicker/jquery.timepicker.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/date_time_pickers/custom_datetimepicker_style/custom_datetimepicker.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
    <link href="{{ asset('assets/css/plugins.css?v=1')}}" rel="stylesheet" type="text/css" />
    <style>
        body {
            font-family: 'Al-Jazeera-Arabic' ,  "Open Sans", sans-serif;
        }
        .required {
            color: #f10 !important;
            font-size: 10px !important;
        }

        #content {
            width: 100% !important;
        }

        .input-control {
            display: block;
        }
    </style>

@if (LaravelLocalization::getCurrentLocale() == 'ar')
<style>
    body {
        font-weight: 600;
        font-style: normal;
        direction: rtl !important;
    }
</style>
@endif
</head>
<body>
    <!--  BEGIN CONTENT PART  -->
    <div id="content" class="main-content">
        <div class="container">
            <div class="row" id="cancel-row">
                
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>@lang('app.joinusasdriver')</h4>
                                </div>          
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            @include('message')
                            <form  action="{{ url(route('driver.store'))}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <h6>@lang('app.company_info')</h6>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>@lang('app.fname') <span class="required">&#9733;</span></label>
                                                    <input type="text" class="form-control" name="fname" value="{{ old('fname')}}" >
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>@lang('app.lname') <span class="required">&#9733;</span></label>
                                                    <input type="text" class="form-control" name="lname" value="{{ old('lname')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>@lang('app.phone') <span class="required">&#9733;</span></label>
                                                    <input type="text" class="form-control" name="phone" value="{{ old('phone')}}" id="ph-number" >
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>@lang('app.password') <span class="required">&#9733;</span></label>
                                                    <input type="password" class="form-control" name="password">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>@lang('app.email')</label>
                                                    <input type="email" class="form-control" name="email" value="{{ old('email')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>@lang('app.city') <span class="required">&#9733;</span></label>
                                                    <select name="city_id" class="placeholder js-states form-control">
                                                        @isset($cities)
                                                            @foreach($cities as $city)
                                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>@lang('app.birthdate')</label>
                                                    <input type="text" class="form-control" name="birthdate" id="birthdate"  data-format="Y-m-d" data-lang="{{ LaravelLocalization::getCurrentLocale() }}" data-modal="false" data-large-default="false" data-large-mode="false">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>@lang('app.birthdate_hijri')</label>
                                                    <input type="text" class="form-control" name="birthdate_hijri" value="{{ old('birthdate_hijri')}}" >
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
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
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>@lang('app.person_name')</label>
                                                    <input type="text" class="form-control" name="person_name" value="{{ old('person_name')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>@lang('app.state_num')</label>
                                                    <input type="text" class="form-control" name="state_num" value="{{ old('state_num')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <label>@lang('app.state_expire_date')</label>
                                                <div class="input-control text mb-5" data-role="datepicker">
                                                    <input type="text" name="state_expire_date">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>@lang('app.bank_name')</label>
                                                    <input type="text" class="form-control" name="bank_name" value="{{ old('bank_name')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>@lang('app.bank_num')</label>
                                                    <input type="text" class="form-control" name="bank_num" value="{{ old('bank_num')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                        <h5>@lang('app.vehicle')</h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>@lang('app.carName') <span class="required">&#9733;</span> </label>
                                                    <input type="text" class="form-control" name="carName" value="{{ old('carName') }}" placeholder="@lang('app.carName')">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
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
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>@lang('app.reg_number') <span class="required">&#9733;</span> </label>
                                                    <input type="text" class="form-control" name="reg_number" value="{{ old('reg_number') }}" placeholder="@lang('app.reg_number')">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>@lang('app.year')</label>
                                                    <input type="text" class="form-control" name="year" value="{{ old('year') }}" placeholder="@lang('app.year')">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>@lang('app.color')</label>
                                                    <input type="text" class="form-control" name="color" value="{{ old('color') }}" placeholder="@lang('app.color')">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>@lang('app.capacity')</label>
                                                    <input type="text" class="form-control" name="capacity" value="{{ old('capacity') }}" placeholder="@lang('app.capacity')">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
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
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>@lang('app.license_num')</label>
                                                    <input type="text" class="form-control" name="license_num" value="{{ old('license_num')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <label>@lang('app.license_expire_date')</label>
                                                <div class="input-control text mb-5" data-role="datepicker">
                                                    <input type="text" name="license_expire_date">
                                                </div>
                                            </div>
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
                                
                                <div class="form-group text-right">
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

                                <br>
                                <br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">@lang('app.joinusasdriver')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
    <!--  END CONTENT PART  -->

</div>
<!-- END MAIN CONTAINER -->

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{ asset('bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('plugins/scrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{ asset('assets/js/app.js')}}"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>


<script src="{{ asset('plugins/datepicker/datedropper.min.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/input-mask/input-mask.js?v=11') }}"></script>
<script src="{{ asset('assets/js/design-js/design.js') }}"></script>
<script src="{{ asset('plugins/date_time_pickers/bootstrap_date_range_picker/moment.min.js') }}"></script>
<script src="{{ asset('plugins/date_time_pickers/bootstrap_date_range_picker/daterangepicker.js') }}"></script>
<script src="{{ asset('plugins/timepicker/jquery.timepicker.js') }}"></script>
<script src="{{ asset('plugins/date_time_pickers/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('plugins/date_time_pickers/bootstrap_date_range_picker/daterangepicker_examples.js') }}"></script>
<script src="{{ asset('plugins/timepicker/custom-timepicker.js') }}"></script>
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('plugins/select2/custom-select2.js') }}"></script>


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

<script>
    $('#birthdate').dateDropper();
</script>

</body>
</html>
