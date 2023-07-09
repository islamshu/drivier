@section('main')
<script>
    var wpwlOptions = {style:"plain",locale: "ar",paymentTarget:"_top"}
</script> 
    <script src="https://oppwa.com/v1/paymentWidgets.js?checkoutId={{$responseData['id']}}"></script>
    <form action="{{ route('customer.payment.gateway.stc_pay')}}" class="paymentWidgets" data-brands="STC_PAY"></form>
@endsection