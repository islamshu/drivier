@extends('admin.layouts.app') 

@section('title')
@lang('app.createCity')
@endsection



@section('content')

@include('message')

<div class="row" id="cancel-row">
                
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('app.createCity')</h4>
                    </div>                 
                </div>  
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ url(route('cities.store'))}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.name')</label>
                                <input type="text" name="name" placeholder="@lang('app.name')" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.lat')</label>
                                <input type="text" name="lat" placeholder="@lang('app.lat')" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.lng')</label>
                                <input type="text" name="lng" placeholder="@lang('app.lng')" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-classic btn-primary">@lang('app.save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>



@endsection




