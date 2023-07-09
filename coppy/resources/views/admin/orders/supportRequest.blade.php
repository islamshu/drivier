@extends('admin.layouts.app')

@section('title')
@lang('app.supportRequest')
@endsection


@section('header')
<link href="{{ asset('public/assets/css/components/portlets/portlet.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/assets/css/ui-kit/tabs-accordian/custom-tabs.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/assets/css/ui-kit/tabs-accordian/custom-accordions.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/select2/select2.min.css') }}">
@endsection

@section('content')

@include('message')


<div class="widget portlet-widget">
    <div class="widget-content widget-content-area">
        <div class="portlet portlet-danger">
            <div class="portlet-title portlet-danger  d-flex justify-content-between">
                <div class="caption  align-self-center">

                    <h3>@lang('app.supportRequest')</h3>
                </div>
                
            </div>
            <div class="portlet-body portlet-common-body">

                @isset($supports)

                <div id="accordion">
                    @foreach ($supports as $support)

                    <div class="card mb-1">
                        <div class="card-header" id="headingOne{{ $support->id}}">
                            <h5 class="mb-0 mt-0">
                            <span class="" data-toggle="collapse" data-target="#collapse{{ $support->order->order_id}}" aria-expanded="true" aria-controls="collapseOne" role="menu">
                                {{ $support->company->company_name}} : {{ $support->order->order_id}}
                            </span>
                            </h5>
                        </div>

                        <div id="collapse{{ $support->order->order_id}}" class="collapse" aria-labelledby="headingOne{{ $support->id}}" data-parent="#accordion">
                            <div class="card-body">
                                @lang('app.branch') : {{ $support->customer->branch_name}}

                                <p class="mt-2 mb-2">
                                    {{ $support->message }}
                                </p>

                                @foreach ($support->replies as $reply)
                                    <div class="alert alert-default">
                                        <strong>{{ $reply->reply }}</strong>
                                    </div>
                                @endforeach

                                <form action="{{ url(route('admin.orders.supportStore' , [$support->id]))}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <textarea name="reply" class="form-control" id="" cols="30" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">@lang('app.save')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                        
                    @endforeach
                </div>

                {{ $supports->links() }}
                @endisset
                
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script src="{{ asset('public/assets/js/ui-kit/ui-accordions.js')}}"></script>
@endpush