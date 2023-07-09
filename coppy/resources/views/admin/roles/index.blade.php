@extends('admin.layouts.app') 

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
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                        <h4>@lang('app.roles')</h4>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right padding-top-10px">
                        {{-- <a href="{{ route('admin.role.create') }}" class="btn btn-classic btn-primary">@lang('app.addrole')</a> --}}
                        <a href="{{ route('admin.register') }}" class="btn btn-classic btn-success">@lang('app.addadmin')</a>
                    </div>              
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive">
                    <table class="table table-bordered" >
                        
                        <thead>
                            <tr>
                                <th> @lang('app.name')</th>
                                <th> @lang('app.count') </th>
                                <th> @lang('app.description') </th>
                            </tr>
                        </thead>
                        @foreach ($roles as $role)
        
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td><span class="badge badge-primary badge-pill">{{ $role->admins->count() }} {{ ucfirst(config('multiauth.prefix')) }}</span></td>
                                <td>{{ $role->desc }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection