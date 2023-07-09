<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Auth;
class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('customer.auth:customer');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Auth::guard('customer')->user();
        return view('customer.payments.index' ,compact('customer'));
    }

    /**
     * Make Payment - Hyperpay
     */
    public function getCheckOutId(Request $request){

        $url = "https://oppwa.com/v1/checkouts";
            //MADA
        $data = "entityId=8acda4ca75da9d130175ee815abe333b" .
        "&amount=". request()->get('amount') .
            "&currency=SAR" .
            "&paymentType=DB".
            "&merchantTransactionId=".$random = random_int(00000, 99999).
            "&customer.email=".request()->get('email') .
            "&billing.street1=".request()->get('street1') .
            "&billing.city=" .request()->get('city') .
            "&billing.state=".request()->get('state') .
            "&billing.country=SA" .
            "&billing.postcode=".request()->get('postcode') .
            "&customer.givenName=".request()->get('givenName') .
            "&customer.surname=".request()->get('surname') ;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer OGFjZGE0Y2E3NWRhOWQxMzAxNzVlZTgwOGYwNTMzMzN8QWNlOUJ3YjdDZw=='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $res = json_decode($responseData,true);

        $view = view('customer.payments.formAjax')->with(['responseData' => $res ])->renderSections();

        return response()->json(['status' => true,'content' => $view['main']]);

    }
    /**
     * Credit Card
     */
    public function getCheckOutIdCredit(Request $request){

        $url = "https://oppwa.com/v1/checkouts";
        //VISA MASTR STC_PAY
        $data = "entityId=8acda4ca75da9d130175ee80e52b3337" . 
            "&amount=". request()->get('amount') .
            "&currency=SAR" .
            "&paymentType=DB".
            "&merchantTransactionId=".$random = random_int(00000, 99999).
            "&customer.email=".request()->get('email') .
            "&billing.street1=".request()->get('street1') .
            "&billing.city=" .request()->get('city') .
            "&billing.state=".request()->get('state') .
            "&billing.country=SA" .
            "&billing.postcode=".request()->get('postcode') .
            "&customer.givenName=".request()->get('givenName') .
            "&customer.surname=".request()->get('surname');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGFjZGE0Y2E3NWRhOWQxMzAxNzVlZTgwOGYwNTMzMzN8QWNlOUJ3YjdDZw=='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $res = json_decode($responseData,true);
        $view = view('customer.payments.formAjaxCredit')->with(['responseData' => $res ])->renderSections();
        return response()->json(['status' => true,'content' => $view['main']]);

    }

    /**
     * STC PAY
     */
    public function getCheckOutId_STC_PAY(Request $request){

        $url = "https://oppwa.com/v1/checkouts";
        //VISA MASTR STC_PAY
        $data = "entityId=8acda4ca75da9d130175ee80e52b3337" .
            "&amount=". request()->get('amount') .
            "&currency=SAR" .
            "&paymentType=DB".
            "&merchantTransactionId=".$random = random_int(00000, 99999).
            "&customer.email=".request()->get('email') .
            "&billing.street1=".request()->get('street1') .
            "&billing.city=" .request()->get('city') .
            "&billing.state=".request()->get('state') .
            "&billing.country=SA" .
            "&billing.postcode=".request()->get('postcode') .
            "&customer.givenName=".request()->get('givenName') .
            "&customer.surname=".request()->get('surname') ; 


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGFjZGE0Y2E3NWRhOWQxMzAxNzVlZTgwOGYwNTMzMzN8QWNlOUJ3YjdDZw=='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $res = json_decode($responseData,true);
        $view = view('customer.payments.formAjaxSTC_PAY')->with(['responseData' => $res ])->renderSections();
        return response()->json(['status' => true,'content' => $view['main']]);

    }

    /**
     * create Payment Form
     */

    public function payment_gateway() {

        if (request('id') && request('resourcePath')) {
            $payment_status = $this->getPaymentStatus(request('id'), request('resourcePath'));

            if (isset($payment_status['result']['code'])) {
                    $successCodePattern = '/^(000\.000\.|000\.100\.1|000\.[36])/';
                    $successManualReviewCodePattern = '/^(000\.400\.0|000\.400\.100)/';
                    //success status
                    if (preg_match($successCodePattern, $payment_status['result']['code']) || preg_match($successManualReviewCodePattern, $payment_status['result']['code'])) {
                        $success ='1';
                    } else {
                        //fail case
                        $success='0';
                        $failed_msg = $payment_status['result']['description'];
                    }
            }
                
            if ($success=='1') { //success payment id -> transaction bank id   
            
            
                $showSuccessPaymentMessage = true;
                $user= Auth::guard('customer')->user();

                Payment::create([
                    'customer_id'   =>  $user->id,
                    'company_id'    =>  $user->company_id,
                    'amount_id'     =>  $payment_status['id'],
                    'paymentType'   =>  $payment_status['paymentType'],
                    'paymentBrand'  =>  $payment_status['paymentBrand'],
                    'amount'        =>  $payment_status['amount'],
                    'currency'      =>  $payment_status['currency'],
                    'bin'           =>  $payment_status['card']['bin'],
                    'last4Digits'   =>  $payment_status['card']['last4Digits'],
                    'expiryMonth'   =>  $payment_status ['card']['expiryMonth'],
                    'expiryYear'    =>  $payment_status ['card']['expiryYear'],
                    'ip'            =>  $payment_status['customer']['ip'],
                    'ipCountry'     =>  $payment_status['customer']['ipCountry'],
                ]);

                $user->update(array(
                    'amount' => $user->amount = $user->amount + $payment_status['amount'],
                ));
                return redirect()->back()->with(['type' => 'success','success', 'تم الدفع بنجاح!']);
            } else {
                $showFailPaymentMessage = true;
                return redirect()->back()->with(['type' => 'danger','message' => 'فشلت عملية الدفع!']);
            }
        }
        return view('customer.payments.hyperpay');

    }

    /**
     * Get Credit Card Payment Status
     * 
     */
    public function payment_gateway_credit() {

        if (request('id') && request('resourcePath')) {
            $payment_status = $this->getPaymentStatusCredit(request('id'), request('resourcePath'));
            if (isset($payment_status['result']['code'])) {
                $successCodePattern = '/^(000\.000\.|000\.100\.1|000\.[36])/';
                $successManualReviewCodePattern = '/^(000\.400\.0|000\.400\.100)/';
                //success status
                if (preg_match($successCodePattern, $payment_status['result']['code']) || preg_match($successManualReviewCodePattern, $payment_status['result']['code'])) {
                    $success ='1';
                } else {
                    //fail case
                    $success='0';
                    $failed_msg = $payment_status['result']['description'];
                }
            }
            if ($success=='1') { //success payment id -> transaction bank id


                $showSuccessPaymentMessage = true;
                $user= Auth::guard('customer')->user();

                Payment::create([

                    'customer_id'   =>  $user->id,
                    'company_id'    =>  $user->company_id,
                    'amount_id'     =>  $payment_status['id'],
                    'paymentType'   =>  $payment_status['paymentType'],
                    'paymentBrand'  =>  $payment_status['paymentBrand'],
                    'amount'        =>  $payment_status['amount'],
                    'currency'      =>  $payment_status['currency'],
                    'bin'           =>  $payment_status['card']['bin'],
                    'last4Digits'   =>  $payment_status['card']['last4Digits'],
                    'expiryMonth'   =>  $payment_status ['card']['expiryMonth'],
                    'expiryYear'    =>  $payment_status ['card']['expiryYear'],
                    'ip'            =>  $payment_status['customer']['ip'],
                    'ipCountry'     =>  $payment_status['customer']['ipCountry'],
                ]);

                $user->update(array(
                    'amount' => $user->amount = $user->amount + $payment_status['amount'],
                ));
                return redirect()->back()->with(['type' => 'success','message' => 'تم الدفع بنجاح!']);
            } else {
                $showFailPaymentMessage = true;
                return redirect()->back()->with(['type' => 'danger','message'  => 'فشلت عملية الدفع!']);
            }
        }
        return view('customer.payments.hyperpay');

    }

    /**
     * Get STC PAY Payment Status
     */
    public function payment_gateway_stc_pay() {
        if (request('id') && request('resourcePath')) {
            $payment_status = $this->getPaymentStatusCredit(request('id'), request('resourcePath'));

            if (isset($payment_status['result']['code'])) {
                $successCodePattern = '/^(000\.000\.|000\.100\.1|000\.[36])/';
                $successManualReviewCodePattern = '/^(000\.400\.0|000\.400\.100)/';
                //success status
                if (preg_match($successCodePattern, $payment_status['result']['code']) || preg_match($successManualReviewCodePattern, $payment_status['result']['code'])) {
                    $success ='1';
                } else {
                    //fail case
                    $success='0';
                    $failed_msg = $payment_status['result']['description'];
                }
            }

            if ($success=='1') { //success payment id -> transaction bank id


                $showSuccessPaymentMessage = true;
                $user= Auth::guard('customer')->user();

                Payment::create([
                    'customer_id'   =>  $user->id,
                    'company_id'    =>  $user->company_id,
                    'amount_id'     =>  $payment_status['id'],
                    'paymentType'   =>  $payment_status['paymentType'],
                    'paymentBrand'  =>  $payment_status['paymentBrand'],
                    'amount'        =>  $payment_status['amount'],
                    'currency'      =>  $payment_status['currency'],
                    'bin'           =>  $payment_status['card']['bin'],
                    'last4Digits'   =>  $payment_status['card']['last4Digits'],
                    'expiryMonth'   =>  $payment_status ['card']['expiryMonth'],
                    'expiryYear'    =>  $payment_status ['card']['expiryYear'],
                    'ip'            =>  $payment_status['customer']['ip'],
                    'ipCountry'     =>  $payment_status['customer']['ipCountry'],
                ]);

                $user->update(array(
                    'amount' => $user->amount = $user->amount + $payment_status['amount'],
                ));
                return redirect()->back()->with(['type' => 'success', 'message' => 'تم الدفع بنجاح!']);
            } else {
                $showFailPaymentMessage = true;
                return redirect()->back()->with(['type' => 'danger','message'  =>  'فشلت عملية الدفع!']);
            }
        }
        return view('customer.payments.hyperpay');

    }

    /**
     * Get Payment Status
     */
    public function getPaymentStatus($id, $resourcepath) {
        $url = "https://oppwa.com/";
        $url .= $resourcepath;
        $url .= "?entityId=8acda4ca75da9d130175ee815abe333b";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer OGFjZGE0Y2E3NWRhOWQxMzAxNzVlZTgwOGYwNTMzMzN8QWNlOUJ3YjdDZw=='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return json_decode($responseData, true);

    }
    /**
     * Get Credit Card Payment Status
     */
    public function getPaymentStatusCredit($id, $resourcepath) {


        $url = "https://oppwa.com/";
        $url .= $resourcepath;
        $url .= "?entityId=8acda4ca75da9d130175ee80e52b3337";//VISA MASTER STC_PAY

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGFjZGE0Y2E3NWRhOWQxMzAxNzVlZTgwOGYwNTMzMzN8QWNlOUJ3YjdDZw=='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return json_decode($responseData, true);

    }
}
