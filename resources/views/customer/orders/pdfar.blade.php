<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>بوليصة الشحن</title>
    <style>
        body {
            font-family: 'Aljazeera', sans-serif;
        }
    </style>
</head>
<body>

    <div>
            
        <div style="float: right; width: 30%;text-align: right;"  align="right">
            <img width="150" height="50" src="{{ asset('wtc_logo_gray.png')}}" alt="logo" class="logo-default" />
            <!--<h3>{{ Config('app.name')}}</h3>-->
            <p style="color: grey;margin: 0;">________________</p>
        </div>
    
        <div style="float: right; width: 30%;text-align: center;" align="center">
            <div>
            <p style="margin: 0px;"> {!! $svg !!}</p>
                <p style="margin: 0px;"> {{ $order->order_id }} </p>
            </div>
        </div>
        <div style="float: left; width: 30%; text-align: left;"  align="left">
            <div style="text-align:left;">
                <h3 class="package"> {{ $order->box_count}} / قطعة </h3>
                <p class="orderid" style="margin: 5px; float:left;">رقم الشحنة :  {{ $order->order_id}} </p>
                <p style="margin: 0px;">{!! $svg2 !!}</p>
                {{-- <p class="orderid" style="margin: 5px; float:left;">رقم الطلب :  {{ $order->reference_id}} </p> --}}
            </div>
        </div>
    
        <div style="clear: both; margin: 0pt; padding: 0pt; "></div>        
    </div>

    <br>
    <br>
    <br>

    <div>
        <div style="float: right; width: 48%; text-align: right;" dir="rtl" align="left">
            <div class="header">
                من / المرسل
            </div>

            <p style="color: #2E3258;margin:4;">إسم المرسل : <strong>{{ $order->company->company_name }}</strong> </p>
            <p style="color: #2E3258;margin:4;">رقم الهاتف : <strong>{{$order->company->company_phone }}</strong></p>
            <p style="color: #2E3258;margin:4;">العنوان : <strong>{{$order->company->city->name  }} , {{$order->company->company_address }}</strong></p>

            <br>

            <p style="color: #2E3258;margin:4;"><strong>عدد القطع: </strong> {{ $order->box_count ? $order->box_count : "N/A"}} </p>
        </div>
        <div style="float: left; width: 48%; text-align: right;" dir="rtl"  align="left">
            <div class="header">
                الي / المستلم
            </div>
            <p style="color: #2E3258;margin:4;">إسم المستلم :  <strong>{{ $order->name }}</strong> </p>
            <p style="color: #2E3258;margin:4;">رقم الهاتف : <strong>{{$order->phone }}</strong></p>
            <p style="color: #2E3258;margin:4;">العنوان : 
                <strong>
                    {{$order->city->name }} , {{ $order->region  }}
                </strong>
            </p>
            <br>
            <p style="color: #2E3258;margin:4;"><strong>التاريخ :  </strong> {{$order->created_at->format('d-m-Y') }}</p>
        </div>
        <div style="clear: both; margin: 0pt; padding: 0pt; "></div>        

    </div>
    <br>
    <div>
        
        <div style="float: right; width: 48%; text-align: right;" dir="rtl">
            <strong style="color: #2E3258;margin:4;">تفاصيل الطلب________________________________</strong>
            <p style="color: #2E3258;margin:4;">
                {{ $order->goods_type }}
            </p>
            <strong style="color: #2E3258;margin:4;">معلومات الدفع________________________________</strong>
            <table>
                
                <tr>
                    <td style="color: #2E3258;">المبلغ المطلوب تحصيله :</td>
                    <th style="color: #2E3258;"> {{ $order->cod_amount }} ريال </th>
                </tr>
                <tr>
                    <td style="color: #2E3258;">توقيع المستلم:</td>
                    <td style="color: #2E3258;">......................</td>
                </tr>
            </table>
        </div>
        <div style="clear: both; margin: 0pt; padding: 0pt; "></div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <pagebreak></pagebreak>

</body>
</html>