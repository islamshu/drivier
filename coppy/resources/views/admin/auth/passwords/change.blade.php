@extends('admin.layouts.app') 

@section('title' , 'Change Password')

@section('content')

@if ($errors->count() > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
@endif


<form method="POST" action="{{ route('admin.password.change') }}" >
    @csrf
    <div class="form-group row">
        <label for="oldPassword" class="col-md-4 col-form-label text-md-right">Old Password</label>

        <div class="col-md-6">
            <input type="password" class="form-control{{ $errors->has('oldPassword') ? ' is-invalid' : '' }}" name="oldPassword" value="{{ $oldPassword ?? old('oldPassword') }}"
                required autofocus> @if ($errors->has('oldPassword'))
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('oldPassword') }}</strong>
                </span> @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                required> @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span> @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Change Password') }}
            </button>
        </div>
    </div>
</form>
@endsection