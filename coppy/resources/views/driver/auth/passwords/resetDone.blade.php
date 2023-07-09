<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ Config('app.name')}} | @lang('app.reset_password') </title>
    <link rel="icon" type="image/x-icon" href="{{asset('public/wtc_logo_gray.png')}}"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('public/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/css/users/login-1.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('public/fonts/font-ar.css')}}">
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

    <div class="form-login">
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <h5>@lang('app.reset_password')</h5>
            </div>
            @include('message')
            <br>
    
        </div>
    </div>
    
    <script src="{{ asset('public/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('public/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{ asset('public/bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>