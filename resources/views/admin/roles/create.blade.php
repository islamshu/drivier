@extends('admin.layouts.app') 

@section('title' , 'Add New Role')

@section('content')
@include('message')

<div class="row" id="cancel-row">
                
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Add New Role</h4>
                    </div>            
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('admin.role.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="role">Role Name</label>
                        <input type="text" placeholder="Give an awesome name for role" name="name" class="form-control" id="role" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Store</button>
                    <a href="{{ route('admin.roles') }}" class="btn btn-sm btn-danger float-right">Back</a>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection