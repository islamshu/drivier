@extends('driver.layouts.app')


@section('title')
@lang('app.profile')
@endsection


@section('content')

@include('message')


<div class="row" id="cancel-row">
                
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                        <h4>@lang('app.profile')</h4>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                        <h4>@lang('app.changepassword')</h4>
                    </div>          
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ url(route('driver.update', [$driver->id]))}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $driver->name }}" name="name" placeholder="@lang('app.name')">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $driver->email }}" name="email" placeholder="@lang('app.email')">
                            </div>
                            <button type="submit" class="btn btn-classic btn-primary">@lang('app.save')</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ url(route('driver.password.change'))}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="password" class="form-control" name="oldPassword" placeholder="@lang('app.oldpassword')">
                            </div>
                    
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="@lang('app.password')">
                            </div>
                    
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="@lang('app.repassword')">
                            </div>
                            <button type="submit" class="btn btn-classic btn-danger">@lang('app.changepassword')</button>
                        </form>
                
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection