@extends('admin.layouts.app') 

@section('title')
@lang('app.edit')
@endsection

@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/timedropper/timedropper.min.css') }}">
@endsection

@section('content')

@include('message')

<div class="row" id="cancel-row">
                
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('app.edit') # {{ $company->company_name }} </h4>
                    </div>                 
                </div>  
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ url(route('companies.edit.update' , $company->id))}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.storename')</label>
                                <input type="text" name="company_name" value="{{ $company->company_name }}" placeholder="@lang('app.name')" class="form-control">
                            </div>  
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.phone')</label>
                                <input type="text" name="company_phone" value="{{ $company->company_phone }}" placeholder="@lang('app.phone')" class="form-control">
                            </div>  
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('app.city')</label>
                                <select name="city_id" class="form-control mb-4">
                                    @isset($cities)
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id}}" {{ $company->city_id == $city->id ? 'selected' : ''}}>{{ $city->name }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p>@lang('app.calculateDeliveryFees')</p>
                    <br>
                    <div class="row">
                        
                        <div class="col-md-12">
                            <p>@lang('app.fast_deliverey')</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('app.km')</label>
                                        <input type="text" name="km_fast" value="{{ $company->km_fast }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('app.ras')</label>
                                        <input type="text" name="fee_fast" value="{{ $company->fee_fast }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('app.pluskm')</label>
                                        <input type="text" name="km_fee_fast" value="{{ $company->km_fee_fast }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('app.priceperorder')</label>
                                <select class="form-control" name="delivery_type" id="delivery_type">
                                    <option value="0" {{ $company->delivery_type == 0 ? 'selected' : ''}} >@lang('app.perorder')</option>
                                    <option value="1" {{ $company->delivery_type == 1 ? 'selected' : ''}}>@lang('app.contract')</option>
                                </select>
                            </div>
                            <div class="form-group" id="contract_image" style="display: none;">
                                <label>@lang('app.contract_image')</label>
                                <input type="file" name="contract_image" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                @isset($company->contract_image)
                                    @if ($company->contract_image)
                                    <h6>@lang('app.contract_image')</h6> <br>
                                    <img src="{{ url('/' . $company->contract_image)}}" alt="@lang('app.contract_image')" width="300" height="300" class="img-thumbnail">
                                    @endif
                                @endisset
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-classic btn-primary">@lang('app.update')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>



@endsection
@push('script')
<script src="{{ asset('public/plugins/timedropper/timedropper.min.js') }}"></script>
<script>
    $(function() {
        $(document).on('change' , '#delivery_type' , function() {
            var id = $(this).val();

            if (id == 1) {
                $('#contract_image').fadeToggle();
            }else {
                $('#contract_image').hide();
            }
        })
    });
</script>
@endpush
