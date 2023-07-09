<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Airwaybill</title>
    <style>
        body {
            font-family: 'Aljazeera', sans-serif;
        }
    </style>
</head>
<body>

    <div>
            
        <div style="float: left; width: 30%;"  align="left">
            <img width="150" height="50" src="{{ asset('wtc_logo_gray.png')}}" alt="logo" class="logo-default" />
            <!--<h3>{{{ Config('app.name')}}}</h3>-->
            <p style="color: grey;margin: 0;">________________</p>
            
        </div>
    
        <div style="float: left; width: 30%;text-align: center;" align="center">
            <div>
            <p style="margin: 0px;"> {!!  $svg !!}</p>
                <p style="; margin: 0px;"> {{ $order->order_id }} </p>
            </div>
        </div>
        <div style="float: right; width: 30%; text-align: right;"  align="right">
                <div style="text-align:right;">
                    <h3 class="package"> {{ $order->box_count}} / Package</h3>
                <p class="orderid" style="margin: 5px; float:left;">Order ID : {{ $order->order_id}} </p>
                <p style="margin: 0px;">{!!  $svg2 !!}</p>
                </div>
        </div>
    
        <div style="clear: both; margin: 0pt; padding: 0pt; "></div>        
    </div>

    <br>
    <br>
    <br>

    <div>
        <div style="float: left; width: 48%;"  align="left">
            <div class="header">
                From / Sender
            </div>

            <p style="color: #2E3258;margin:4;">Name : <strong>{{ $order->company->company_name }}</strong> </p>
            <p style="color: #2E3258;margin:4;">Phone : <strong>{{$order->company->company_phone }}</strong></p>
            <p style="color: #2E3258;margin:4;">Address : <strong>{{$order->company->city->name }} ,{{$order->company->company_address }}</strong></p>

            <br>

            <p style="color: #2E3258;margin:4;"><strong>Box Count: </strong> {{ $order->box_count ? $order->box_count : "N/A"}} </p>
        </div>
        <div style="float: right; width: 48%; text-align: left;"  align="left">
            <div class="header">
                To / Recipient
            </div>
            <p style="color: #2E3258;margin:4;">Name :  <strong>{{ $order->name }}</strong> </p>
            <p style="color: #2E3258;margin:4;">Phone : <strong>{{$order->phone }}</strong></p>
            <p style="color: #2E3258;margin:4;">Address : 

                <strong>
                    {{$order->city->name }} , {{ $order->region  }}
                 </strong>

            <br>
            <p style="color: #2E3258;margin:4;"><strong>Created Date:  </strong> {{ date('d M Y', $order->created_at->timestamp) }}</p>
        </div>
        <div style="clear: both; margin: 0pt; padding: 0pt; "></div>        

    </div>
    <br>
    <div>
        <div style="float: right; width: 48%; text-align: left;"  align="left">

            <strong style="color: #2E3258;margin:4;">Orders Details________________________________</strong>
            <p style="color: #2E3258;margin:4;">
                {{ $order->goods_type }}
            </p>
            <strong style="color: #2E3258;margin:4;">Payment Info________________________________</strong>
            <table>
                
                <tr>
                    <td style="color: #2E3258;margin:4;">Pick up total collectible :</td>
                    <th style="color: #2E3258;margin:4;"> {{ $order->cod_amount }} SAR </th>
                </tr>
                <tr>
                    <td style="color: #2E3258;margin:4;">Recipient's signature:</td>
                    <td style="color: #2E3258;margin:4;">......................</td>
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