@extends('admin.layouts.app')


@section('title')
@lang('app.map')
@endsection


@section('content')



<div class="row" id="cancel-row">
                
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <button class="mt-1 mb-1 btn btn-button-1 mb-4 mr-2" id="refreshMap">
                            <i class="flaticon-refresh-line-arrow"></i>
                        </button>
                    </div>          
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div id="map"  style="height: 600px"></div>
            </div>
        </div>
    </div>

</div>






@endsection


@push('script')



<script type="text/javascript">

    function initMap() {

        var locations = [];
        
        $('#refreshMap').on('click' , function() {

            var customer_url = '{{ url('admin/map/mapCustomers/') }}' + "/" + 2;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'get',
                url: customer_url,
                dataType: "json",
                data: {
                    _token: CSRF_TOKEN,
                },
                success: function(customers) {
                    $.each(customers, function (index, customer) {
                        locations.push(
                            [customer.branch_name + ' ,' + customer.branch_phone , customer.branch_lat , customer.branch_long , 2],
                        );
                    });
                }
            });

            // 

            var orders_url = '{{ url('admin/map/mapOrders/') }}' + "/" + 3;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'get',
                url: orders_url,
                dataType: "json",
                data: {
                    _token: CSRF_TOKEN,
                },
                success: function(orders) {
                    $.each(orders, function (index, order) {
                        locations.push(
                            [order.customer.branch_name + ' ,' + order.customer.branch_phone , order.from_lat , order.from_long , 3],
                        );
                    });
                }
            });


            var driver_url = '{{ url('admin/map/mapDrivers/') }}' + "/" + 0;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'get',
                url: driver_url,
                dataType: "json",
                data: {
                    _token: CSRF_TOKEN,
                },
                success: function(drivers) {
                    $.each(drivers, function (index, d) {
                        locations.push(
                            [d.fname + ' ' + d.lname  + ' ,' + d.phone , d.driver_lat , d.driver_lon , 0],
                        );
                    });
                }
            });
        });
        

        @foreach ($drivers as $d) 

            locations.push(
                 
                    ["{{ $d->fname .' ' . $d->lname .' ,' . $d->phone}}" , {{ $d->driver_lat ?? 0}} , {{ $d->driver_lon ?? 0 }} , 0],
                );
        @endforeach


        @foreach ($onlineDrivers as $online) 

            locations.push(
                 
                    ["{{ $online->fname .' ' . $online->lname .' ,' . $online->phone}}" , {{ $online->driver_lat ?? 0}} , {{ $online->driver_lon ??  0}} , 1],
                );
        @endforeach

        @foreach ($customers as $c) 

            locations.push(
                 
                    ["{{ $c->branch_name .' ,' . $c->branch_phone}}" , {{ $c->branch_lat ?? 0}} , {{ $c->branch_long ?? 0 }} , 2],
                );
        @endforeach


        @foreach ($orders as $o) 

            locations.push(
                 
                    ["{{ $o->customer->branch_name .' ,' . $o->customer->branch_phone}}" , {{ $o->from_lat ?? 0}} , {{ $o->from_long ?? 0 }} , 3],
                );
        @endforeach


        setInterval(() => {
            var online = '{{ url('admin/map/mapOnlineDrivers/') }}' + "/" + 1;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'get',
                url: online,
                dataType: "json",
                data: {
                    _token: CSRF_TOKEN,
                },
                success: function(onlineDrivers) {
                    $.each(onlineDrivers, function (index, onlineDriver) {
                        locations.push(
                            [onlineDriver.fname + ' ' + onlineDriver.lname  + ' ,'  +  onlineDriver.phone , onlineDriver.driver_lat , onlineDriver.driver_lon , 1],
                        );
                    });
                }
            });
        }, 10000);

        
        var centerCity = {lat: {{ $city->lat ?? 24.6877300}}, lng: {{ $city->lng ?? 46.7218500}}};
        
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: centerCity,
            mapTypeId: google.maps.MapTypeId.DRIVING,
        });


        google.maps.event.trigger(map, 'resize');

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        setInterval(() => {
            for (i = 0; i < locations.length; i++) {  
                
                if (locations[i][3] == 0) {
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        map: map,
                        icon: {
                            url: "{{ asset('public/offline.png')}}"
                            // http://maps.google.com/mapfiles/ms/icons/red-dot.png
                        }
                    });
                }else if(locations[i][3] == 1) {
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        map: map,
                        icon: {
                            url: "{{ asset('public/online.png')}}"
                        }
                    });
                }else if(locations[i][3] == 2) {
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        map: map,
                        icon: {
                            url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
                        }
                    });
                }else if(locations[i][3] == 3) {
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        map: map,
                        icon: {
                            url: "http://maps.google.com/mapfiles/ms/icons/orange-dot.png"
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
        }, 5000);
    }

</script>

  

<script async defer 
    src="https://maps.googleapis.com/maps/api/js?key={{ Config('app.map_key')}}&libraries=geometry,places,drawing&callback=initMap">
</script>

@endpush