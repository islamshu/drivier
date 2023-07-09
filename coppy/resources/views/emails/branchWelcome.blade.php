<link rel="stylesheet" href="{{ asset('public/fonts/font-ar.css')}}">

<style>
    .email {
        font-family: 'Al-Jazeera-Arabic' ,  "Open Sans", sans-serif;
        font-weight: 600;
        font-style: normal;
        direction: rtl !important;
    }
</style>


<div class="email" style="direction: rtl; text-align:center;">
    <br>
    <img alt="logo" width="200"  src="{{ url('/public/wtc_logo_gray.png')}}">

    
    <h3>مرحبا , {{ $name }} </h3>
    <p>
        تم إضافتك كفرع للشركة بإسم <strong> {{ $branchName}} </strong>
    </p>
    <br>
    <p>
        إضغط هنا لتسجيل الدخول
       <a target="_blank" href="{{ url(route('customer.login'))}}" class="btn btn-primary" >تسجيل الدخول</a>
    </p>
</div>