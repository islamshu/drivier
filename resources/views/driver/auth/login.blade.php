<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ Config('app.name')}} | Driver Login </title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('fonts/font-ar.css')}}">
    <link href="{{ asset('assets/css/users/login-1.css')}}" rel="stylesheet" type="text/css" />
    <style>
        body {
            background-image: none;
            background-color: #fafafa;
        }
    </style>
    @if (LaravelLocalization::getCurrentLocale() == 'ar')
    <style>
        body {
            font-family: 'Al-Jazeera-Arabic';
            font-weight: 600;
            font-style: normal;
            direction: rtl !important;
        }
        .form-login label {
            float: right
        }
    </style>
    @endif
    
    
</head>
<body class="login">

    <form class="form-login" action="{{ route('driver.login') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <h3>تسجيل دخول السائق</h3>
            </div>
            @include('message')
            <br>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="inputEmail">@lang('app.email')</label>                
                    <input type="email" id="inputEmail" class="form-control mb-4" name="email" placeholder="Login" required >   
                </div>                
                <div class="form-group">
                    <label for="inputPassword">@lang('app.password')</label>                
                    <input type="password" id="inputPassword" class="form-control mb-5" name="password" placeholder="Password" required>    
                </div>                
                <div class="checkbox d-flex justify-content-between mb-4 mt-3">
                    {{-- <div class="custom-control custom-checkbox mr-3">
                        <input type="checkbox" class="custom-control-input" id="customCheck1" value="remember-me">
                        <label class="custom-control-label" for="customCheck1">Remember</label>
                    </div>
                    <div class="forgot-pass">
                        <a href="user_pass_recovery_1.html">Forgot Password?</a>
                    </div> --}}
                </div>                
                <button class="btn btn-lg btn-gradient-success btn-block btn-rounded mb-4 mt-5" type="submit">@lang('app.login')</button>
                <br>
                <div class="copyright text-center"> 2020 © {{ Config('app.name')}}.</div>
            </div>
        </div>
    </form>
    
    
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
    
</body>
</html>