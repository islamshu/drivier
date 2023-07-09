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

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('public/fonts/font-ar.css')}}">

    @if (LaravelLocalization::getCurrentLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('public/bootstrap/css/bootstrap-ar.min.css')}}">
    @else
        <link href="{{ asset('public/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    @endif
    
    @yield('header')
    <link href="{{ asset('public/assets/css/plugins.css?v=1')}}" rel="stylesheet" type="text/css" />
 

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('public/plugins/maps/vector/jvector/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/css/default-dashboard/style.css')}}" rel="stylesheet" type="text/css" />    
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->   
    <style>
        .navbar-brand {
            width: 7.5rem;
        }
        #sidebar .navbar-brand .img-fluid {
            width: 90px;
            margin-top: 10px;
        }
        body {
            font-family: 'Al-Jazeera-Arabic' , 'Open Sans'; 
        }
        @media (max-width: 991px) {
            header.tabMobileView img {
                width: 90px;
                margin-right: 5px;
            }
        }
    </style>
    @if (LaravelLocalization::getCurrentLocale() == 'ar')
        <style>
            body {
                font-family: 'Al-Jazeera-Arabic' , 'Open Sans';
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
            @media (min-width: 992px) {
                header.navbar {
                    margin: 0 255px 0 0;
                }
            }
        </style>
    @endif

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
            <li></li>
        </ul>
        <ul class="navbar-nav flex-row ml-lg-auto">
            <li class="nav-item dropdown user-profile-dropdown ml-lg-0 mr-lg-2 ml-3 order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <small style="display: inline-block">
                        <p style="display: block; padding:0px;line-height:14px; margin:0px;font-size: 12px;font-weight:bold;">
                            {{ Auth::guard('customer')->user()->name }} - {{ Auth::guard('customer')->user()->branch_name }}
                        </p>
                        <p style="display: block; padding:0px;line-height:14px; margin:0px;font-size: 12px;font-weight:bold;">
                            {{ Auth::guard('customer')->user()->city->name}}
                        </p>
                    </small>
                    <span class="flaticon-user-12"></span>
                </a>
                <div class="dropdown-menu  position-absolute" aria-labelledby="userProfileDropdown">
                    <a class="dropdown-item" href="{{ url(route('customer.profile'))}}">
                        <i class="mr-1 flaticon-user-6"></i> <span>@lang('app.profile')</span>    
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('customer.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="mr-1 flaticon-power-button"></i> <span>@lang('app.logout')</span>
                    </a>
     
                    <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
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

                <ul class="navbar-nav theme-brand align-items-center">
                    <li class="nav-item d-flex align-items-center">
                        @isset($logo)
                            @if ($logo)
                                <a href="{{ url(route('customer.dashboard'))}}" class="navbar-brand">
                                    <img src="{{ url('/'. $logo)}}" class="img-fluid" alt="logo">
                                </a>
                            @endif
                        @endisset
                    </li>
                    {{-- <li class="nav-item theme-text text-center">
                        <a href="{{ url(route('customer.dashboard'))}}" class="nav-link"> BeeWex </a>
                    </li> --}}
                </ul>

                <ul class="list-unstyled menu-categories">
                    
                    <li class="menu">
                        <a href="{{ url(route('customer.dashboard'))}}" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-computer-6 ml-3"></i>
                                <span>@lang('app.dashboard')</span>
                            </div>
                        </a>
                    </li>

                    @customer('branch','super')
                    <li class="menu">
                        <a href="{{ url(route('order.index')) }}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-primary"></i>
                                <span>@lang('app.orders')</span>
                            </div>
                        </a>
                    </li>
                    @endcustomer

                    @customer('branch','super')
                    <li class="menu">
                        <a href="{{ url(route('order.create'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-square-plus"></i>
                                <span>@lang('app.createorder')</span>
                            </div>
                        </a>
                    </li>
                    @endcustomer

                    @customer('branch','super')
                    <li class="menu">
                        <a href="{{ url(route('customer.payment.index'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-dollar-coin"></i>
                                <span>@lang('app.transactions')</span>
                            </div>
                        </a>
                    </li>
                    @endcustomer

                    @customer('branch','super')
                    <li class="menu">
                        <a href="{{ url(route('customer.payment.gateway'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-credit-card"></i>
                                <span>@lang('app.addBalance')</span>
                            </div>
                        </a>
                    </li>
                    @endcustomer
                    
                    {{-- @customer('branch','super')
                    <li class="menu">
                        <a href="{{ url(route('customer.map'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-map"></i>
                                <span>@lang('app.map')</span>
                            </div>
                        </a>
                    </li>
                    @endcustomer --}}

                    @customer('super')
                    <li class="menu">
                        <a href="{{ url(route('company.index'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-computer-6"></i>
                                <span>@lang('app.company')</span>
                            </div>
                        </a>
                    </li>
                    @endcustomer

                    @customer('super')
                    <li class="menu">
                        <a href="{{ url(route('users.customer.index'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-user-group"></i>
                                <span>@lang('app.branches')</span>
                            </div>
                        </a>
                    </li>
                    @endcustomer

                    @customer('super')
                    <li class="menu">
                        <a href="{{ url(route('customer.roles'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-menu-4"></i>
                                <span>@lang('app.roles')</span>
                            </div>
                        </a>
                    </li>
                    @endcustomer


                    @customer('branch','super')
                    <li class="menu">
                        <a href="#reports" data-toggle="collapse" aria-expanded="{{ Request::is('admin/reports/*') ? 'true' : 'false'}}" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-stats"></i>
                                <span>@lang('app.reports')</span>
                            </div>
                            <div>
                                <i class="flaticon-right-arrow"></i>
                            </div>
                        </a>
                        <!-- class "show" -->
                        <ul class="collapse submenu list-unstyled {{ Request::is('*/customer/reports/*') ? 'show' : ''}}" id="reports" data-parent="#reports">
                            <li>
                                <a href="{{ url(route('customer.report.payments'))}}"> @lang('app.payments') </a>
                            </li>
                        </ul>
                    </li>
                    @endcustomer

                    <li class="menu">
                        <a href="{{ url(route('customer.profile'))}}"  aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="flaticon-user-fill"></i>
                                {{-- <i class="flaticon-menu-4"></i> --}}
                                <span>@lang('app.profile')</span>
                            </div>
                        </a>
                    </li>
                    
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
                                    <li><a href="{{ url(route('customer.dashboard'))}}"><i class="flaticon-home-fill"></i></a></li>
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
    </script>
    <script src="{{ asset('public/assets/js/custom.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
  
    
    <script src="{{ asset('public/assets/js/default-dashboard/default-custom.js')}}"></script>

    @stack('script')
    
    </body>
</html>