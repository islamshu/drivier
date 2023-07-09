@extends('customer.layouts.app') 

@section('title')
    @lang('app.roles')
@endsection

@section('content')

@include('message')


<div class="row" id="cancel-row">
                
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('app.roles')</h4>
                    </div>            
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive">
                    <table class="table table-bordered" >
                        <tr>
                            <th> @lang('app.role')</th>
                            <th>@lang('app.description')</th>
                        </tr>
                        
                        @foreach ($roles as $role)
        
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->desc}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection