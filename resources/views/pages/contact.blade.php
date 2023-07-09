@extends('layouts.landing')

@section('title')
@lang('app.homepage')
@endsection


@section('content')
<!-- bloc-24 -->
<div class="bloc bloc-bg-texture texture-darken-strong tc-white bg-shutterstock-1251741952 l-bloc" id="bloc-24">
    <div class="container bloc-xxl">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 offset-md-2 col-md-8">
                @include('message')
                <form action="{{ url(route('contact.store'))}}"  method="POST">
                    @csrf
                    <div class="form-group"><label>Name</label><input name="name" value="{{ old('name') }}" class="form-control" required /></div>
                    <div class="form-group"><label>Email</label><input name="email" value="{{ old('email') }}" class="form-control" type="email" required /></div>
                    <div class="form-group"><label>I want to know more about:</label><input name="subject" value="{{ old('subject') }}"  class="form-control" id="input_1829_36806" required/></div>
                    <div class="form-group"><label>Message</label><textarea name="message" class="form-control" rows="4" cols="50" required></textarea></div>
                    <div class="text-center"><button class="bloc-button btn btn-lg btn-persian-red btn-rd btn-margin-top" type="submit">Submit</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- bloc-24 END -->
@endsection