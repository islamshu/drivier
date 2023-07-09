@extends('admin.layouts.app') 

@section('title')
    @isset($order)
        @lang('app.order') #{{$order->order_id}}
    @endisset
@endsection
@section('header')
{{-- <link href="{{ asset('public/assets/css/components/portlets/portlet.css')}}" rel="stylesheet" type="text/css" /> --}}
<link href="{{ asset('public/assets/css/ui-kit/tabs-accordian/custom-tabs.css')}}" rel="stylesheet" type="text/css" />
<style>
    #map {
        width: 100%;s
        height: 400px;
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

    #searchInput {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 50%;
    }

    #searchInput:focus {
        border-color: #4d90fe;
    }
</style>
@endsection

@section('content')
@include('message')
<div class="widget portlet-widget">
    <div class="widget-content widget-content-area">
        <div class="portlet portlet-danger">
            <div class="portlet-title portlet-danger  d-flex justify-content-between">
                <div class="caption  align-self-center">
                    {{-- <span class="caption-subject text-uppercase white"> @lang('app.orderid') #{{$order->order_id}}</span> --}}

                    <ul class="nav nav-pills mb-3 mt-3 nav-fill" id="justify-pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="justify-pills-home-tab" data-toggle="pill" href="#justify-pills-home" role="tab" aria-controls="justify-pills-home" aria-selected="true">@lang('app.order_details')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="justify-pills-profile-tab" data-toggle="pill" href="#justify-pills-profile" role="tab" aria-controls="justify-pills-profile" aria-selected="false">@lang('app.order_status')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="justify-pills-contact-tab" data-toggle="pill" href="#justify-pills-contact" role="tab" aria-controls="justify-pills-contact" aria-selected="false">@lang('app.map')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="justify-pills-ratings-tab" data-toggle="pill" href="#justify-pills-ratings" role="tab" aria-controls="justify-pills-ratings" aria-selected="false">@lang('app.ratings')</a>
                        </li>
                    </ul>
                </div>
                <div class="actions  align-self-center">
                    <div class="btn-group">
                        <a href="{{ url(route('admin.order.pdf' , [ $order->id , 'order_id' => $order->order_id])) }}" class="btn btn-rounded btn-primary">@lang('app.awb')</a> 
                    </div>
                    @if ($order->status != 'canceled')
                        <button class="btn btn-rounded btn-danger" data-toggle="modal" data-target="#cancelOrder">
                            @lang('app.cancelOrder')
                        </button>
                    @else
                        <button class="btn btn-rounded btn-danger" type="button" disabled>
                            @lang('app.cancelOrder')
                        </button>
                    @endif
                </div>
            </div>
            <div class="portlet-body portlet-common-body">

                <div class="tab-content" id="justify-pills-tabContent">
                    <div class="tab-pane fade show active" id="justify-pills-home" role="tabpanel" aria-labelledby="justify-pills-home-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-uppercase">@lang('app.company')<p>
                                <p class="text-muted">
                                    @isset($order)
                                        {{ $order->company->company_name }}
                                    @endisset
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-uppercase">@lang('app.date')<p>
                                <p class="text-muted">
                                    @isset($order)
                                        {{ $order->created_at->format('Y/m/d h:i') }}
                                        /
                                        {{ \Carbon\Carbon::createFromTimeStamp(strtotime($order->created_at))->diffForHumans() }}
                                    @endisset
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">@lang('app.pickup_details')</small>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">@lang('app.dropoff_details')</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                    <p class="text-uppercase">@lang('app.pickup_location')<p>
                                    <p class="text-muted">
                                        @isset($order)
                                             {{$order->company->city->name }} , 
                                            {{$order->company->company_address }}
                                         @endisset
                                    </p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-uppercase">@lang('app.dropoff_location')<p>
                                <p class="text-muted">
                                    @isset($order)
                                        {{ $order->city->name . ', ' . $order->region }}
                                    @endisset
                                </p>
                            </div>
                        </div>
                     
                     
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-uppercase">@lang('app.sender_name')<p>
                                <p class="text-muted">
                                    @isset($order)
                                        {{$order->company->company_name}}
                                    @endisset
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-uppercase">@lang('app.recipient_name')<p>
                                <p class="text-muted">
                                    @isset($order)
                                        {{$order->name }}
                                    @endisset
                                </p>
                            </div>
                        </div>
                     
                     
                        <div class="row">
                            <div class="col-md-6">
                                    <p class="text-uppercase">@lang('app.sender_phone')<p>
                                    <p class="text-muted">
                                        @isset($order)
                                            {{$order->company->company_phone}}
                                        @endisset
                                    </p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-uppercase">@lang('app.recipient_phone')<p>
                                <p class="text-muted">
                                    @isset($order)
                                            {{$order->phone }}
                                    @endisset
                                </p>
                            </div>
                        </div>
                    
                        <hr>
                        
                        <small class="text-muted">@lang('app.driver')</small>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-uppercase">@lang('app.name') @lang('app.driver')<p>
                                <p class="text-primary">
                                    @if ($order->driver)
                                        <a class="text-primary" href="{{ url(route('drivers.show' , [$order->driver->id]))}}" >
                                            {{ $order->driver->fname . ' ' . $order->driver->lname }}
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-uppercase">@lang('app.phone') @lang('app.driver')<p>
                                <p class="text-muted">
                                  @if ($order->driver)
                                    {{ $order->driver->phone }}
                                  @else
                                    N/A  
                                  @endif
                                </p>
                            </div>
                        </div>
                    
                        <hr>
                        
                        <small class="text-muted">@lang('app.driver')</small>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-uppercase">@lang('app.name') @lang('app.driver')<p>
                                <p class="text-primary">
                                    @if ($order->status == 'unassigned')
                                        <span class="badge badge-dark"> {{ trans('app.unassigned')}} </span>
                                    @elseif ($order->status == 'assign_to_driver') 
                                        <span class="badge badge-dark"> {{ trans('app.assign_to_driver')}} </span>
                                    @elseif ($order->status == 'to_be_delivered') 
                                        <span class="badge badge-dark"> {{ trans('app.to_be_delivered')}} </span>
                                    @elseif ($order->status == 'rescheduled') 
                                        <span class="badge badge-dark"> {{ trans('app.rescheduled')}} </span>
                                    @elseif ($order->status == 'car_damage') 
                                        <span class="badge badge-dark"> {{ trans('app.car_damage')}} </span>
                                    @elseif ($order->status == 'delivered') 
                                        <span class="badge badge-dark"> {{ trans('app.delivered')}} </span>
                                    @elseif ($order->status == 'canceled') 
                                        <span class="badge badge-danger"> {{ trans('app.canceled')}}</span> {{ $order->canceled_after}}
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                @if ($order->type == 0) 
                                    <p class="text-uppercase">@lang('app.security_code')<p>
                                    <p class="text-muted">
                                        {{ $order->security_code }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>@lang('app.box_count') </h3>
                                <h3>{{$order->box_count }} </h3>
                            </div>
                            <div class="col-md-6">
                                <h3>@lang('app.cod_amount') </h3>
                                <h3>{{$order->cod_amount . '.00 '  }} @lang('app.ras') </h3>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="justify-pills-profile" role="tabpanel" aria-labelledby="justify-pills-profile-tab">
                       @if($order->logs->count() != 0)
                           @foreach ($order->logs as $log)
                               <div class="alert alert-default"> 
                                   {{ $log->note_en}} <br>
                                   {{ $log->note_ar}} <br>
                                   <span class="text-dark">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($log->created_at))->diffForHumans()}}</span>
                             </div>
                           @endforeach
                        @else
                        <div class="alert alert-default">
                            لا يوجد نشاطات على هذه الطلب بعد
                        </div>
                       @endisset
                    </div>
                    <div class="tab-pane fade" id="justify-pills-contact" role="tabpanel" aria-labelledby="justify-pills-contact-tab">
                        
                        <p>{{ $order->approx_km }} @lang('app.km')</p>
                       <div class="row">
                            <div class="col-md-12">
                                <div id="map"></div>
                            </div>
                       </div>
                    </div>
                    <div class="tab-pane fade" id="justify-pills-ratings" role="tabpanel" aria-labelledby="justify-pills-ratings-tab">
                        @if($order->ratings->count() != 0)
                            @foreach ($order->ratings as $item)
                                                            
                                <h4 class="mt-4">{{ $item->question->question_ar }}</h4>

                                @if ($item->rating == 1)
                                    <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                    <span class="flaticon-star-full" style="font-size:20px"></span>
                                    <span class="flaticon-star-full" style="font-size:20px"></span>
                                    <span class="flaticon-star-full" style="font-size:20px"></span>
                                    <span class="flaticon-star-full" style="font-size:20px"></span>
                                @elseif($item->rating == 2)
                                    <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                    <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                    <span class="flaticon-star-full" style="font-size:20px"></span>
                                    <span class="flaticon-star-full" style="font-size:20px"></span>
                                    <span class="flaticon-star-full" style="font-size:20px"></span>
                                @elseif($item->rating == 3)
                                    <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                    <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                    <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                    <span class="flaticon-star-full" style="font-size:20px"></span>
                                    <span class="flaticon-star-full" style="font-size:20px"></span>
                                @elseif($item->rating == 4)
                                    <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                    <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                    <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                    <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                    <span class="flaticon-star-full" style="font-size:20px"></span>
                                @elseif($item->rating == 5)
                                    <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                    <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                    <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                    <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                    <span class="flaticon-star-full" style="color:#FFC55A;font-size:20px"></span>
                                @endif
                                <br>
                            @endforeach
                        @else 
                        <div class="alert alert-default">
                            لم يقم العميل بالتقييم بعد
                        </div>
                        @endif
                     </div>
                </div>
                
            </div>
        </div>
    </div>
</div>





<!-- cancelOrder -->
<div class="modal fade" id="cancelOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form  action="{{ url(route('admin.status.cancelOrder' , [$order->id]))}}" method="POST">
            @csrf
            <div class="modal-body">
                <h3>@lang('app.cancelOrder')</h3>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('app.close')</button>
              <button type="submit" class="btn btn-primary">@lang('app.cancelOrder')</button>
            </div>
        </form>
      </div>
    </div>
</div>


@endsection


@push('script')
<script>

        function initMap() {
            
            var infowindow = new google.maps.InfoWindow();
            
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng({{ $order->to_lat }}, {{ $order->to_long }}),
                map: map,
                icon: {
                    url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
                }
            });
        
            var sender_lat = "{{ $order->from_lat  }}"; // ;
            var sender_long = "{{ $order->from_long }}";
            var customer_lat = "{{ $order->to_lat}}";
            var customer_long = "{{ $order->to_long }}"; 
          

            var directionsDisplay = new google.maps.DirectionsRenderer();
            var directionsService = new google.maps.DirectionsService();
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 24.6877300, lng: 46.7218500},
                zoom: 5
            });

            directionsDisplay.setMap(map);

            // google.maps.event.addListener(map, 'tilesloaded', function() {
            //     // Visible tiles loaded!
            // });
            // google.maps.event.addListener(map, 'idle', calcRoute);
            google.maps.event.addDomListener(window, 'load', calcRoute);

            // google.maps.event.addDomListener(document.getElementById('mapshowbutton'), 'click',calcRoute);

            
            function calcRoute() {
                var start = new google.maps.LatLng(sender_lat, sender_long);
                var end = new google.maps.LatLng(customer_lat, customer_long);

                var startMarker = new google.maps.Marker({
                        position: start,
                        map: map,
                        draggable: true
                    });
                    var endMarker = new google.maps.Marker({
                        position: end,
                        map: map,
                        draggable: true
                    });

                    
                var bounds = new google.maps.LatLngBounds();
                bounds.extend(start);
                bounds.extend(end);
                map.fitBounds(bounds);
                var request = {
                    origin: start,
                    destination: end,
                    travelMode: google.maps.TravelMode.DRIVING
                };
                directionsService.route(request, function (response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(response);
                        directionsDisplay.setMap(map);
                    } else {
                        // alert("Directions Request from " + start.toUrlValue(6) + " to " + end.toUrlValue(6) + " failed: " + status);
                    }
                });
            }
        }

        // google.maps.event.addDomListener(window, 'load', initMap);

    
</script>

<script async defer 
        src="https://maps.googleapis.com/maps/api/js?key={{ Config('app.map_key')}}&libraries=geometry,places,drawing&callback=initMap">
</script>
@endpush