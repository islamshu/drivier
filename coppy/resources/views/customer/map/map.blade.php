@extends('customer.layouts.app')


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



<script type="text/javascript">

    function initMap() {

        
        // var locations = [
        //         ['Bondi Beach', -33.890542, 151.274856, 4],
        //         ['Coogee Beach', -33.923036, 151.259052, 5],
        //         ['Cronulla Beach', -34.028249, 151.157507, 3],
        //         ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
        //         ['Maroubra Beach', -33.950198, 151.259302, 1]
        //     ];

        var locations = [];


        @foreach ($customers as $c) 

            locations.push(
                 
                    ["{{ $c->branch_name .' ,' . $c->branch_phone}}" , {{ $c->branch_lat ?? 0}} , {{ $c->branch_long ?? 0 }} , 0],
                );
        @endforeach


        @foreach ($orders as $o) 

            locations.push(
                 
                    ["{{ $o->customer->branch_name .' ,' . $o->customer->branch_phone}}" , {{ $o->from_lat ?? 0}} , {{ $o->from_long ?? 0 }} , 1],
                );
        @endforeach

        
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: {lat: 24.6877300, lng: 46.7218500},
            mapTypeId: google.maps.MapTypeId.DRIVING,
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {  
            
            if (locations[i][3] == 0) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    icon: {
                        url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png"
                    }
                });
            }else {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    icon: {
                        url: "http://maps.google.com/mapfiles/ms/icons/green-dot.png"
                    }
                });
            }

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    }

</script>

  

<script async defer 
    src="https://maps.googleapis.com/maps/api/js?key={{ Config('app.map_key')}}&libraries=geometry,places,drawing&callback=initMap">
</script>

@endpush