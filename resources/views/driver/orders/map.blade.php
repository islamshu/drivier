@extends('driver.layouts.app')


@section('title')
@lang('app.map')
@endsection


@section('content')

<div class="widget portlet-widget">
    <div class="widget-content widget-content-area">
        <div class="portlet portlet-danger">
            <div class="portlet-body portlet-common-body">

                <br>

                {{-- <button id="mapshowbutton" class="btn btn-classic btn-danger">map</button> --}}
                <div id="map"  style="height: 600px"></div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('script')



<script>


        var customIcons = {
            // icon: '{{ asset('assets/img/marker.png') }}',
            icon: 'https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi2.png',
            shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
            
        };
    function initMap() {

        <?php

                $region = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=". urlencode($start_point)  ."&key=AIzaSyAPQwgQSGCkZkWxv7PjbusEs9Yg9_lFjCk");
                $region1 = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=". urlencode($end_point)  ."&key=AIzaSyAPQwgQSGCkZkWxv7PjbusEs9Yg9_lFjCk");
                
                
                $data_from_city = json_decode($region);
                $data_to_city = json_decode($region1);

            ?>
                var sender_lat = "{{ isset($data_from_city->results[0]->geometry->location->lat) ? $data_from_city->results[0]->geometry->location->lat : ''  }}"; // ;
                var sender_long = "{{ isset($data_from_city->results[0]->geometry->location->lng) ? $data_from_city->results[0]->geometry->location->lng : '' }}";//  46.675297;

                var customer_lat = "{{ isset($data_to_city->results[0]->geometry->location->lat) ? $data_to_city->results[0]->geometry->location->lat : ''}}";// 21.389082;
                var customer_long = "{{ isset($data_to_city->results[0]->geometry->location->lng) ? $data_to_city->results[0]->geometry->location->lng : '' }}"; // 39.857910;




        var directionsDisplay = new google.maps.DirectionsRenderer();
        var directionsService = new google.maps.DirectionsService();

        var riyadh = {lat: 24.6877300, lng: 46.7218500};

        var map = new google.maps.Map(document.getElementById('map'), {
            center: riyadh,
            zoom: 10
        });

        directionsDisplay.setMap(map);

        // calculateAndDisplayRoute(directionsService, directionsDisplay);
        // google.maps.event.addListener(map, 'idle', calcRoute);

        // google.maps.event.addDomListener(calcRoute);

        // calcRoute();

        var geocoder = new google.maps.Geocoder();

        @foreach ($places as $place )

            var address = "{{ $place }}";
            geocodeAddress(geocoder, map , address , directionsService, directionsDisplay);
        
        @endforeach
        
        

        // var address = 'منتزه الملك سلمان البري';
        // geocodeAddress(geocoder, map , address);
        
        function geocodeAddress(geocoder, resultsMap , address , directionsService, directionsDisplay) {
            
            geocoder.geocode({'address': address}, function(results, status) {

            if (status === 'OK') {
                    resultsMap.setCenter(results[0].geometry.location);
                    
                    // var marker = new google.maps.Marker({
                    //     map: resultsMap,
                    //     position: results[0].geometry.location,
                    //     // draggable: true,
                    //     icon: customIcons.icon , 
                    //     shadow: customIcons.shadow,
                    // });
                    var waypts = [];
                    waypts.push({
                        location: results[0].geometry.location,
                        stopover: true
                    });
                    var start = new google.maps.LatLng(sender_lat, sender_long);
                    var end = new google.maps.LatLng(customer_lat, customer_long);

                    directionsService.route({
                        origin: start,
                        destination: end,
                          waypoints: waypts,
                          optimizeWaypoints: true,
                        travelMode: 'DRIVING'
                        }, function(response, status) {
                            directionsDisplay.setDirections(response);
                        });


            } else {
                console.log('Geocode was not successful for the following reason: ' + status);
            }
            });
        }
       

        function calcRoute() {
            var start = new google.maps.LatLng(sender_lat, sender_long);
            var end = new google.maps.LatLng(customer_lat, customer_long);


            var waypts = [];

            @foreach ($places as $place )

                var address = "{{ $place }}";

                waypts.push({
                    location: results[0].geometry.location,
                    stopover: true
                });
            @endforeach
            

            var startMarker = new google.maps.Marker({
                    position: start,
                    map: map,
                    draggable: true,
                });

            var endMarker = new google.maps.Marker({
                    position: end,
                    map: map,
                    draggable: true,
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



        function calculateAndDisplayRoute(directionsService, directionsDisplay) {

            var start = new google.maps.LatLng(sender_lat, sender_long);
            var end = new google.maps.LatLng(customer_lat, customer_long);

            directionsService.route({
            origin: start,
            destination: end,
            //   waypoints: waypts,
            //   optimizeWaypoints: true,
            travelMode: 'DRIVING'
            }, function(response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                    // var route = response.routes[0];
                    // var summaryPanel = document.getElementById('directions-panel');
                    // summaryPanel.innerHTML = '';
                    // // For each route, display summary information.

                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }

    }

    // google.maps.event.addDomListener(window, 'load', initMap);
    </script>

</script>

<script async defer 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPQwgQSGCkZkWxv7PjbusEs9Yg9_lFjCk&libraries=geometry,places,drawing&callback=initMap">
</script>

@endpush