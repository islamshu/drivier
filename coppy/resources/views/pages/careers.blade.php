@extends('layouts.landing')

@section('title')
@lang('app.homepage')
@endsection

@section('content')
<!-- bloc-28 -->
<div class="bloc tc-white bg-rm22-s21d-kwan-2-33 d-bloc bloc-bg-texture texture-darken" id="bloc-28">
    <div class="container bloc-xxl">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 offset-md-2 col-md-8">
                @include('message')
                <form action="{{ url(route('career.store'))}}" method="POST">
                    @csrf
                    <h1 class="mg-md text-lg-center">Be part of our growing team</h1>
                    <div class="form-group"><label>Name</label><input name="name" value="{{ old('name') }}" class="form-control" required /></div>
                    <div class="form-group"><label>Email</label><input name="email" value="{{ old('email') }}" class="form-control" type="email" required /></div>
                    <div class="form-group"><label>Job position your seeking<br></label><input name="subject" value="{{ old('subject') }}" class="form-control" /></div>
                    <div class="form-group"><label>Tell us something about you self</label><textarea name="message" class="form-control" rows="4" cols="50" required></textarea></div>
                    <div class="text-center"><button class="bloc-button btn btn-lg btn-persian-red btn-rd btn-margin-top" type="submit">Submit</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- bloc-28 END -->
@endsection