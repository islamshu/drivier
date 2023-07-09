@extends('layouts.app')

@section('title')
@lang('app.ratings')
@endsection

@section('header')
<link href="{{ asset('assets/css/design-css/design.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/design-css/design-icons.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/components/custom-rating.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
@include('message')

@if ($existing)
<div class="row">
    <div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('app.ratingThank')</h4>
                    </div>                                                                        
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('app.driverRating')</h4>
                    </div>                                                                        
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form method="POST" action="{{ url(route('user.store.rating' , ['id' => $order->id]))}}">
                    @csrf
                    
                    @isset($questionairs)
                        @foreach ($questionairs as $question)
                            <div class="form-group">
                                @if (LaravelLocalization::getCurrentLocale() == 'ar')
                                    <h5> {{ $question->question_ar }} </h5>
                                @else 
                                    <h5>{{ $question->question_en }} </h5>
                                @endif
                                <div class="rating{{ $question->id }}" data-role="rating" id="rate{{ $question->id }}" data-size="large" data-on-rated="getRatingValue{{ $question->id }}"></div>
                                <input type="hidden" name="ratings[{{ $question->id }}]" id="question{{ $question->id }}">
                            </div>
                        @endforeach
                    @endisset
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-classic btn-primary">@lang('app.save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

@endsection



@push('script')
<script src="{{ asset('assets/js/design-js/design.js')}}"></script>
<script src="{{ asset('assets/js/components/custom-rating.js')}}"></script>

@isset($questionairs)
    @foreach ($questionairs as $question)
    <script>
        function getRatingValue{{ $question->id }}(value, star, widget){
            var id = $('.star').closest(".rating{{ $question->id }}").prop("id").replace('rate', '');
            $('#question' + id).val(value);
        }
    </script>
    @endforeach
@endisset

@endpush