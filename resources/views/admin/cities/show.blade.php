@extends('admin.layouts.app') 

@section('title')
@lang('app.viewCity')
@endsection



@section('content')

@include('message')

<div class="row" id="cancel-row">
                
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('app.viewCity')</h4>
                    </div>
                </div>  
            </div>
            <div class="widget-content widget-content-area">
                <table class="table">
                    @isset($city)
                        <tr>
                            <th>@lang('app.name')</th>
                            <td>{{ $city->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('app.lat')</th>
                            <td>{{ $city->lat }}</td>
                        </tr>
                        <tr>
                            <th>@lang('app.lng')</th>
                            <td>{{ $city->lng }}</td>
                        </tr>
                    @endisset
                </table>
                <hr>
                @isset($city)
                    <h3>@lang('app.regions')</h3>
                    @if ($city->regions->count() != 0)
                        @foreach ($city->regions as $region)
                            <p> {{ $region->name }} </p>
                        @endforeach
                    @else
                        <p>@lang('app.noResults')</p>
                    @endif
                @endisset
            </div>
        </div>
    </div>

</div>



@endsection




