@extends('admin.layouts.app')


@section('title')
@lang('app.questions')
@endsection

@section('content')
@include('message')
<div class="row" id="cancel-row">
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('app.questions')</h4>
                    </div>                 
                </div>  
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ url(route('questionair.store'))}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>@lang('app.question_ar')</label>
                        <input type="text" name="question_ar" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>@lang('app.question_en')</label>
                        <input type="text" name="question_en" class="form-control">
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