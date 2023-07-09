@extends('customer.layouts.app') 

@section('title')
@lang('app.branches') >  @lang('app.add')
@endsection


@section('header')
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

    #searchInput:focus {
        border-color: #4d90fe;
    }
</style>
@endsection


@section('content')

@include('message')

<div class="row">
    <div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('app.branches')</h4>
                    </div>                                                                        
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ url(route('users.customer.store'))}}" method="POST">
                    @csrf
                    <h6>@lang('app.branch_person')</h6>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.name')</label>
                                <input type="text" class="form-control" value="{{ old('name') }}" required name="name" placeholder="@lang('app.name')">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.email')</label>
                                <input type="text" class="form-control" required value="{{ old('email') }}" name="email" placeholder="@lang('app.email')">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-4">
                                <label>@lang('app.password')</label>
                                <input type="password" class="form-control" required   name="password" placeholder="@lang('app.password')">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-4">
                                <label>@lang('app.repassword')</label>
                                <input type="password" class="form-control"   name="password_confirmation" required placeholder="@lang('app.repassword')">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input has-info">
                        <label for="role_id">@lang('app.role')</label>
                        <select name="role_id[]" id="role_id" class="form-control" multiple>
                            <option disabled>@lang('app.select_role')</option>
                            @isset($roles)
                                @foreach ($roles as $role)
                                    @if ($role->name != 'super')
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <hr>
                    <h6>@lang('app.branch_info')</h6>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.branch_name')</label>
                                <input type="text" class="form-control"  name="branch_name" value="{{ old('branch_name')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-4">
                                <label for="inputAddress">@lang('app.branch_phone')</label>
                                <input type="text" class="form-control"  name="branch_phone" value="{{ old('branch_phone')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.city')</label>
                                <select name="city_id" class="form-control">
                                    @isset($cities)
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    @endisset   
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-4">
                                <label for="inputAddress">@lang('app.branch_address')</label>
                                <input type="text" class="form-control"  name="branch_address" value="{{ old('branch_address')}}">
                            </div>
                        </div>
                    </div>

                    <h6>@lang('app.address')</h6>

                    <div class="row">
                        <div class="col-md-12">
                            <input id="searchInput" class="controls" type="text" placeholder="حدد عنوان الفرع ">
                            <div id="map"></div>

                            <input type="hidden" name="branch_lat" id="branch_lat" value="{{ old('branch_lat')}}"> 
                            <input type="hidden" name="branch_long" id="branch_long"  value="{{ old('branch_long') }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-button-7 mb-4 mt-3">@lang('app.add')</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 24.6877300, lng: 46.7218500},
            zoom: 10
        });

        google.maps.event.addListener(map, 'click', function (event) {
            $("#branch_lat").val(event.latLng.lat());
            $("#branch_long").val(event.latLng.lng());

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

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function () {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

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

            //Location details
            $("#branch_lat").val(place.geometry.location.lat());
            $("#branch_long").val(place.geometry.location.lng());
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPQwgQSGCkZkWxv7PjbusEs9Yg9_lFjCk&libraries=places&callback=initMap" async defer></script>
@endpush