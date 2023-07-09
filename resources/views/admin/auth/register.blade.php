@extends('admin.layouts.app')

@section('title')
@lang('app.addadmin')
@endsection
@section('content')

    @include('message')

<div class="row">
    <div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('app.addadmin')</h4>
                    </div>                                                                        
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form method="POST" action="{{ route('admin.register') }}">
                    @csrf
                    <div class="form-row mb-4">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">@lang('app.name')</label>
                            <input type="text" class="form-control" name="name" placeholder="@lang('app.name')" value="{{ old('name') }}" required autofocus>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">@lang('app.email')</label>
                            <input type="email" class="form-control" name="email" placeholder="@lang('app.email')" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="form-row mb-4">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">@lang('app.password')</label>
                            <input type="password" class="form-control" name="password" placeholder="@lang('app.password')" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">@lang('app.repassword')</label>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="@lang('app.repassword')" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>@lang('app.city')</label>
                        <select name="city_id" class="form-control">
                            @isset($cities)
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    
                    <div class="form-group form-md-line-input has-info">
                        <label for="role_id">@lang('app.role')</label>
                        <select name="role_id[]" id="role_id" class="form-control" multiple>
                            <option disabled>@lang('app.select_role')</option>
                            @isset($roles)
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-button-7 mb-4 mt-3"> @lang('app.register') </button>
                        <a href="{{ route('admin.show') }}" class="btn btn-button-5 mb-4 mt-3"> @lang('app.close') </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
