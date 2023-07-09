@extends('admin.layouts.app') 

@section('title' , 'Edit this Role')

@section('content')

<div class="row" id="cancel-row">
                
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Edit this Role</h4>
                    </div>            
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('admin.role.update', $role->id) }}" method="post">
                    @csrf @method('patch')
                    <div class="form-group">
                        <label for="role">Role Name</label>
                        <input type="text" value="{{ $role->name }}" name="name" class="form-control" id="role">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Change</button>
                    <a href="{{ route('admin.roles') }}" class="btn btn-danger btn-sm float-right">Back</a>
                </form>
            </div>
        </div>
    </div>

</div>


@endsection