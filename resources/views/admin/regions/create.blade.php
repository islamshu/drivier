@extends('admin.layouts.app') 

@section('title')
@lang('app.add')
@endsection


@section('content')

@include('message')

<div class="row" id="cancel-row">
                
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4> {{ $city->name}}</h4>
                    </div>                 
                </div>  
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ url(route('cities.region.store' , $city->id))}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>@lang('app.name')</label>
                        <input type="text" name="name" placeholder="@lang('app.name')" class="form-control">
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




