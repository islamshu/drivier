@extends('admin.layouts.app') 

@section('title')
@lang('app.company_profile')
@endsection

@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/timedropper/timedropper.min.css') }}">
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
                        <h4>@lang('app.company_profile')</h4>
                    </div>                                                                        
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ url(route('companies.store')) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h6>@lang('app.company_info')</h6>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.storename')</label>                
                                <input type="text" class="form-control" name="company_name" value="{{ old('company_name') }}" required >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="company_logo">@lang('app.company_logo')</label>
                                <input type="file" class="form-control"  name="company_logo" placeholder="@lang('app.company_logo')">
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
                            <div class="form-group">
                                <label>@lang('app.address')</label>                
                                <input type="text" class="form-control" name="address" value="{{ old('address') }}" required >
                            </div>
                        </div>
                    </div>
    
    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.fullname')</label>                
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="company_phone" class="">@lang('app.phone')</label>                
                            <input type="text" id="company_phone" class="form-control" name="company_phone" value="{{ old('company_phone') }}"  >
                        </div>
                        <div class="col-md-3">
                            <label for="inputEmail" class="">@lang('app.email')</label>
                            <input type="email" id="inputEmail" value="{{ old('email') }}" class="form-control" name="email" required >
                        </div>
                        <div class="col-md-3">
                            <label for="inputPassword" class="">@lang('app.password')</label>
                            <input type="password" id="inputPassword" class="form-control" name="password"  required>
                        </div>
                    </div>


                    <div class="row">
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.company_currency')</label>
                                <select name="company_currency" class="form-control">
                                    <option value="ras">@lang('app.ras')</option>
                                    <option value="usd">@lang('app.usd')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.company_Num')</label>
                                <input type="text" class="form-control" value="{{ old('company_Num') }}" name="company_Num">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.company_taxNum')</label>
                                <input type="text" class="form-control" value="{{ old('company_taxNum') }}" name="company_taxNum">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.company_carType')</label>
                                <select name="company_carType" id="company_carType" class="form-control">
                                    <option value="0">@lang('app.sedan')</option>
                                    <option value="1">@lang('app.truck')</option>
                                    <option value="2">@lang('app.pickup')</option>
                                    <option value="3">@lang('app.coolcar')</option>
                                    <option value="4">@lang('app.allcars')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h6>@lang('app.contactManager')</h6>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.name')</label>
                                <input type="text" class="form-control" value="{{ old('contact_name') }}" name="contact_name">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.phone')</label>
                                <input type="text" class="form-control" value="{{ old('contact_phone') }}" name="contact_phone">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.email')</label>
                                <input type="text" class="form-control" value="{{ old('contact_email') }}" name="contact_email">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('app.jobTitle')</label>
                                <input type="text" class="form-control" value="{{ old('contact_job') }}" name="contact_job">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h6>@lang('app.financeManger')</h6>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.bank_name')</label>
                                <input type="text" class="form-control" value="{{ old('bank_name') }}" name="bank_name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.bank_accountNum')</label>
                                <input type="text" class="form-control" value="{{  old('bank_accountNum') }}" name="bank_accountNum">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.bank_iban')</label>
                                <input type="text" class="form-control" value="{{old('bank_iban') }}" name="bank_iban">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.bank_person')</label>
                                <input type="text" class="form-control" value="{{  old('bank_person') }}" name="bank_person">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.email')</label>
                                <input type="text" class="form-control" value="{{ old('bank_email') }}" name="bank_email">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.phone')</label>
                                <input type="text" class="form-control" value="{{ old('bank_phone') }}" name="bank_phone">
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    <h6>@lang('app.workingtime')</h6>


                    <table class="table table-bordered">
                        <tr>
                            <th>@lang('app.saturday')</th>
                            <th>@lang('app.sunday')</th>
                            <th>@lang('app.monday')</th>
                            <th>@lang('app.tuesday')</th>
                            <th>@lang('app.wednesday')</th>
                            <th>@lang('app.thursday')</th>
                            <th>@lang('app.friday')</th>
                            <th>@lang('app.filter')</th>
                            <th>@lang('app.action')</th>
                        </tr>
                        <tr>
                            <td>
                                <div class="n-chk">
                                    <label class="new-control new-checkbox checkbox-primary">
                                        <input type="checkbox" name="day[0][saturday]" class="new-control-input" checked >
                                        <span class="new-control-indicator"></span>  &nbsp;
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="n-chk">
                                    <label class="new-control new-checkbox checkbox-primary">
                                        <input type="checkbox" name="day[0][sunday]" class="new-control-input" checked >
                                        <span class="new-control-indicator"></span>  &nbsp;
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="n-chk">
                                    <label class="new-control new-checkbox checkbox-primary">
                                        <input type="checkbox" name="day[0][monday]" class="new-control-input" checked >
                                        <span class="new-control-indicator"></span>  &nbsp;
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="n-chk">
                                    <label class="new-control new-checkbox checkbox-primary">
                                        <input type="checkbox" name="day[0][tuesday]" class="new-control-input" checked >
                                        <span class="new-control-indicator"></span>  &nbsp;
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="n-chk">
                                    <label class="new-control new-checkbox checkbox-primary">
                                        <input type="checkbox" name="day[0][wednesday]" class="new-control-input" checked >
                                        <span class="new-control-indicator"></span>  &nbsp;
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="n-chk">
                                    <label class="new-control new-checkbox checkbox-primary">
                                        <input type="checkbox" name="day[0][thursday]" class="new-control-input" checked >
                                        <span class="new-control-indicator"></span>  &nbsp;
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="n-chk">
                                    <label class="new-control new-checkbox checkbox-primary">
                                        <input type="checkbox" name="day[0][friday]" class="new-control-input" checked >
                                        <span class="new-control-indicator"></span>  &nbsp;
                                    </label>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0"> <input type="text" class="form-control" name="day[0][from_time]" value="00:00"> </p>
                                <p class="mb-0">-- </p>
                                <p class="mb-0"><input type="text" class="form-control" name="day[0][to_time]"  value="01:00"></p>
                            </td>
                            <td>
                                <button class="btn btn-danger delete_item" type="button">
                                    <i class="flaticon-delete"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="rowsAdded"></tr>

                    </table>
                    
                    <div class="form-group text-right padding-top-5px">
                        <button id="addItem" class="btn btn-secondary mt-4" type="button"> 
                        <i class="flaticon-add-circle-outline"></i>  @lang('app.add') 
                        </button>
                    </div>

                    <hr>
                    <h6>@lang('app.address')</h6>

                    <div class="row">
                        <div class="col-md-12">
                            <input id="searchInput" class="controls" type="text" placeholder="حدد عنوان الشركة من هنا">
                            <div id="map"></div>

                            <input type="hidden" name="company_lat" id="company_lat" value="{{ old('company_lat') }}"> 
                            <input type="hidden" name="company_long" id="company_long"  value="{{ old('company_long')}}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-button-7 mb-4 mt-3">@lang('app.update')</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')

<script>

    var x = 0;
    $(document).on('click' , '#addItem' , function(e) {
        e.preventDefault();
        x++;

   
        var new_row = '<tr id="rowid'+x+'">' +
                            '<td>' +
                                '<div class="n-chk">' +
                                    '<label class="new-control new-checkbox checkbox-primary">' +
                                      '<input type="checkbox" name="day['+x+'][saturday]" class="new-control-input" checked >' +
                                      '<span class="new-control-indicator"></span>  &nbsp;' +
                                    '</label>' +
                                '</div>' +
                            '</td>' +
                            '<td>' +
                                '<div class="n-chk">' +
                                    '<label class="new-control new-checkbox checkbox-primary">' +
                                      '<input type="checkbox" name="day['+x+'][sunday]" class="new-control-input" checked >' +
                                      '<span class="new-control-indicator"></span>  &nbsp;' +
                                    '</label>' +
                                '</div>' +
                            '</td>' +
                            '<td>' +
                                '<div class="n-chk">' +
                                    '<label class="new-control new-checkbox checkbox-primary">' +
                                      '<input type="checkbox" name="day['+x+'][monday]" class="new-control-input" checked >' +
                                      '<span class="new-control-indicator"></span>  &nbsp;' +
                                    '</label>' +
                                '</div>' +
                            '</td>' +
                            '<td>' +
                                '<div class="n-chk">' +
                                    '<label class="new-control new-checkbox checkbox-primary">' +
                                      '<input type="checkbox" name="day['+x+'][tuesday]" class="new-control-input" checked >' +
                                      '<span class="new-control-indicator"></span>  &nbsp;' +
                                    '</label>' +
                                '</div>' +
                            '</td>' +
                            '<td>' +
                                '<div class="n-chk">' +
                                    '<label class="new-control new-checkbox checkbox-primary">'+
                                      '<input type="checkbox" name="day['+x+'][wednesday]" class="new-control-input" checked >' +
                                      '<span class="new-control-indicator"></span>  &nbsp;' +
                                    '</label>' +
                                '</div>' +
                            '</td>' +
                            '<td>' +
                                '<div class="n-chk">' +
                                    '<label class="new-control new-checkbox checkbox-primary">' +
                                      '<input type="checkbox" name="day['+x+'][thursday]" class="new-control-input" checked >' +
                                      '<span class="new-control-indicator"></span>  &nbsp;' +
                                    '</label>' +
                                '</div>' +
                            '</td>' +
                            '<td>' +
                                '<div class="n-chk">' +
                                    '<label class="new-control new-checkbox checkbox-primary">' +
                                      '<input type="checkbox" name="day['+x+'][friday]" class="new-control-input" checked >' +
                                      '<span class="new-control-indicator"></span>  &nbsp;' +
                                    '</label>' +
                                '</div>' +
                            '</td>' +
                            '<td>' +
                                '<p class="mb-0"> <input type="text" class="form-control" name="day['+x+'][from_time]" value="12:00"> </p>' +
                                '<p class="mb-0">-- </p>' +
                                '<p class="mb-0"><input type="text" class="form-control" name="day['+x+'][to_time]"  value="24:00"></p>' +
                            '</td>' +
                            '<td>' +
                                '<button class="btn btn-danger delete_item" type="button">' +
                                    '<i class="flaticon-delete"></i>' +
                                '</button>' +
                            '</td>' +
                        '</tr>';


      $(new_row).insertAfter($('.rowsAdded'));


    });


    $(document).on('click','.delete_item',function(){

        $(this).closest("tr").remove();

        // var id = $(this).closest("tr").prop("id").replace('rowid', '');
    });



</script>


<script src="{{ asset('plugins/timedropper/timedropper.min.js') }}"></script>
<script>
    $('#from_time').timeDropper();
    $('#to_time').timeDropper();

</script>

<script>
    function initMap() {

        var lat = 24.6877300;
        var lng =  46.7218500;

        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: lat, lng: lng},
            zoom: 10
        });
            marker = new google.maps.Marker({
                position: {lat: lat, lng: lng},
                map: map
            });

            marker.setIcon(({
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            map.setZoom(17);

        google.maps.event.addListener(map, 'click', function (event) {
            $("#company_lat").val(event.latLng.lat());
            $("#company_long").val(event.latLng.lng());

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
            $("#company_lat").val(place.geometry.location.lat());
            $("#company_long").val(place.geometry.location.lng());
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPQwgQSGCkZkWxv7PjbusEs9Yg9_lFjCk&libraries=places&callback=initMap"
        async defer></script>
@endpush