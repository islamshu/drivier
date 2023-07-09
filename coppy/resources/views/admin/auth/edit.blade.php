@extends('admin.layouts.app') @section('content')

@section('title')
@lang('app.edit') {{$admin->name}}
@endsection

@section('content')


@include('message')

<div class="row" id="cancel-row">
                
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('app.edit') </h4>
                    </div>                 
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{route('admin.update',[$admin->id])}}" method="post" role="form">
                    @csrf @method('patch')
                    <div class="form-group">
                        <label for="role">@lang('app.name')</label>
                        <input type="text" value="{{ $admin->name }}" name="name" class="form-control" id="role">
                    </div>
                
                    <div class="form-group">
                        <label for="role">@lang('app.email')</label>
                        <input type="text" value="{{ $admin->email }}" name="email" class="form-control" id="role">
                    </div>
                
                    <div class="form-group">
                        <label for="role_id">@lang('app.role')</label>
                
                        <select name="role_id[]" id="role_id" class="form-control {{ $errors->has('role_id') ? ' is-invalid' : '' }}" multiple>
                            <option selected disabled>@lang('app.select')</option>
                            @isset($roles)
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" 
                                        @if (in_array($role->id,$admin->roles->pluck('id')->toArray())) 
                                            selected 
                                        @endif >{{ $role->name }}
                                    </option>
                                @endforeach
                            @endisset
                        </select> 
                
                    </div>
                    <div class="form-group mb-0">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-sm btn-primary">
                                @lang('app.save')
                            </button>
                            <a href="{{ route('admin.show') }}" class="btn btn-danger btn-sm">@lang('app.close')</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection
