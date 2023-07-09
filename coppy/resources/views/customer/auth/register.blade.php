<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ Config('app.name')}} | @lang('app.registernow') </title>
    
    <link rel="icon" type="image/x-icon" href="{{asset('public/wtc_logo_gray.png')}}"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('public/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/css/users/register-2.css?v=3')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('public/fonts/font-ar.css')}}">
    @if (LaravelLocalization::getCurrentLocale() == 'ar')
    <style>
        body {
            font-family: 'Al-Jazeera-Arabic';
            font-weight: 600;
            font-style: normal;
            direction: rtl !important;
        }
        .form-register .input-group .input-group-prepend .input-group-text {
            border-bottom-left-radius: 0px;
            border-top-left-radius: 0px;
            border-bottom-right-radius: 30px;
            border-top-right-radius: 30px;
        }
        .form-register .input-group .form-control {
            border-bottom-right-radius: 0px;
            border-top-right-radius: 0px;
            border-bottom-left-radius: 30px;
            border-top-left-radius: 30px;
            padding: 12px 0px 12px 45px;
        }
        .form-register .input-group select.form-control {
            border-bottom-right-radius: 30px;
            border-top-right-radius: 30px;
            border-bottom-left-radius: 30px;
            border-top-left-radius: 30px;
            padding: 12px;
        }
        option {
            color: #000;
        }
    </style>
    @else
    <style>
        body {
            font-family: 'Al-Jazeera-Arabic' , sans-serif;
        }
    </style>
    @endif
    <style>
        .form-register .input-group .selected {
            color: #000;
        }
    </style>
</head>
<body class="register">
    <form class="form-register" action="{{ url(route('company.signup'))}}" method="POST">
        @csrf
        
        <div class="form-group text-center">
             @if (LaravelLocalization::getCurrentLocale() == 'en')
                <a class="btn btn-classic btn-default mb-4 mr-2" hreflang="ar" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">العربية </a>
            @else 
                <a class="btn btn-classic btn-default mb-4 mr-2" hreflang="en" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">English </a>
            @endif
        </div>
        
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <img alt="logo" width="200" height="150" src="{{ asset('public/wtc_logo_gray.png')}}" class="theme-logo img-fluid">
            </div>
            @include('message')
            <br>

            <div class="col-md-12">

                <label for="company_name" class="sr-only">@lang('app.storename')</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="icon-username"><i class="flaticon-user-7"></i> </span>
                    </div>
                    <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" class="form-control" placeholder="@lang('app.storename')" required  autofocus>
                </div>

                <label for="name" class="sr-only">@lang('app.fullname')</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="icon-name"><i class="flaticon-user-7"></i> </span>
                    </div>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="@lang('app.fullname')" required >
                </div>
                
                {{-- <div class="input-group mb-3">
                    <select name="company_type" class="form-control">
                        <option value="0">@lang('app.goods_deliverey')</option>
                        <option value="1">@lang('app.fast_deliverey')</option>
                    </select>
                </div> --}}

                <div class="input-group mb-3">
                    <select name="city_id" class="form-control selected" id="city_id">
                        @isset($cities)
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>

                <label for="address" class="sr-only">@lang('app.address')</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="icon-address"><i class="flaticon-home-line"></i> </span>
                    </div>
                    <input type="text" id="address" class="form-control" name="address" value="{{ old('address') }}" placeholder="@lang('app.address')" aria-describedby="address" required >
                </div>

                <label for="telephone" class="sr-only">@lang('app.phone')</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="icon-telephone"><i class="flaticon-telephone"></i> </span>
                    </div>
                    <input type="text" id="telephone" class="form-control" name="company_phone" value="{{ old('company_phone') }}" placeholder="@lang('app.phone')" aria-describedby="telephone" required >
                </div>

                <label for="email" class="sr-only">@lang('app.email')</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="icon-email"><i class="flaticon-email-fill-2"></i> </span>
                    </div>
                    <input type="email" id="email" name="email"  value="{{ old('email') }}" class="form-control" placeholder="@lang('app.email')" aria-describedby="inputEmail" required >
                </div>
                
                <label for="inputPassword" class="sr-only">@lang('app.password')</label>
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="icon-inputPassword"><i class="flaticon-key-2"></i> </span>
                    </div>
                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="@lang('app.password')" aria-describedby="inputPassword" required >
                </div>
                
                <label for="inputRepeatPassword" class="sr-only">@lang('app.repassword')</label>
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="icon-inputRepeatPassword"><i class="flaticon-key-2"></i> </span>
                    </div>
                    <input type="password" id="inputRepeatPassword" class="form-control" name="password_confirmation" placeholder="@lang('app.repassword')" aria-describedby="inputRepeatPassword" required >
                </div>

                <button class="btn btn-lg btn-warning btn-block mb-4 mt-2" type="submit">@lang('app.register')</button>
                <a href="{{ url(route('customer.login'))}}" class="btn btn-lg btn-default btn-block mb-3">@lang('app.login')</a>
            </div>

        </div>
    </form>
    
    <script src="{{ asset('public/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('public/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{ asset('public/bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>