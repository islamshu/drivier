<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>#{{ $order->order_id }} @lang('app.tracking')</title>
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} :: @lang('app.joinusasdriver') </title>
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
    <link href="{{ asset('public/assets/css/plugins.css?v=1')}}" rel="stylesheet" type="text/css" />
    
    @if (LaravelLocalization::getCurrentLocale() == 'ar')
    <style>
        body {
            font-family: 'Al-Jazeera-Arabic' ,  "Open Sans", sans-serif;
            font-weight: 600;
            font-style: normal;
            direction: rtl !important;
        }
    </style>
    @endif
    <style>
    #map {
        width: 100%;
        height: 300px;
    }
    #content {
        width: 100% !important;
    }
    .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    ul.timeline {
        list-style-type: none;
        position: relative;
        direction: rtl
    }
    ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        right: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
    }
    ul.timeline > li {
        margin: 20px 0;
        padding-right: 20px;
    }
    ul.timeline > li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #22c0e8;
        right: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
    }
</style>
</head>
<body>
    <div  id="content" class="main-content">
        <div class="container">
            @include('message')

            
            <div class="row">
                <div class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header text-center">
                            <h4>@lang('app.tracking')</h4>
                            <div class="row">
                                <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                    <h6>@lang('app.orderid') : {{ $order->order_id}} </h6>
                                    <h6>@lang('app.price') : {{ $order->cod_amount}} @lang('app.ras') </h6>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                    @isset($order->company->company_logo)
                                        @if ($order->company->company_logo)
                                            <img src="{{ url('/' . $order->company->company_logo) }}" alt="" width="70" height="70">
                                        @endif
                                    @endisset
                                    <h6> {{ $order->customer->branch_name }} </h6>
                                </div>                               
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                           <div class="row">
                               <div class="col-md-12">
                                    <div id="map"></div>
                               </div>
                           </div>
            
                           <div class="row">
                               <div class="col-md-3"></div>
                               <div class="col-md-6">
                                   <ul class="timeline">
                                       @isset($order->logs)
                                           @foreach ($order->logs as $log)
                                           <li>
                                                <a href="javascript:;">{{ LaravelLocalization::getCurrentLocale() == 'ar' ? $log->note_ar : $log->note_en }}</a>
                                                <a href="javascript:;" class="float-right">{{ Carbon\Carbon::createFromTimeStamp(strtotime($log->created_at))->diffForHumans() }}</a>
                                            </li>
                                           @endforeach
                                       @endisset
                                    </ul>
                               </div>
                               <div class="col-md-3"></div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
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
    
    
    <script>
        function initMap() {
    
            var lat =  {{ $order->driver->driver_lat ?? '24.6877300'}};
            var lng = {{ $order->driver->driver_lon ?? '46.7218500'}};
    
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: lat, lng: lng},
                zoom: 10
            });
            marker = new google.maps.Marker({
                position: {lat: lat, lng: lng},
                map: map,
            });
            
            google.maps.event.trigger(map, 'resize');

            map.setZoom(17);
        }
    </script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key={{ Config('app.map_key')}}&libraries=places&callback=initMap"
            async defer></script>
</body>
</html>
