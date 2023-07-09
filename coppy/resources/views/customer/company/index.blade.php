@extends('customer.layouts.app') 

@section('title')
@lang('app.company_profile')
@endsection

@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/timedropper/timedropper.min.css') }}">
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
                <form action="{{ url(route('company.customer.update' ,[ $company->id] ))}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row mb-4">
                        <div class="col-md-6">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_logo">@lang('app.company_logo')</label>
                                        <input type="file" class="form-control"  name="company_logo" placeholder="@lang('app.company_logo')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_name">@lang('app.storename')</label>
                                        <input type="text" class="form-control" value="{{ $company->company_name }}" name="company_name" placeholder="@lang('app.storename')">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.city')</label>
                                        <select name="city_id" class="form-control">
                                            @isset($cities)
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}" {{ $company->city_id == $city->id ? 'selected' : ''}}>{{ $city->name }}</option>
                                                @endforeach
                                            @endisset   
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="inputAddress">@lang('app.address')</label>
                                        <input type="text" class="form-control"  value="{{ $company->company_address }}" name="company_address" placeholder="@lang('app.address')">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.phone')</label>
                                        <input type="text" class="form-control" value="{{ $company->company_phone }}" name="company_phone" placeholder="@lang('app.phone')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.company_currency')</label>
                                        <select name="company_currency" class="form-control">
                                            <option value="ras">@lang('app.ras')</option>
                                            <option value="usd">@lang('app.usd')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h6>@lang('app.company_info')</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.company_Num')</label>
                                        <input type="text" class="form-control" value="{{ $company->company_Num }}" name="company_Num">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.company_taxNum')</label>
                                        <input type="text" class="form-control" value="{{ $company->company_taxNum }}" name="company_taxNum">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                               
                                <div class="col-md-12">
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
                            
                            {{-- <div class="form-group form-md-line-input has-info">
                                <label for="role_id">@lang('app.role')</label>
                                <select name="workings_day[]" id="workings_day" class="form-control" multiple>
                                    <option value="السبت">@lang('app.saturday')</option>
                                    <option value="الأحد">@lang('app.sunday')</option>
                                    <option value="الإثنين">@lang('app.monday')</option>
                                    <option value="الثلاثاء">@lang('app.tuesday')</option>
                                    <option value="الأربعاء">@lang('app.wednesday')</option>
                                    <option value="الخميس">@lang('app.thursday')</option>
                                    <option value="الجمعة">@lang('app.friday')</option>
                                </select>
                            </div> --}}


                            <hr>
                            <h6>@lang('app.contactManager')</h6>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.name')</label>
                                        <input type="text" class="form-control" value="{{ $company->contact_name ?? old('contact_name') }}" name="contact_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.phone')</label>
                                        <input type="text" class="form-control" value="{{ $company->contact_phone ?? old('contact_phone') }}" name="contact_phone">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.email')</label>
                                        <input type="text" class="form-control" value="{{ $company->contact_email ?? old('contact_email') }}" name="contact_email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.jobTitle')</label>
                                        <input type="text" class="form-control" value="{{ $company->contact_job ?? old('contact_job') }}" name="contact_job">
                                    </div>
                                </div>
                            </div>


                            <hr>
                            <h6>@lang('app.financeManger')</h6>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.bank_name')</label>
                                        <input type="text" class="form-control" value="{{ $company->bank_name ?? old('bank_name') }}" name="bank_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.bank_accountNum')</label>
                                        <input type="text" class="form-control" value="{{ $company->bank_accountNum ?? old('bank_accountNum') }}" name="bank_accountNum">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.bank_iban')</label>
                                        <input type="text" class="form-control" value="{{ $company->bank_iban ?? old('bank_iban') }}" name="bank_iban">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.bank_person')</label>
                                        <input type="text" class="form-control" value="{{ $company->bank_person ?? old('bank_person') }}" name="bank_person">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.email')</label>
                                        <input type="text" class="form-control" value="{{ $company->bank_email ?? old('bank_email') }}" name="bank_email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('app.phone')</label>
                                        <input type="text" class="form-control" value="{{ $company->bank_phone ?? old('bank_phone') }}" name="bank_phone">
                                    </div>
                                </div>
                            </div>
                            
                            <hr>
                            <h6>@lang('app.address')</h6>

                            <div class="row">
                                <div class="col-md-12">
                                    <input id="searchInput" class="controls" type="text" placeholder="حدد عنوان الشركة من هنا">
                                    <div id="map"></div>

                                    <input type="hidden" name="company_lat" id="company_lat" value="{{ $company->company_lat ??  0}}"> 
                                    <input type="hidden" name="company_long" id="company_long"  value="{{ $company->company_long ??  0}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>@lang('app.info_msg')</h6>
                            <table class="table">
                                

                                @if ($company->company_type == 1)
                                    <tr>
                                        <th>@lang('app.deliverey_fee')</th>
                                        <td> {{ $company->km_goods }} @lang('app.km') \ {{ $company->fee_goods}} @lang('app.ras')  | 1 @lang('app.km') \ {{ $company->km_fee_goods }} @lang('app.ras')  </td>
                                    </tr>
                                @endif
                                {{-- <tr>
                                    <th>@lang('app.type')</th>
                                    <th><span class="badge badge-success"> {{ $company->delivery_type == 0 ? trans('app.perorder') : trans('app.contract') }} </span></th>
                                </tr> --}}
                            </table>
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
                        
                        <tr class="rowsAdded"></tr>

                    </table>
                    
                    <div class="form-group text-right padding-top-5px">
                        <button id="addItem" class="btn btn-secondary mt-4" type="button"> 
                        <i class="flaticon-add-circle-outline"></i>  @lang('app.add') 
                        </button>
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


<script src="{{ asset('public/plugins/timedropper/timedropper.min.js') }}"></script>
<script>
    $('#from_time').timeDropper();
    $('#to_time').timeDropper();

</script>

<script>
    function initMap() {

        var lat = {{ $city->lat ?? 24.6877300}};
        var lng = {{ $city->lng ?? 46.7218500}};

        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: lat, lng: lng},
            zoom: 10
        });
            // marker = new google.maps.Marker({
            //     position: {lat: lat, lng: lng},
            //     map: map
            // });

            // marker.setIcon(({
            //     size: new google.maps.Size(71, 71),
            //     origin: new google.maps.Point(0, 0),
            //     anchor: new google.maps.Point(17, 34),
            //     scaledSize: new google.maps.Size(35, 35)
            // }));
            // map.setZoom(17);

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

<script src="https://maps.googleapis.com/maps/api/js?key={{ Config('app.map_key')}}&libraries=places&callback=initMap"
        async defer></script>
@endpush