@extends('admin.layouts.app')

@section('title')
@lang('app.edit') @lang('app.driver')
@endsection

@section('header')>
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">

@endsection

@section('content')

@include('message')

<div class="row" id="cancel-row">
                
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('app.edit') @lang('app.driver')</h4>
                    </div>          
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form  action="{{ url(route('drivers.edit.update' , [$driver->id]))}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h6>@lang('app.company_info')</h6>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.fname') <span class="required">&#9733;</span></label>
                                <input type="text" class="form-control" name="fname" value="{{ $driver->fname ?? old('fname')}}" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.lname') <span class="required">&#9733;</span></label>
                                <input type="text" class="form-control" name="lname" value="{{ $driver->lname ?? old('lname')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.phone') <span class="required">&#9733;</span></label>
                                <input type="text" class="form-control" name="phone" value="{{ $driver->phone ?? old('phone')}}" id="ph-number" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.app_lang')</label>
                                <select name="language" class="form-control">
                                    <option value="0" {{ $driver->language == 0 ? 'selected' : ''}}>@lang('app.select')</option>
                                    <option value="ar" {{ $driver->language == 'ar' ? 'selected' : ''}}>@lang('app.ar')</option>
                                    <option value="en" {{ $driver->language == 'en' ? 'selected' : ''}}>@lang('app.en')</option>
                                    <option value="ar_en" {{ $driver->language == 'ar_en' ? 'selected' : ''}}>@lang('app.ar_en')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.email')</label>
                                <input type="email" class="form-control" name="email" value="{{ $driver->email ?? old('email')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.city') <span class="required">&#9733;</span></label>
                                <select name="city_id" class="placeholder js-states form-control">
                                    <option value="0">@lang('app.select_city')</option>
                                    @isset($cities)
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}" {{ $driver->city_id == $city->id ? 'selected' : ''}}>{{ $city->name }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.birthdate')</label>
                                <input type="text" class="form-control" name="birthdate" value="{{ $driver->birthdate ?? old('birthdate')}}" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.birthdate_hijri')</label>
                                <input type="text" class="form-control" name="birthdate_hijri" value="{{ $driver->birthdate_hijri ?? old('birthdate_hijri')}}" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.nationality')</label>
                                <select name="country_id" class="placeholder js-states form-control">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" {{ $driver->country_id == $country->id ? 'selected' : ''}}>{{ $country->code . " - ". $country->name  }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.person_name')</label>
                                <input type="text" class="form-control" name="person_name" value="{{ $driver->person_name ?? old('person_name')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.state_num')</label>
                                <input type="text" class="form-control" name="state_num" value="{{ $driver->state_num ?? old('state_num')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                           
                            <div class="form-group">
                                <label>@lang('app.state_expire_date')</label>
                                <input type="text" class="form-control" name="state_expire_date"  value="{{ $driver->state_expire_date ?? old('state_expire_date')}}" >
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
                                            <option value="{{ $vehicle->id }}" {{ $driver->vehicle_id == $vehicle->id ? 'selected' : ''}}>{{ $vehicle->car_id .' | '. $vehicle->carName . ' | ' . $vehicle->reg_number }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.license_type')</label>
                                <select name="license_type" class="placeholder js-states form-control">
                                    <option value="0" {{ $driver->license_type == 0 ? 'selected' : ''}} >@lang('app.license_private')</option>
                                    <option value="1" {{ $driver->license_type == 1 ? 'selected' : ''}} >@lang('app.license_public')</option>
                                    <option value="2" {{ $driver->license_type == 2 ? 'selected' : ''}} >@lang('app.license_temp')</option>
                                    <option value="3" {{ $driver->license_type == 3 ? 'selected' : ''}} >@lang('app.license_bike')</option>
                                    <option value="4" {{ $driver->license_type == 4 ? 'selected' : ''}} >@lang('app.license_taxi')</option>
                                    <option value="5" {{ $driver->license_type == 5 ? 'selected' : ''}} >@lang('app.license_move1')</option>
                                    <option value="6" {{ $driver->license_type == 6 ? 'selected' : ''}} >@lang('app.license_move2')</option>
                                    <option value="7" {{ $driver->license_type == 7 ? 'selected' : ''}} >@lang('app.license_move3')</option>
                                    <option value="8" {{ $driver->license_type == 8 ? 'selected' : ''}} >@lang('app.license_machine')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.license_num')</label>
                                <input type="text" class="form-control" name="license_num" value="{{ $driver->license_num ?? old('license_num')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.license_expire_date')</label>
                                <input type="text" class="form-control" name="license_expire_date" value="{{ $driver->license_expire_date ?? old('license_expire_date')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.contract_type')</label>
                                <select name="type" class="form-control">
                                    <option value="0" {{ $driver->type == 0 ? 'selected' : ''}} >@lang('app.monthly_salary')</option>
                                    <option value="1" {{ $driver->type == 1 ? 'selected' : ''}} >@lang('app.daily')</option>
                                    <option value="2" {{ $driver->type == 2 ? 'selected' : ''}} >@lang('app.perorder')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.salary')</label>
                                <input type="text" class="form-control" name="salary" value="{{ $driver->salary ?? old('salary')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.bank_name')</label>
                                <input type="text" class="form-control" name="bank_name" value="{{ $driver->bank_name ?? old('bank_name')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.bank_num')</label>
                                <input type="text" class="form-control" name="bank_num" value="{{ $driver->bank_num ?? old('bank_num')}}">
                            </div>
                        </div>
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
                    <button type="submit" class="btn btn-primary">@lang('app.update')</button>
                </form>
            </div>
        </div>
    </div>

</div>


  

@endsection




@push('script')

<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('plugins/select2/custom-select2.js') }}"></script>
@endpush