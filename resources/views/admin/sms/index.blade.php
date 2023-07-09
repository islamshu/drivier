@extends('admin.layouts.app')

@section('title')
    @lang('app.send_sms')
@endsection

@section('header')
   <style></style>
@endsection
@section('content')
    @include('message')

    <form action="{{ url(route('sendsms.store'))}}" method="post">
        @csrf

        <div class="form-group">
        <label for="exampleFormControlTextarea1"> @lang('app.send_sms')</label>
        <textarea class="form-control"  rows="3" required name="sms"></textarea>
    </div>

    <button type="submit" class="btn btn-primary btn-block">@lang('app.send_sms')</button>
   </form>
@endsection
