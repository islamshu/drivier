@extends('admin.layouts.app') 

@section('title' , 'Edit Order')

@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
<style>
    .input-control.required input { border: 1px dashed #b7b7b7; border-radius: 2px; }
    label { color: #3b3f5c; margin-bottom: 14px; }
    .form-control::-webkit-input-placeholder { color: #888ea8; font-size: 15px; }
    .form-control::-ms-input-placeholder { color: #888ea8; font-size: 15px; }
    .form-control::-moz-placeholder { color: #888ea8; font-size: 15px; }
    .form-control {
        border: 1px solid #ccc;
        color: #888ea8;
        font-size: 15px;
        border-radius: 2px;
    }
    .form-control:focus { border-color: #f1f3f1; border-left: solid 3px #3862f5; }
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
                        <h4>Edit Order</h4>
                    </div>                                                                        
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ url(route('orders.edit.update' , [$order->id]))}}" method="POST">
                    @csrf
                    <div class="form-row mb-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputEmail4">Reference ID</label>
                                <input type="text" class="form-control" value="{{ $order->reference_id }}" name="reference_id" placeholder="Reference ID">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputEmail4">Recipient Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $order->name }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ph-number">Phone</label>
                                <input type="text" class="form-control mb-4" value="{{ $order->phone }}"  name="phone" id="ph-number">
                            </div>
                        </div>
                    </div>
                    
                    @if ($order->type == 1)
                        <div class="form-group" id="delivery_company">
                            <label for="inputEmail4">Delivery Company</label>
                            <input type="text" class="form-control" name="delivery_company" value="{{ $order->delivery_company}}">
                        </div>
                    @endif
                    
                    <div class="form-row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Box Count </label>
                                <input id="box_count" type="text" value="{{ $order->box_count }}" name="box_count">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail4">Amount </label>
                                <div class="input-group btn-group mb-4">
                                    <input id="cod_amount" type="text" class="form-control" name="cod_amount" value="{{ $order->cod_amount }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-classic btn-primary">Edit order</button>
                    
                </form>
            </div>
        </div>
    </div>
</div>
        
@endsection

@push('script')
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('plugins/select2/custom-select2.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/input-mask/input-mask.js?v=1') }}"></script>
<script src="{{ asset('plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{ asset('plugins/bootstrap-touchspin/custom-bootstrap-touchspin.js?v=2')}}"></script>


@endpush
