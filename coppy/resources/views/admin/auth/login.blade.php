<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ Config('app.name')}} | Admin Login </title>
    <link rel="icon" type="image/x-icon" href="{{asset('public/wtc_logo_gray.png')}}"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('public/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/css/users/login-2.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('public/fonts/font-ar.css')}}">
    @if (LaravelLocalization::getCurrentLocale() == 'ar')
    <style>
        body {
            font-family: 'Al-Jazeera-Arabic';
            font-weight: 600;
            font-style: normal;
            direction: rtl !important;
        }
        .form-login .input-group .input-group-prepend .input-group-text {
            border-bottom-left-radius: 0px;
            border-top-left-radius: 0px;
            border-bottom-right-radius: 30px;
            border-top-right-radius: 30px;
        }
        .form-login .input-group .form-control {
            border-bottom-right-radius: 0px;
            border-top-right-radius: 0px;
            border-bottom-left-radius: 30px;
            border-top-left-radius: 30px;
            padding: 12px 0px 12px 45px;
        }
    </style>
    @else
    <style>
        body {
            font-family: 'Al-Jazeera-Arabic' , sans-serif;
        }
    </style>
    @endif
    
</head>
<body class="login">

    <form class="form-login" action="{{ route('admin.login') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <img alt="logo" width="200" height="150" src="{{ asset('public/wtc_logo_gray.png')}}" class="theme-logo img-fluid">
            </div>
            @include('message')
            <br>
            <div class="col-md-12">
                <label for="inputEmail" class="sr-only">@lang('app.email')</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="icon-inputEmail"><i class="flaticon-user-7"></i> </span>
                    </div>
                    <input type="email" id="inputEmail" class="form-control" value="{{ old('email') }}" name="email" placeholder="@lang('app.email')" aria-describedby="inputEmail" required >
                </div>

                <label for="inputPassword" class="sr-only">@lang('app.password')</label>                
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="icon-inputPassword"><i class="flaticon-key-2"></i> </span>
                    </div>
                    <input type="password" id="inputPassword" class="form-control" placeholder="@lang('app.password')" name="password" aria-describedby="inputPassword" required >
                </div>
                <div class="checkbox  justify-content-center text-center mb-4 mt-3">
                    <div class="forgot-pass">
                        <a href="{{ url(route('admin.password.request'))}}">@lang('app.forgot_password')</a>
                    </div>
                </div>                
                <button class="btn btn-lg btn-warning btn-block mb-4 mt-5" type="submit">@lang('app.login')</button>
                {{-- <a href="user_register_1.html" class="btn btn-lg btn-outline-dark btn-block btn-rounded mb-3">Register</a> --}}
                <br>
                <div class="copyright text-center"> 2020 © {{ Config('app.name')}}.</div>
            </div>
        </div>
    </form>
    
    
    <script src="{{ asset('public/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('public/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{ asset('public/bootstrap/js/bootstrap.min.js')}}"></script>
    
</body>
</html>