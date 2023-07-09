@extends('admin.layouts.app') 

@section('title')
@lang('app.company_profile')
@endsection

@section('header')
<link href="{{ asset('assets/css/ui-kit/tabs-accordian/custom-tabs.css')}}" rel="stylesheet" type="text/css" />
@endsection


@section('content')

@include('message')

<div class="row" id="cancel-row">
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                        {{-- <h4>@lang('app.company_profile') # {{ $company->company_name }} </h4> --}}

                        <ul class="nav nav-pills mb-3 mt-3 nav-fill" id="justify-pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="justify-pills-home-tab" data-toggle="pill" href="#justify-pills-home" role="tab" aria-controls="justify-pills-home" aria-selected="true">@lang('app.company_info')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="justify-pills-profile-tab" data-toggle="pill" href="#justify-pills-profile" role="tab" aria-controls="justify-pills-profile" aria-selected="false">@lang('app.branches')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="justify-pills-map-tab" data-toggle="pill" href="#justify-pills-map" role="tab" aria-controls="justify-pills-map" aria-selected="false">@lang('app.map')</a>
                            </li>
                        </ul>

                    </div>
                    
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right padding-top-5px">
                        <div class="btn-group mr-2" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('app.status')<span class="caret"></span></button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                @if ($company->status == 0)
                                    <a href="{{ url(route('companies.active' , [$company->id])) }}" class="dropdown-item">@lang('app.active')</a>
                                @else
                                    <a href="{{ url(route('companies.deactive' , [$company->id])) }}" class="dropdown-item">@lang('app.deactive')</a>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>  
            </div>
            <div class="widget-content widget-content-area">

                <div class="tab-content" id="justify-pills-tabContent">
                    <div class="tab-pane fade show active" id="justify-pills-home" role="tabpanel" aria-labelledby="justify-pills-home-tab">
                        @isset($company)
                            <div class="row">
                                <div class="col-md-4">
                                    <h6>@lang('app.company_logo')</h6>
                                    @isset($company->company_logo )
                                        <img src="{{ url('/' . $company->company_logo )}}" alt="" height="200"  width="200" class="img-thumbnail">
                                    @endisset   
                                </div>

                                <div class="col-md-4">
                                    <h6>@lang('app.company_info')</h6>
                                    <address class="mb-5">
                                        <strong> {{ $company->company_name }}</strong><br>
                                         {{ $company->city->name }}  , {{ $company->company_address }}<br>
                                        <abbr title="Phone">@lang('app.phone'):</abbr> {{ $company->company_phone }} <br>
                                    </address>
                                </div>
                                <div class="col-md-4">
                                    <address>
                                        <strong class="text-primary">@lang('app.company_info')</strong><br>
                                        <strong>@lang('app.company_Num'): {{ $company->company_Num }}</strong><br>
                                        <strong>@lang('app.company_taxNum'): {{ $company->company_taxNum }}</strong><br>
                                        <strong>@lang('app.company_carType'):
                                            @if ($company->company_carType == 0)
                                                @lang('app.sedan')
                                            @elseif ($company->company_carType == 1)
                                                @lang('app.truck')
                                            @elseif ($company->company_carType == 2)
                                                @lang('app.pickup')
                                            @elseif ($company->company_carType == 3)
                                                @lang('app.coolcar')
                                            @else
                                                @lang('app.allcars')
                                            @endif
                                        </strong><br>
                                        <strong>@lang('app.num_employee') : <span class="badge badge-danger"> {{ $company->users->count() }} </span></strong><br>
                                        <strong>@lang('app.company_currency'):
                                            @if ($company->company_currency == 'ras')
                                                @lang('app.ras')
                                            @else
                                                @lang('app.usd')
                                            @endif
                                        </strong><br>
                                    </address>
                                </div>
                            </div>
                        @endisset

                        {{-- <div class="clearfix"></div> --}}
                    </div>

                    <div class="tab-pane fade" id="justify-pills-profile" role="tabpanel" aria-labelledby="justify-pills-profile-tab">
                        @foreach ($company->users as $user)
                            <div class="alert alert-dark">
                                {{ $user->branch_name }} <br>
                                {{ $user->branch_phone }} <br>
                                {{ $user->email }} <br>
                                {{ $user->city->name .' , '. $user->branch_address }} <br>
                            </div>
                        @endforeach
                    </div>

                    <div class="tab-pane fade" id="justify-pills-map" role="tabpanel" aria-labelledby="justify-pills-map-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="map"  style="height: 400px"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection





@push('script')



<script>

        function initMap() { 
            

            var riyadh = {lat: {{ $company->company_lat}}, lng: {{ $company->company_long}}};

            map = new google.maps.Map(document.getElementById('map'), {
                center: riyadh,
                zoom: 6
            });
            geocoder = new google.maps.Geocoder();

            var marker = new google.maps.Marker({
                position: riyadh,
                map: map,
                title: "{{ $company->company_name }}"
            });
            

            @foreach ($company->users as $customer )

                // var latlng = new google.maps.LatLng({{ $customer->branch_lat }} , {{ $customer->branch_long }});
                var latlng = {lat: {{ $customer->branch_lat}}, lng: {{ $customer->branch_long}}};

                var marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    title: "{{ $customer->branch_name }}"
                });
            @endforeach
            
        }

  

</script>

<script async defer 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPQwgQSGCkZkWxv7PjbusEs9Yg9_lFjCk&libraries=geometry,places,drawing&callback=initMap">
</script>