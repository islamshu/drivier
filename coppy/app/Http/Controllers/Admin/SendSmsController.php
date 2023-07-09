<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Driver;
class SendSmsController extends Controller
{
    /**
     * Construct
     * 
     * 
     */
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
        $this->middleware('role:super');
    }

    /**
     * Index
     */
    public function index()
    {
        return view('admin.sms.index');
    }


    public function create_sendSms(Request $request) {
        $this->validate($request,[
            'sms' => 'required',
        ],[] , ['sms' => 'الرسالة']);

        $phonenumber = Driver::all();
       foreach ($phonenumber as $item){

           $mobileNumber = '+' . $this->convertPhoneNumber($item->phone);
            if ($this->is_connected()) {
                    $message = $request->sms;
                    $this->sendSMS($mobileNumber, $message);
            }
       }

       return view('admin.transmissions.sendSMS')->with(['type' => 'success', 'message' => trans('app.sendMessageSuccess')]);
    }





// SMS API

    public function convertPhoneNumber($phone)
    {
        $standard = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        $eastern_arabic_symbols = array("٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩");
        $phone = str_replace($eastern_arabic_symbols, $standard, $phone);
        if (substr($phone, 0, 5) == '00966') {
            $phone = str_replace("00966", "966", $phone);
            $phone = ltrim($phone, '966');
            $phone = ltrim($phone, '0');
            $phone = '20' . $phone;
        } else if (substr($phone, 0, 3) == '966') {
            //IF PHONE NUMBER HAVING 20 and 0 after that
            $phone = ltrim($phone, '966');
            $phone = ltrim($phone, '0');
            $phone = '966' . $phone;
        } //IF PHONE NUMBER NOT HAVING 20
        else if (substr($phone, 0, 3) != '966' && substr($phone, 0, 5) != '00966') {
            $phone = ltrim($phone, '0');
            $phone = '966' . $phone;
        }
        $phone = str_replace("+966", "966", $phone);
        return $phone;
    }

    //send SMS phone numper
    
    public function sendSMS($mobileNumber, $message)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://auth.routee.net/oauth/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=client_credentials",
            CURLOPT_HTTPHEADER => array(
                "authorization: Basic NWZhZDAxZTNiZTAxYmQwMDAxNzc3OTY5OnNWMzhvZms5cTY=",
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response);
        }


        $smscurl = curl_init();

        curl_setopt_array($smscurl, array(
            CURLOPT_URL => "https://connect.routee.net/sms",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{ \"body\": \" $message \",\"to\" : \"$mobileNumber\",\"from\": \"WtcDelivery\"}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer " . $response->access_token,
                "content-type: application/json"
            ),
        ));

        $responsecurl = curl_exec($smscurl);
        $error = curl_error($smscurl);

        curl_close($smscurl);

        if ($error) {
            return false;
        } else {
            return $responsecurl;
        }


    }

    protected function is_connected()
    {
        $connnected = @fsockopen("www.google.com", 443);

        if ($connnected) {
            $is_conn = true;
            fclose($connnected);
        } else {
            $is_conn = false;
        }

        return $is_conn;
    }

    protected function sendNotification($order_id, $token)
    {


        $url = "https://fcm.googleapis.com/fcm/send";

        $notification = array(
            'title' => 'لديك طلب جديد  , You have new Order',
            'body' => 'تم إضافة طلب جديد من قبل الإدارة #' . $order_id,
        );

        $fields = array
        (
            'to' => $token,
            'notification' => $notification
        );

        $headers = array
        (
            'Authorization: key=APA91bFpP4PXg19cAQypDxgX4_OC5uFTay3tC06l1AWa9i9AMEEmtjHUubjXSTtVnfHP1w7qZYlPDibg648c1bt06jmMp6F6GR2s4nl4rRgDQKzE6XWCTWnz0VGFMktK8OMf58s6i1ek',
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // new
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Oops! FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);

    }
}
