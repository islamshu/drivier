@extends('admin.layouts.app')


@section('title')
@lang('app.changepassword')
@endsection

@section('content')


<div class="widget portlet-widget">
    <div class="widget-content widget-content-area">
        <div class="portlet portlet-danger">
            <div class="portlet-title portlet-danger  d-flex justify-content-between">
                <div class="caption  align-self-center">
                    <span class="caption-subject text-uppercase white">@lang('app.changepassword')</span>
                </div>
            </div>
            <div class="portlet-body portlet-common-body">
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <form method="POST" action="{{ route('admin.password.change') }}" >
                            @csrf
                            <div class="form-group">
                                <label for="oldPassword" >@lang('app.oldpassword')</label>
                                <input type="password" class="form-control{{ $errors->has('oldPassword') ? ' is-invalid' : '' }}" name="oldPassword" required autofocus>
                            </div>
                        
                            <div class="form-group">
                                <label for="password" >@lang('app.password')</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                        required>
                            </div>
                        
                            <div class="form-group">
                                <label for="password-confirm">@lang('app.repassword')</label>
                                <input id="password-confirm" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation" required>
                            </div>
                        
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">
                                    @lang('app.changepassword')
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection