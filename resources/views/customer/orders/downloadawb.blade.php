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

        @isset($allorders)
            @foreach ($allorders as $order)

            <br>
            <div>            
                <div style="float: left; width: 30%;"  align="left">
                    <img height="50" width="170" src="{{ asset('assets/layouts/layout/img/logolight.jpeg')}}" alt="logo" class="logo-default" />
                    <p style="color: grey;margin: 0;">________________</p>
                </div>
            
                <div style="float: left; width: 30%;text-align: center;" align="center">
                    <div>
                        <?php 
                            $svg = $generator->getBarcode($order->order_id, $generator::TYPE_CODE_128 , 2 , 50);
                        ?>
                        <p style="margin: 0px;"> {!! str_replace('<?xml version="1.0" standalone="no" ?>', "" , $svg) !!}</p>
                        <p style="font-size: 11px; margin: 0px;"> {{ $order->order_id }} </p>
                    </div>
                </div>
                <div style="float: right; width: 30%; text-align: right;"  align="right">
                        <div style="text-align:right;">
                            <h3 class="package">package: 1/1</h3>
                        <p class="orderid" style="margin: 5px; float:left;">Order ID {{ $order->order_id}} </p>
                        <?php 
                            $svg2 = $generator->getBarcode($order->order_id, $generator::TYPE_CODE_128 , 2 , 15);
                        ?>
                        <p style="margin: 0px;">{!! str_replace('<?xml version="1.0" standalone="no" ?>', "" , $svg2) !!}</p>
                        </div>
                </div>
            
                <div style="clear: both; margin: 0pt; padding: 0pt; "></div>        
            </div>
    
            <br>
            <div>
                <div style="float: left; width: 48%;"  align="left">
                    <div class="header">
                        From / Sender
                    </div>
        
                    <p style="font-size:12px;color: #2E3258;margin:4;">Name : <strong>{{ $order->sender_name }}</strong> </p>
                    <p style="font-size:12px;color: #2E3258;margin:4;">Phone : <strong>{{$order->sender_prefix . $order->sender_phone}}</strong></p>
                    <p style="font-size:12px;color: #2E3258;margin:4;">Location : <strong>Apt: {{$order->sender_apartment}}  Bldg/Str: {{$order->sender_street}}/Lmk: {{$order->sender_landmark}}</strong></p>
    
                    <br>
    
                    <p style="font-size:13px;color: #2E3258;margin:4;"><strong>Reference #: </strong> {{ $order->reference_id ? $order->reference_id : "N/A"}} </p>
                    <p style="font-size:13px;color: #2E3258;margin:4;"><strong>Parcel Details: </strong> {{ $order->item_description ? $order->item_description : "N/A"}} </p>
                </div>
                <div style="float: right; width: 48%; text-align: left;"  align="left">
                    <div class="header">
                        To / Recipient
                    </div>
                    <p style="font-size:12px;color: #2E3258;margin:4;">Name :  <strong>{{ $order->customer_name }}</strong> </p>
                    <p style="font-size:12px;color: #2E3258;margin:4;">Phone : <strong>{{$order->customer_prefix . $order->customer_phone}}</strong></p>
                    <p style="font-size:12px;color: #2E3258;margin:4;">Location : <strong>Apt: {{$order->customer_apartment}}  Bldg/Str: {{$order->customer_street}}/Lmk: {{$order->customer_landmark}}</strong> </p>
                    <br>
                    <p style="font-size:13px;color: #2E3258;margin:4;"><strong>Promise Date:  </strong> {{ date('d M Y', $order->created_at->timestamp) }}</p>
                </div>
                <div style="clear: both; margin: 0pt; padding: 0pt; "></div>        
    
            </div>
            <br>
            <div>
                <div style="float: left; width: 48%;"  align="left">
                    <strong style="font-size:13px;color: #2E3258;margin:4;">Service Type________________________________</strong>
                    <table>
                        <tr>
                            <td style="font-size:12px;color: #2E3258;margin:4;">Service Type</td>
                            <th style="font-size:12px;color: #2E3258;margin:4;">Express Delivery</th>
                        </tr>
    
                        <tr>
                            <td style="font-size:12px;color: #2E3258;margin:4;">Delivery Charge Payer:</td>
                            <th style="font-size:12px;color: #2E3258;margin:4;"> {{ $order->delivery_charge }} </th>
                        </tr>
    
                        <tr>
                            <td style="font-size:12px;color: #2E3258;margin:4;">Payment type:</td>
                            <th style="font-size:12px;color: #2E3258;margin:4;"> {{ $order->payment_type }} </th>
                        </tr>
                    </table>
                </div>
                <div style="float: right; width: 48%; text-align: left;"  align="left">
                    <strong style="font-size:13px;color: #2E3258;margin:4;">Payment Info________________________________</strong>
                    <table>
                        <tr>
                            <td style="font-size:12px;color: #2E3258;margin:4;">Pick up total collectible :</td>
                            <th style="font-size:12px;color: #2E3258;margin:4;"> {{ $order->value }} SAR </th>
                        </tr>
                        <tr>
                            <td style="font-size:12px;color: #2E3258;margin:4;">Drop off total collectible:</td>
                            <th style="font-size:12px;color: #2E3258;margin:4;"> {{ $order->COD_amount }} SAR </th>
                        </tr>
                    </table>
                </div>
                <div style="clear: both; margin: 0pt; padding: 0pt; "></div>
            </div>
    
    
            <div>
                <div style="float: left; width: 48%;"  align="left">
                    <strong style="font-size:12px;color: #2E3258;margin:4;">Shipper's signature and Authorisation___________________</strong>
                    <table>
                        <tr>
                            <td style="font-size:12px;color: #2E3258;margin:4;">Sender's signature:</td>
                            <td style="font-size:12px;color: #2E3258;margin:4;">......................</td>
                            <th style="font-size:12px;color: #2E3258;margin:4;"> {{ date('M d, - H:i', $order->created_at->timestamp) }} </th>
                        </tr>
    
                        <tr>
                            <td style="font-size:12px;color: #2E3258;margin:4;">Courier agent name:</td>
                            <td style="font-size:12px;color: #2E3258;margin:4;">.....................</td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;color: #2E3258;margin:4;">Courier agent signature:</td>
                            <td style="font-size:12px;color: #2E3258;margin:4;">.........................</td>
                            <th style="font-size:12px;color: #2E3258;margin:4;"> {{ date('M d, - H:i', $order->created_at->timestamp) }} </th>
                        </tr>
                    </table>
                </div>
                <div style="float: right; width: 48%; text-align: left;"  align="left">
                    <strong style="font-size:12px;color: #2E3258;margin:4;">Recipient's signature and Authorisation___________________</strong>
                    <p style="font-size:12px;color: #2E3258;margin:4;">Received above shipment in good order and condition</p>
                    <table>
                        <tr>
                            <td style="font-size:12px;color: #2E3258;margin:4;">Recipient's signature:</td>
                            <td style="font-size:12px;color: #2E3258;margin:4;">......................</td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;color: #2E3258;margin:4;">Date and Time:</td>
                            <th style="font-size:12px;color: #2E3258;margin:4;"> {{ date('M d,Y', $order->created_at->timestamp) }} </th>
                        </tr>
                    </table>
                </div>
                <div style="clear: both; margin: 0pt; padding: 0pt; "></div>
            </div>
                    ---------------------------------------------------------------------------------------------------------------------------------------------

                    <br>
            @endforeach
        @endisset
    </body>
</html>