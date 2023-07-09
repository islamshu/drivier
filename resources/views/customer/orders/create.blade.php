@extends('customer.layouts.app') 

@section('title')
@lang('app.createorder')
@endsection

@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
<link href="{{ asset('plugins/datepicker/datedropper.min.css') }}"  rel="stylesheet" type="text/css">
<link href="{{ asset('plugins/timedropper/timedropper.min.css') }}" rel="stylesheet" type="text/css">
<style>
    .input-control.required input { border: 1px dashed #b7b7b7; border-radius: 2px; }
    label { color: #3b3f5c; margin-bottom: 14px; }
    .form-control::-webkit-input-placeholder { color: #888ea8; font-size: 15px; }
    .form-control::-ms-input-placeholder { color: #888ea8; font-size: 15px; }
    .form-control::-moz-placeholder { color: #888ea8; font-size: 15px; }
    .form-control {
        border: 1px solid #ccc;
        color: #888ea8;
        font-size: 15px;
        border-radius: 2px;
    }
    .form-control:focus { border-color: #f1f3f1; border-left: solid 3px #3862f5; }
</style>
<style>
    #map {
        width: 100%;
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

    #searchInput {
        border-color: #4d90fe;
    }
</style>
@endsection

@section('content')

@include('message')

<div class="row">
    <div class="col-lg-12 layout-spacing">

        <form action="{{ url(route('order.store'))}}" method="post">
            @csrf

            <div class="statbox widget box box-shadow mt-5">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>@lang('app.dropoff_details')</h4>
                        </div>                                                                        
                    </div>
                </div>

                <div class="widget-content widget-content-area">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputEmail4">@lang('app.name')</label>
                                        <input type="text" class="form-control" name="name"  value="{{ old('name') }}" required="required">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ph-number">@lang('app.phone')</label>
                                        <input type="text" class="form-control mb-4" value="{{ old('phone') }}" name="phone" id="ph-number" required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.city')</label>
                                        <select class="placeholder js-states form-control" value="{{ old('city') }}" id="city" name="city">
                                            <option value="0">@lang('app.select_city')</option>
                                            @isset($cities)
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.region')</label>
                                        <select class="placeholder js-states form-control" id="region" name="region_id">
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <label>@lang('app.dateandtime')</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control datedropper"  name="another_date" id="another_date"  data-format="Y-m-d" data-lang="ar" data-modal="false" data-large-default="false" data-large-mode="false">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control"  name="timedropper" id="timedropper"  >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{-- <div class="form-group">
                                        <label>@lang('app.vehicle')</label>
                                        <select class="js-states form-control" value="{{ old('vehicle_id') }}" name="vehicle_id">
                                            <option value="0">@lang('app.select')</option>
                                            @isset($vehicles)
                                                @foreach($vehicles as $vehicle)
                                                    <option value="{{ $vehicle->id }}">{{ $vehicle->carName }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div> --}}

                                    <div class="form-group">
                                        <label>@lang('app.vehicle') <span class="required">&#9733;</span> </label>
                                        <select name="carType" id="carType" class="form-control">
                                            <option value="0">@lang('app.sedan')</option>
                                            <option value="1">@lang('app.truck')</option>
                                            <option value="2">@lang('app.pickup')</option>
                                            <option value="3">@lang('app.coolcar')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.goods_type')</label>
                                        <input type="text" class="form-control" name="goods_type" >
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.box_count') </label>
                                        <input id="box_count" type="text" value="{{ old('box_count') ?? 0 }}"  name="box_count">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.approx_weight') </label>
                                        <input id="approx_weight" type="text" value="{{ old('approx_weight') ?? 0}}"  name="approx_weight">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputEmail4">@lang('app.cod') </label>
                                        <div class="input-group btn-group mb-4">
                                            <input type="text" class="form-control" name="cod_amount" value="{{ old('cod_amount') ?? 0  }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.approxfare')</label>
                                        <input type="text" readonly name="delivery_fees" id="delivery_fees" class="form-control">
                                    </div>
                                </div>
                            </div>    
                            <span id="delivery_time" class="mr-2 ml-2"></span>
                            <span id="approx_km_text"></span>
                            <input type="hidden" name="delivery_time" id="deliveryTime">
                            {{-- <input type="hidden" name="delivery_fees" value="0" id="delivery_fees"> --}}
                            <input type="hidden" name="approx_km" id="approx_km">
                            <input type="hidden" name="clientAddress" id="clientAddress">
                                
                            <div class="form-group">
                                <input id="searchInput" class="controls" type="text" placeholder="ادخل عنوان التوصيل , العميل">
                                <div id="map"></div>
                                <input type="hidden" name="to_lat" id="to_lat">
                                <input type="hidden" name="to_long" id="to_long">
                            </div>
        
        
                            {{-- <div class="form-group">
                                <div class="n-chk">
                                    <label class="new-control new-radio radio-primary">
                                        <input type="radio" class="new-control-input" value="0"  checked name="payment_type" id="in">
                                        <span class="new-control-indicator"></span> @lang('app.cash_on_delivery')
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="n-chk">
                                    <label class="new-control new-radio radio-danger">
                                        <input type="radio" class="new-control-input" value="1"  name="payment_type">
                                        <span class="new-control-indicator"></span> 
                                        @lang('app.payment_by_visa')
                                    </label>
                                </div>
                                <span class="text-muted">@lang('app.payment_note')</span>
                            </div> --}}
        
                            <div class="form-group">
                                <button type="submit" class="btn btn-classic btn-primary">@lang('app.createorder')</button> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
</div>
        
@endsection

@push('script')
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('plugins/select2/custom-select2.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/input-mask/input-mask.js?v=11111') }}"></script>
<script src="{{ asset('plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{ asset('plugins/bootstrap-touchspin/custom-bootstrap-touchspin.js?v=2.0')}}"></script>
<script src="{{ asset('plugins/datepicker/datedropper.min.js') }}"></script>
<script src="{{ asset('plugins/timedropper/timedropper.min.js') }}"></script>

<script>
    
    $('#another_date').dateDropper();
    $('#timedropper').timeDropper();


    $(function() {

        $(document).on('change', "#city" , function () {
            //alert($(this).val())
            var city_id = $(this).val();
            var base_url = '{{ url('customer/order/getRegion/') }}' + "/" + city_id;


            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'get',
                url: base_url,
                dataType: "json",
                data: {
                    _token: CSRF_TOKEN,
                },
                success: function(regions) {
                    $c = $("#region");
                    $c.find('option').remove().end();
                    $.each(regions, function (index, region) {
                        $c.append('<option value="' + region.name + '">' + region.name + '</option>');
                    });
                },
                error: function() {
                    alert('Error');
                }
            });

        })

    });

</script>



<script>


    function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 24.6877300, lng: 46.7218500},
            zoom: 10
        });
        
        google.maps.event.addListener(map, 'click', function (event) {
            marker.setVisible(false);
            marker = new google.maps.Marker({position: event.latLng, map: map});
            $("#to_lat").val(event.latLng.lat());
            $("#to_long").val(event.latLng.lng());

            if (marker) {
                marker.setPosition(event.latLng);
            } else {
                marker = new google.maps.Marker({
                    position: event.latLng,
                    map: map
                });
            }
        });
        
        var input = document.getElementById('searchInput');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    
        $('#searchInput').on('paste change keyp keypress' , function() {
            
            map.controls[google.maps.ControlPosition.TOP_LEFT].push($(this));
            
            
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);
            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });
    
            var directionsDisplay = new google.maps.DirectionsRenderer();
            var directionsService = new google.maps.DirectionsService();
          
            directionsDisplay.setMap(map);
            autocomplete.addListener('place_changed', function () {

                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    // window.alert("Autocomplete's returned place contains no geometry");
                    // return;
                }
    
                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                marker.setIcon(({
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));
                
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
    
                var address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }
    
                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                infowindow.open(map, marker);
    
    
    
                var start = new google.maps.LatLng({{ $customer->branch_lat}}, {{ $customer->branch_long}});
                var end = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
    
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
    
                        // console.log(response.routes[0].legs[0].distance.text);
                        // console.log(response.routes[0].legs[0].duration.text);
    
                        // console.log(response);
    
    
                        // var distance = getDistance(from_lat , from_long , to_lat , to_long);
    
                        var distance = response.routes[0].legs[0].distance.value / 1000;
                        var duration = response.routes[0].legs[0].duration.value / 60;
    
    
                        
                        // var distance = parseFloat(distanceValue).toFixed(0)
    
    
                        $('#approx_km_text').text(response.routes[0].legs[0].distance.text);
                        $('#approx_km').val(parseFloat(distance).toFixed());
    
                        $('#delivery_time').text('الوقت التقريبي '+  response.routes[0].legs[0].duration.text);
                        $('#deliveryTime').val(parseFloat(duration).toFixed());
                        
    
    
                        if (parseFloat(distance).toFixed() <= {{$company->km_fast }}) {
                            $('#delivery_fees').val({{$company->fee_fast }});
                            // parseFloat(distance).toFixed(0) *
                        }else {
                            var x = parseFloat(distance).toFixed();
    
                            var y = x - {{ $company->km_fast }};
    
                            var fees = {{ $company->fee_fast }};
    
                            var totally = y * {{ $company->km_fee_fast }} ;
                            var price = fees+ totally;
    
                            $('#delivery_fees').val(price);
                        }
    
    
    
                    } else {
                        // alert("Directions Request from " + start.toUrlValue(6) + " to " + end.toUrlValue(6) + " failed: " + status);
                    }
                });
    
    
                //Location details
                $("#clientAddress").val(place.name + ' , ' + address);
                $("#to_lat").val(place.geometry.location.lat());
                $("#to_long").val(place.geometry.location.lng());
                
            });
            
        });


        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);


        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        var directionsDisplay = new google.maps.DirectionsRenderer();
        var directionsService = new google.maps.DirectionsService();
        
        directionsDisplay.setMap(map);

        autocomplete.addListener('place_changed', function () {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                // window.alert("Autocomplete's returned place contains no geometry");
                // return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);

            var start = new google.maps.LatLng({{ $customer->branch_lat}}, {{ $customer->branch_long}});
            var end = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());

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
    
                        // console.log(response.routes[0].legs[0].distance.text);
                        // console.log(response.routes[0].legs[0].duration.text);
    
                        // console.log(response);
    
    
                        // var distance = getDistance(from_lat , from_long , to_lat , to_long);
    
                        var distance = response.routes[0].legs[0].distance.value / 1000;
                        var duration = response.routes[0].legs[0].duration.value / 60;
    
    
                        
                        // var distance = parseFloat(distanceValue).toFixed(0)
    
    
                        $('#approx_km_text').text(response.routes[0].legs[0].distance.text);
                        $('#approx_km').val(parseFloat(distance).toFixed());
    
                        $('#delivery_time').text('الوقت التقريبي '+  response.routes[0].legs[0].duration.text);
                        $('#deliveryTime').val(parseFloat(duration).toFixed());
                        
    
    
                        if (parseFloat(distance).toFixed() <= {{$company->km_fast }}) {
                            $('#delivery_fees').val({{$company->fee_fast }});
                            // parseFloat(distance).toFixed(0) *
                        }else {
                            var x = parseFloat(distance).toFixed();
    
                            var y = x - {{ $company->km_fast }};
    
                            var fees = {{ $company->fee_fast }};
    
                            var totally = y * {{ $company->km_fee_fast }} ;
                            var price = fees+ totally;
    
                            $('#delivery_fees').val(price);
                        }
    
    
    
                    } else {
                        // alert("Directions Request from " + start.toUrlValue(6) + " to " + end.toUrlValue(6) + " failed: " + status);
                    }
                });

            //Location details

            $("#clientAddress").val(place.name + ' , ' + address);
            
            $("#to_lat").val(place.geometry.location.lat());
            $("#to_long").val(place.geometry.location.lng());
            
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ Config('app.map_key')}}&libraries=places&callback=initMap"
        async defer></script>


@endpush
