<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} :: @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{asset('public/wtc_logo_gray.png')}}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('public/fonts/font-ar.css')}}">
    @if (LaravelLocalization::getCurrentLocale() == 'ar')
        {{-- <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" > --}}
        <link rel="stylesheet" href="{{ asset('public/bootstrap/css/bootstrap-ar.min.css')}}">
    @else
        <link href="{{ asset('public/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    @endif
    @yield('header')
    <link href="{{ asset('public/assets/css/plugins.css?v=88')}}" rel="stylesheet" type="text/css" />
    <style>
        .navbar-brand {
            width: 7.5rem;
            overflow: visible !important;
        }
        .navbar-brand  .theme-logo{
            margin-top: 30px;
            height: auto;
        }
        #sidebar .navbar-brand .img-fluid {
            width: 90px;
            margin-top: 10px;
        }
        @media (max-width: 991px) {
            header.tabMobileView img {
                width: 90px;
                margin-right: 5px;
            }
        }

        .required {
            color: #f10 !important;
            font-size: 10px !important;
        }
       
    </style>

@if (LaravelLocalization::getCurrentLocale() == 'ar')
<style>
    body {
        font-family: 'Al-Jazeera-Arabic' ,  "Open Sans", sans-serif;
        font-weight: 600;
        font-style: normal;
        direction: rtl !important;
    }
    .breadcrumb > li+li:before {
        content: "\f192";
    }
    .navbar .navbar-nav .nav-item.user-profile-dropdown .dropdown-menu {
        left: 14px !important;
        right: -150px;
    }
    .page-title {
        float: right !important;
    }
    #sidebar .theme-brand li.theme-text a {
        font-size: 19px !important;
    }
    @media (min-width: 992px) {
        header.navbar {
            margin: 0 255px 0 0;
        }
    }
</style>
@endif

<style>
    body {
        font-family: 'Al-Jazeera-Arabic' ,  "Open Sans", sans-serif;
    }
</style>
</head>
<body class="default-sidebar">
    <!-- Tab Mobile View Header -->
    <header class="tabMobileView header navbar fixed-top d-lg-none">
        <div class="nav-toggle">
                <a href="javascript:void(0);" class="nav-link sidebarCollapse" data-placement="bottom">
                    <i class="flaticon-menu-line-2"></i>
                </a>
        </div>
        <ul class="nav navbar-nav">
            <li class="nav-item d-lg-none"> 
                <a href="{{ url(route('admin.dashboard'))}}" class=""> 
                    <img alt="logo"  src="{{ asset('public/wtc_logo_gray.png')}}" class="img-fluid">
                </a>
            </li>
        </ul>
    </header>
    <!-- Tab Mobile View Header -->

    <!--  BEGIN NAVBAR  -->
    <header class="header navbar fixed-top navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse d-none d-lg-block" data-placement="bottom"><i class="flaticon-menu-line-2"></i></a>
        <ul class="navbar-nav flex-row">
            <li class="nav-item dropdown language-dropdown ml-1  ml-lg-0">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="flagDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('public/assets/img/'.LaravelLocalization::getCurrentLocale().'.png') }}" alt=""> <span class="d-lg-inline-block d-none"></span>
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="flagDropdown">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a class="dropdown-item" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            <img src="{{ asset('public/assets/img/'.$localeCode.'.png') }}" class="flag-width" width="16" height="11" alt=""> 
                            &#xA0; {{ $properties['native'] }}
                        </a>
                    @endforeach
                    
                </div>
            </li>


            {{-- Admin Notification form AppServiceProvider  --}}
            <li class="nav-item dropdown notification-dropdown ml-3">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="flaticon-bell-4"></span>
                    <span class="badge badge-success" id="alertsCount">0</span>
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="notificationDropdown">
                    <a class="dropdown-item title" href="javascript:void(0);">
                        <i class="flaticon-bell-13 mr-3"></i> <span>@lang('app.notification')</span>
                    </a>

                    <div class="notificationlist">
                        
                    </div>
                    
                    <a href="{{ url(route('admin.notifications'))}}" class="footer dropdown-item text-center p-2">
                        <span class="mr-1">@lang('app.showall')</span>
                        <div class="btn btn-gradient-warning rounded-circle"><i class="flaticon-arrow-right flaticon-circle-p"></i></div>
                    </a>
                </div>
            </li>


        </ul>
        <ul class="navbar-nav flex-row ml-lg-auto">

            
            <li class="nav-item dropdown user-profile-dropdown ml-lg-0 mr-lg-2 ml-3 order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <small style="display: inline-block">
                        <p style="display: block; padding:0px;line-height:14px; margin:0px;font-size: 12px;font-weight:bold;">
                            {{ Auth::guard('admin')->user()->name }}
                        </p>
                        <p style="display: block; padding:0px;line-height:14px; margin:0px;font-size: 12px;font-weight:bold;">
                            @if (Auth::guard('admin')->user()->id != 1)
                            {{ Auth::guard('admin')->user()->city->name }}
                            @else
                            Super
                            @endif
                        </p>
                    </small>
                    <span class="flaticon-user-12"></span>
                </a>
                <div class="dropdown-menu  position-absolute" aria-labelledby="userProfileDropdown">
                    <a class="dropdown-item" href="{{ url(route('admin.profile'))}}">
                        <i class="mr-1 flaticon-user-6"></i> <span>@lang('app.profile')</span>    
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="mr-1 flaticon-power-button"></i> <span>@lang('app.logout')</span>
                    </a>
     
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </header>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>

        <!--  BEGIN SIDEBAR  -->

        <div class="sidebar-wrapper sidebar-theme">
            
            <div id="dismiss" class="d-lg-none"><i class="flaticon-cancel-12"></i></div>
            
            <nav id="sidebar">

                <ul class="navbar-nav">
                    <li class="nav-item d-flex">
                        <a href="{{ url(route('admin.dashboard'))}}" class="navbar-brand">
                            <img src="{{ asset('public/wtc_logo_gray.png')}}" class="theme-logo" width="150" alt="logo">
                        </a>
                    </li>
                </ul>

                <ul class="list-unstyled menu-categories">
                    <li class="menu">
                        <a href="{{ url(route('admin.dashboard'))}}" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-computer-6 ml-3"></i>
                                <span>@lang('app.dashboard')</span>
                            </div>
                        </a>
                    </li>


                    <li class="menu">
                        <a href="{{ url(route('admin.notifications'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-bell-9"></i>
                                <span>@lang('app.notification')</span>
                            </div>
                        </a>
                    </li>

                    @admin('orders' ,'super')
                    <li class="menu">
                        <a href="{{ url(route('orders.index'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-square-menu"></i>
                                <span>@lang('app.orders')</span>
                            </div>
                        </a>
                    </li>
                    @endadmin
                    @admin('orders' ,'super')
                    <li class="menu">
                        <a href="{{ url(route('admin.orders.requrireAttention'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-danger-2"></i>
                                <span>@lang('app.requrire_attention')</span>
                            </div>
                        </a>
                    </li>
                    @endadmin

                    @admin('orders' ,'super')
                    <li class="menu">
                        <a href="{{ url(route('admin.orders.supportRequest'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-email-3"></i>
                                <span>@lang('app.supportRequest')</span>
                            </div>
                        </a>
                    </li>
                    @endadmin

                    @admin('orders' ,'super')
                    <li class="menu">
                        <a href="{{ url(route('admin.map'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-map"></i>
                                <span>@lang('app.map')</span>
                            </div>
                        </a>
                    </li>
                    @endadmin

                    @admin('manage_stores','super')
                    <li class="menu">
                        <a href="{{ url(route('companies.index'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-home-square"></i>
                                <span>@lang('app.companies')</span>
                            </div>
                        </a>
                    </li>
                    @endadmin
                    
                    @admin('manage_stores','super')
                    <li class="menu">
                        <a href="{{ url(route('customer.index'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-user-group"></i>
                                <span>@lang('app.branches')</span>
                            </div>
                        </a>
                    </li>
                    @endadmin

                    @admin('vehicles','super')
                    <li class="menu">
                        <a href="{{ url(route('vehicles.index'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-fill-car"></i>
                                <span>@lang('app.vehicles')</span>
                            </div>
                        </a>
                    </li>
                    @endadmin

                    @admin('drivers','super')
                    <li class="menu">
                        <a href="{{ url(route('drivers.index'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-fill-car"></i>
                                <span>@lang('app.drivers')</span>
                            </div>
                        </a>
                    </li>
                    @endadmin

                    @admin('super')
                    <li class="menu">
                        <a href="{{ url(route('payments.index'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-dollar-coin"></i>
                                <span>@lang('app.allpayments')</span>
                            </div>
                        </a>
                    </li>
                    @endadmin
                    @admin('super')
                    <li class="menu">
                        <a href="{{ url(route('sendsms.index'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-email-3"></i>
                                <span>@lang('app.send_sms')</span>
                            </div>
                        </a>
                    </li>
                    @endadmin
                    @admin('manage_cities','super')
                    <li class="menu">
                        <a href="{{ url(route('cities.index'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-building-1"></i>
                                <span>@lang('app.cities')</span>
                            </div>
                        </a>
                    </li>
                    @endadmin

                    @if (Auth::guard('admin')->user()->id == 1)
                    @admin('super')
                    <li class="menu">
                        <a href="{{ url(route('admin.show'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-user-group"></i>
                                <span>@lang('app.admin_list')</span>
                            </div>
                        </a>
                    </li>
                    @endadmin

                    @admin('super')
                    <li class="menu">
                        <a href="{{ url(route('admin.roles'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-menu-4"></i>
                                <span>@lang('app.roles')</span>
                            </div>
                        </a>
                    </li>
                    @endadmin

                    @admin('super')
                    <li class="menu">
                        <a href="{{ url(route('reportpercity.index'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-location-line"></i>
                                <span>@lang('app.reportpercity')</span>
                            </div>
                        </a>
                    </li>
                    @endadmin
                    @endif
                    

                    @admin('super')
                    <li class="menu">
                        <a href="#ratings" data-toggle="collapse" aria-expanded="{{ Request::is('*/admin/ratings/*') ? 'true' : 'false'}}" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-stats"></i>
                                <span>@lang('app.ratings')</span>
                            </div>
                            <div>
                                <i class="flaticon-left-arrow"></i>
                            </div>
                        </a>
                        <!-- class "show" -->
                        <ul class="collapse submenu list-unstyled {{ Request::is('*/admin/ratings/*') ? 'show' : ''}}" id="ratings" data-parent="#ratings">
                            <li class="{{ Request::is('*/admin/reports/orders') ? 'active' : ''}}">
                                <a href="{{ url(route('questionair.index'))}}"> @lang('app.questions') </a>
                            </li>
                            {{-- <li class="{{ Request::is('*/admin/reports/clients') ? 'active' : ''}}">
                                <a href="{{ url(route('clients.index'))}}"> @lang('app.ratings')</a>
                            </li> --}}
                        </ul>
                    </li>
                    @endadmin

                    @admin('accounting','super')
                    <li class="menu">
                        <a href="#reports" data-toggle="collapse" aria-expanded="{{ Request::is('admin/reports/*') ? 'true' : 'false'}}" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-stats"></i>
                                <span>@lang('app.reports')</span>
                            </div>
                            <div>
                                <i class="flaticon-left-arrow"></i>
                            </div>
                        </a>
                        <!-- class "show" -->
                        <ul class="collapse submenu list-unstyled {{ Request::is('*/admin/reports/*') ? 'show' : ''}}" id="reports" data-parent="#reports">
                            <li class="{{ Request::is('*/admin/reports/orders') ? 'active' : ''}}">
                                <a href="{{ url(route('report.orders.index'))}}"> @lang('app.orders') </a>
                            </li>
                            <li class="{{ Request::is('*/admin/reports/payments') ? 'active' : ''}}">
                                <a href="{{ url(route('report.payments.index'))}}"> @lang('app.payments') </a>
                            </li>
                            <li class="{{ Request::is('*/admin/reports/companies') ? 'active' : ''}}">
                                <a href="{{ url(route('report.companies.index'))}}"> @lang('app.companies') </a>
                            </li>
                            <li class="{{ Request::is('*/admin/reports/orders_by_company') ? 'active' : ''}}">
                                <a href="{{ url(route('report.orders_by_company.index'))}}"> @lang('app.orders_by_company') </a>
                            </li>
                            <li class="{{ Request::is('*/admin/reports/orders_by_driver') ? 'active' : ''}}">
                                <a href="{{ url(route('report.orders_by_driver.index'))}}"> @lang('app.orders_by_driver') </a>
                            </li>
                        </ul>
                    </li>
                    @endadmin
                </ul>
            </nav>

        </div>

        <!--  END SIDEBAR  -->
        
        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="container">
                <div class="page-header">
                    <div class="page-title">
                        <div class="page-title">
                            <div class="crumbs">
                                <ul id="breadcrumbs" class="breadcrumb">
                                    <li><a href="{{ url(route('admin.dashboard'))}}"><i class="flaticon-home-fill"></i></a></li>
                                    <li class="active"><a href="#">@yield('title')</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                @yield('content')

            </div>
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!--  BEGIN FOOTER  -->
    <footer class="footer-section theme-footer">

        <div class="footer-section-1  sidebar-theme">
            
        </div>

        <div class="footer-section-2 container-fluid">
            <div class="row">
                <div id="toggle-grid" class="col-xl-12 col-md-6 col-sm-6 col-12 text-sm-left text-center">
                    <ul class="list-inline links ml-sm-5">
                        <li class="list-inline-item mr-3">
                            <p class="bottom-footer"> {{ Config('app.name')}} &copy; 2020 </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!--  END FOOTER  -->


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('public/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('public/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{ asset('public/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('public/plugins/scrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/app.js')}}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });

        // function clearSystemData() {
            
        //     var r = confirm("Are You Sure ?");
            
        //     if (r == true) {
        //         window.location.href = "#";
        //     }
        // }
        
    </script>


    <script>

        // setInterval(refreshToken, 3600000); // 1 hour

        // function refreshToken(){
        //     $.get('refresh-csrf').done(function(data){
        //         csrfToken = data; // the new token
        //     });
        // }

        // Route::get('refresh-csrf', function(){
        //     return csrf_token();
        // });


        $(function() {
            $(document).on('click' , '#notificationDropdown' , function(e) {
                e.preventDefault();

                // alert('Yes');

                var base_url = '{{ url('admin/makeNotificationRead') }}' + '/' + {{ Auth::guard('admin')->user()->city_id }};

                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'get',
                    url: base_url,
                    dataType: "json",
                    data: {
                        _token: CSRF_TOKEN,
                    },
                    success: function(data) {
                        $('#alertsCount').text(0);
                    }
                });
            });



            setInterval(() => {
                var alerts_url = '{{ url('admin/getUnreadNotification') }}' + '/' + 1;
                var csrftoken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'get',
                    url: alerts_url,
                    dataType: "json",
                    cache: false,
                    data: {
                        _token: csrftoken,
                    },
                    success: function(data) {
                        if (data.count != 0) {
                            
                            $notify = "{{ asset('public/sound/notifyy.mp3')}}";
                            var audioElement = document.createElement('audio');
                            audioElement.setAttribute('src', $notify);

                            $('.notificationlist').empty();
                            data.notifications.forEach(notifications => {
                                var str = notifications.message.substring(0,40);
                                var text = '<a class="dropdown-item text-center  p-1" href="javascript:void(0);">' +
                                    '<div class="notification-list ">'+
                                        '<div class="notification-item position-relative  mb-3">'+                                    
                                            '<span class="mb-1">'+ str + '</span>'+
                                        '</div>'+
                                    '</div>'+
                                '</a>';

                                $('.notificationlist').append(text);

                            });


                            audioElement.play();
                            $('#alertsCount').text(data.count);
                            
                        }

                        console.log(data);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });

            }, 10000);
        });
    </script>
    
    @stack('script')
    
    </body>
</html>