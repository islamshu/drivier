@extends('admin.layouts.app')

@section('title')
@lang('app.edit')
@endsection

@section('content')

@include('message')

<div class="row" id="cancel-row">
                
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('app.edit')</h4>
                    </div>          
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form  action="{{ url(route('vehicles.edit.update' , [$vehicle->id])) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.carName') <span class="required">&#9733;</span> </label>
                                <input type="text" class="form-control" name="carName" value="{{ $vehicle->carName ?? old('carName') }}" placeholder="@lang('app.carName')">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.type') <span class="required">&#9733;</span> </label>
                                <select name="carType" id="carType" class="form-control">
                                    <option {{ $vehicle->carType == 0 ? 'selected' : ''}}  value="0">@lang('app.sedan')</option>
                                    <option {{ $vehicle->carType == 1 ? 'selected' : ''}} value="1">@lang('app.truck')</option>
                                    <option {{ $vehicle->carType == 2 ? 'selected' : ''}} value="2">@lang('app.pickup')</option>
                                    <option {{ $vehicle->carType == 3 ? 'selected' : ''}} value="3">@lang('app.coolcar')</option>
                                    <option {{ $vehicle->carType == 4 ? 'selected' : ''}} value="4">@lang('app.allcars')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.reg_number') <span class="required">&#9733;</span> </label>
                                <input type="text" class="form-control" name="reg_number" value="{{ $vehicle->reg_number ?? old('reg_number') }}" placeholder="@lang('app.reg_number')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.year')</label>
                                <input type="text" class="form-control" name="year" value="{{ $vehicle->year ?? old('year') }}" placeholder="@lang('app.year')">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.color')</label>
                                <input type="text" class="form-control" name="color" value="{{ $vehicle->color ?? old('color') }}" placeholder="@lang('app.color')">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.capacity')</label>
                                <input type="text" class="form-control" name="capacity" value="{{ $vehicle->capacity ?? old('capacity') }}" placeholder="@lang('app.capacity')">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">@lang('app.update')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


  

@endsection

