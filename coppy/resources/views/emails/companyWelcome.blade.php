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
        تم إنشاء حساب المتجر   <strong>{{ $branchName }}</strong> بنجاح <br>
        سيتم مراجعة البيانات و التواصل معكم في اقرب وقت
    </p>
    <br>
    <p>
        الرجاء الإحتفاظ ببيانات التسجيل الخاصة بكم لحين تفعيل الحساب <br>

        البريد الإلكتروني : {{ $email }} <br>
        كلمة المرور : *************
    </p>
</div>