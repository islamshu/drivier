<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Driver;
use App\Models\Order;
use App\Models\Alert;
use App\Models\Company;
use App\Models\Notification;
use App\Models\Support;
use App\Models\OrderLog;
use Auth;
use DB;
use PDF;
use Carbon\Carbon;
use Picqer\Barcode\BarcodeGeneratorSVG;

class DriverController extends Controller
{
    private function notFoundMessage($msg = null)
    {

        if ($msg != null) {
            return [
                'code' => 404,
                'message' => $msg,
                'success' => false,
            ];
        }else {
            return [
                'code' => 404,
                'message' => 'حدث خطأ ما , حاول مرة اخرى',
                'success' => false,
            ];
        }

    }

    private function successfulMessage($code, $message, $status, $payload)
    {

        return [
            'code' => $code,
            'message' => $message,
            'success' => $status,
            'data' => $payload,
        ];

    }


    // Work
    public function login(Request $request)
    {


        if(Auth::guard('driver')->attempt(['email' => request('email'), 'password' => request('password')]) || Auth::guard('driver')->attempt(['phone' => request('email'), 'password' => request('password')])){ 

            
            $driver = Auth::guard('driver')->user(); 

            if ($driver->active == 1) {

                $api_token = Str::random(100);
                $user = Driver::find($driver->id);

                $user->update(array('api_token' => $api_token , 'device_token' => $request->device_token, 'online' => 1 ));
                
                $driver['city_id'] = $driver->city->name;
                $driver['license_image'] = url('/' . $driver->license_image);
                $driver['car_image'] = url('/' . $driver->car_image);
                $driver['driver_image'] = url('/' . $driver->driver_image);
                $driver['insurance_image'] = url('/' . $driver->insurance_image);
                $driver['state_image'] = url('/' . $driver->state_image);
                $driver['device_token'] = $driver->device_token;
                $driver['api_token'] = $api_token;
                $driver['vehicle_name'] = $driver->vehicle->carName;
                $driver['vehicle_color'] = $driver->vehicle->color;
                $driver['vehicle_body_type'] = $driver->vehicle->body_type;
                $driver['vehicle_reg_number'] = $driver->vehicle->reg_number;
                $driver['vehicle_year'] = $driver->vehicle->year;
                $driver['vehicle_capacity'] = $driver->vehicle->capacity;

                return $this->successfulMessage(200,"تم تسجيل دخولك بنجاح" , "success" , $driver);

            }else {
                $response = $this->notFoundMessage('حسابك قيد المراجعة من قبل الإدارة او محظور');
            }
        }
        else{ 
            $response = $this->notFoundMessage('بيانات الاعتماد هذه غير متطابقة مع البيانات المسجلة لدينا');
        }
        
        return response($response);
    }

    /**
     * Change Driver Device Token
     */

     public function device_token(Request $request) {

        $this->validate($request , [
            'user_id' => 'required|not_in:0',
            'device_token' => 'required',
        ],[],['device_token' => 'Driver Device Token']);

        $driver = Driver::find($request->user_id);


        if ($driver) {
            
            $driver->update(array('device_token' => $request->device_token));
            return $this->successfulMessage(200,"تمت العملية بنجاح" , "success" , $driver);

        }else {
            $response = $this->notFoundMessage('المستخدم غير موجود');
        }

        return response($response);
     }

     /**
      * chabge Driver Lat * long
      */

      public function lat_long(Request $request) {
        $this->validate($request , [
            'user_id' => 'required|not_in:0',
            'driver_lat' => 'required',
            'driver_long' => 'required',
        ],[],['driver_lat' => 'latitude' , 'driver_long' => 'Longitude']);

        $driver = Driver::find($request->user_id);


        if ($driver) {
            
            $driver->update(array('driver_lat' => $request->driver_lat, 'driver_lon' => $request->driver_long));
            return $this->successfulMessage(200,"تمت العملية بنجاح" , "success" , $driver);

        }else {
            $response = $this->notFoundMessage('المستخدم غير موجود');
        }

        return response($response);
      }
    
    /**
     * Driver Signup
     * @var Request
     */

    public function signup(Request $request)
    {
        
        $this->validate($request, [
                'name' => 'required|max:255',
                'phone' => 'max:255|unique:users',
                'password' => 'required|min:6',
                'access_token' => 'required|unique:users',
            ] , [] , ['access_token' => 'access_token']);

        try{
            $user = $request->all();
            $user['password'] = bcrypt($request->password);
            $user['api_token'] = Str::random(150);
            
            $user = User::create($user);
            
            return response()->json(['success'=> $user] , 200);
        } catch (Exception $e) {
             return response()->json(['error' => 'خطأ حاول مرة اخرى'], 500);
        }
    }

    /**
     * 
     * show User Profile
     * 
     */
    public function profile() {
        $user = Auth::user('driver');
        
        if ($user) {
            $response = $this->successfulMessage(200, 'تمت العملية بنجاح', 'success', $user);
        }else {
            $response = $this->notFoundMessage();
        }

        return response($response);
    }


    public function userLogout() {
        
        $driver =Auth::user('driver');
        
        $driver = Driver::find($driver->id);
                
        $driver->update(array('api_token' => Str::random(150) , 'online' => 0));
    
        $response = $this->successfulMessage(200, 'تم تسجيل الخروج بنجاح', 'success', $driver);


        return response($response);
    }




    /**
     * show User order
     * 
     */

    public function showOrder(Request $request) {
        
        
        $order_id = $request->order_id;

        $this->validate($request, [
            'order_id' => 'required|not_in:0'
        ]);

        $order = Order::find($order_id);
        $order['company_name'] = $order->company->company_name;
        $order['company_phone'] = $order->company->company_phone;
        $order['company_city'] = $order->company->city->name;
        $order['company_address'] = $order->company->company_address;
        $order['airwaybill'] = url(route('driver.order.pdf' , [$order->id , 'order_id' => $order->order_id]));

        $response = $this->successfulMessage('200' , 'تمت العملية بنجاح', 'success' , $order);

        return response($response);
    }


    /**
     * Notifications
     */

     public function ar_notifications() {

        $driver = Auth::user('driver');

        $notifications = Notification::where('driver_id' , $driver->id)->orderBy('created_at' , 'desc')->get();

        return $this->successfulMessage(200 , 'الاشعارات' , 'success' , $notifications);
     }

     /**
     * Notifications
     */

    public function en_notifications() {

        $driver = Auth::user('driver');

        $notifications = Notification::where('driver_id' , $driver->id)->orderBy('created_at' , 'desc')->get();

        return $this->successfulMessage(200 , 'Notifications' , 'success' , $notifications);
     }

    /**
     * 
     * List User Order
     */

    public function listOrders () {
        $driver = Auth::user('driver');

        $orders = Order::with('company','customer' , 'driver' , 'vehicle')->where('driver_id', $driver->id)->whereNotIn('status' , ['delivered' , 'canceled'])->orderBy('created_at' , 'desc')->get();

        if ($orders->count() != 0) {
            $response = $this->successfulMessage('200' , 'تمت العملية بنجاح', 'success' , $orders);
        }else {
            $response = $this->notFoundMessage('لا يوجد طلبات ');
        }
        return response($response);
    }


    /**
     * History
     * 
     */

    public function ordersHistory () {
        $driver_id = Auth::user('driver')->id;


        $orders = Order::where('driver_id', $driver_id)->whereIn('status' , ['delivered' , 'canceled'])->get();

        if ($orders) {
            $response = $this->successfulMessage('200' , 'تمت العملية بنجاح', 'success' , $orders);

        }else {
            $response = $this->notFoundMessage('لا يوجد طلبات ');
        }
        return response($response);
    }

    /**
     * Scan Order 
     */

     public function scanOrder(Request $request) {

        $driver = Auth::user('driver');

        $order = Order::where('order_id' , $request->order_id)->first();

        if ($order) {
            if ($order->driver_id == $driver->id) {
                $order->update(array('is_scanned' => 1));
                $response = ['success' => true , 'msg' => 'هذا الطلب لهذا السائق بالفعل'];
            }else {
                $response = $this->notFoundMessage('هذا الطلب لسائق أخر');
            }
        }else {
            $response = $this->notFoundMessage('الطلب غير موجود بالنظام');
        }
        
        return response($response);
        
     }

    /**
     * Accept or Decline Order
     * @param $order_id
     * @var Auth
     * @method UPDATE
     */

    public function accept(Request $request) {

        $order = Order::find($request->order_id);
        
        if ($request->isAccept == 2) {
            $order->update(array(
                'isAccept' => 2,
            ));

            $response = $this->successfulMessage(200 , 'تم قبول الطلب', 'success' , $order);

        }else {
            $order->update(array(
                'isAccept' => 0,
                'status'   => 'unassigned',
                'driver_id' => 0,
            ));

            Alert::create([
                'order_id' => $order->id,
                'message'  => 'تم رفض الطلب من قبل السائق  '  . $order->order_id ,
            ]);
            $response = $this->successfulMessage(200 , 'تم رفض الطلب', 'success' , $order);

        }

        return response($response);
    }










    
    /**
     * Change Order Status
     * 
     */

    public function changeStatus(Request $request) {
        
        $form_validate = [
                'order_id' => 'رقم الطلب',
                'status' => 'الحالة',
            ];
            
        $this->validate($request , [
                'order_id' => 'required|not_in:0',
                'status' => 'required',
            ] , [] , $form_validate);
            
        
        $order = Order::find($request->order_id);
        
        $user = Auth::user('driver');
        
        if ($order->status != 'canceled') { // if order Not canceled
            if ($order->type != 1) {
                if ($request->status == 'to_be_delivered') { // to_be_delivered
                    
                    if ($order->status != 'to_be_delivered') {
                        Order::where('id' , $order->id)->update(array(
                            'status' => $request->status,
                            'change_by_user' => $user->fname . ' ' . $user->lname,
                        ));
                        
                        $log = new OrderLog;
                        $log->order_id = $order->id;
                        $log->change_by_user = $user->fname  . ' '  . $user->lname;
                        $log->note_ar = 'في الطريق إلى موقع الاستلام';
                        $log->note_en = 'Heading to pick-up location';
                        $log->save();
                        
                        $response = $this->successfulMessage(200, 'تم تغيير الحالة بنجاح', true, $order);
                    }else {
                        $response = $this->notFoundMessage("تم تغيير حالة الطلب مسبقا");
                    }
    
                }elseif ($request->status == 'rescheduled') { // rescheduled
    
                    if ($order->status != 'rescheduled') {

                        Order::where('id' , $order->id)->update(array(
                            'status' => $request->status,
                            'change_by_user' => $user->fname . ' ' . $user->lname,
                            'another_time' => $request->another_time,
                            'place_image'  => $request->image,
                        ));

                        $log = new OrderLog;
                        $log->order_id = $order->id;
                        $log->change_by_user = $user->fname  . ' '  . $user->lname;
                        $log->note_ar = 'تم إعادة جدولة ';
                        $log->note_en = 'The order has been rescheduled';
                        $log->save();
    
                        $response = $this->successfulMessage(200, 'تم تغيير الحالة بنجاح', true, $order);
    
    
                    }else {
                        $response = $this->notFoundMessage("تم تغيير حالة الطلب مسبقا");
                    }
    
                }elseif ($request->status == 'car_damage') { // car_damage
    
                    if ($order->status != 'car_damage') {

                        Order::where('id' , $order->id)->update(array(
                            'status' => $request->status,
                            'change_by_user' => $user->fname . ' ' . $user->lname,
                        ));
                        
                        Alert::create([
                            'order_id' => $order->id,
                            'message'  => 'حدث عطل بالسيارة الأن لدى السائق اثناء توصيل الطلب رقم #' . $order->order_id,
                        ]);

                        $log = new OrderLog;
                        $log->order_id = $order->id;
                        $log->change_by_user = $user->fname  . ' '  . $user->lname;
                        $log->note_ar = 'حدث مشكلة بالسيارة';
                        $log->note_en = 'Car is Damaged';
                        $log->save();
                        
                        $response = $this->successfulMessage(200, 'تم تغيير الحالة بنجاح', true, $order);
                    }else {
                        $response = $this->notFoundMessage("تم تغيير حالة الطلب مسبقا");
                    }
    
                }elseif ($request->status == 'delivered') { // delivered
                    
                    if ($order->status != 'delivered') {
                        if ($request->security_code == $order->security_code) {
        
                            Order::where('id' , $order->id)->update(array(
                                'status' => $request->status,
                                'change_by_user' => $user->fname . ' ' . $user->lname,
                            ));            

                            $log = new OrderLog;
                            $log->order_id = $order->id;
                            $log->change_by_user = $user->fname  . ' '  . $user->lname;
                            $log->note_ar = 'تم توصيل الطلب';
                            $log->note_en = 'Delivered';
                            $log->save();
        
                            $response = $this->successfulMessage(200, 'تم تغيير الحالة بنجاح', true, $order);
        
                        }else {
                            $response = $this->notFoundMessage("الكود السري خاطئ");
                        }
                    }else {
                        $response = $this->notFoundMessage("تم تغيير حالة الطلب مسبقا");
                    }
    
                }else {
                    $response = $this->notFoundMessage("حدث خطأ ما, حاول مرة اخرى");
                }
            }else{
                if ($request->status == 'to_be_delivered') { // to_be_delivered
                    
                    if ($order->status != 'to_be_delivered') {
                        Order::where('id' , $order->id)->update(array(
                            'status' => $request->status,
                            'change_by_user' => $user->fname . ' ' . $user->lname,
                        ));
                        
                        $log = new OrderLog;
                        $log->order_id = $order->id;
                        $log->change_by_user = $user->fname  . ' '  . $user->lname;
                        $log->note_ar = 'في الطريق إلى موقع الاستلام';
                        $log->note_en = 'Heading to pick-up location';
                        $log->save();
                      
                        
                        $response = $this->successfulMessage(200, 'تم تغيير الحالة بنجاح', true, $order);   
                    }else {
                        $response = $this->notFoundMessage("تم تغيير حالة الطلب مسبقا");
                    }
    
                }elseif ($request->status == 'delivered') { // delivered
                    
                    if ($order->status != 'delivered') {

                        if ($request->has('image')) {
                            Order::where('id' , $order->id)->update(array(
                                'status' => $request->status,
                                'change_by_user' => $user->fname . ' ' . $user->lname,
                                'invoice' => $request->image,
                            ));
                        }else {
                            Order::where('id' , $order->id)->update(array(
                                'status' => $request->status,
                                'change_by_user' => $user->fname . ' ' . $user->lname,
                            ));
                        }

                        
                        $log = new OrderLog;
                        $log->order_id = $order->id;
                        $log->change_by_user = $user->fname  . ' '  . $user->lname;
                        $log->note_ar = 'تم توصيل الطلب';
                        $log->note_en = 'Delivered';
                        $log->save();
                      

                        $response = $this->successfulMessage(200, 'تم تغيير الحالة بنجاح', true, $order);
                    }else {
                        $response = $this->notFoundMessage("تم تغيير حالة الطلب مسبقا");
                    }
    
                }else {
                    $response = $this->notFoundMessage("حدث خطأ ما, حاول مرة اخرى");
                }
            }
        }else {
            $response = $this->notFoundMessage('تم إلغاء الطلب ');
        }
        
        return response($response);
    }
    


    

    /** 
     * 
     * Change Driver Password 
     * 
     * */
    
    public function changePassword(Request $request) {
        $user = Auth::user('driver');


        if ($user) {
            $form_validate = ['oldPassword' => 'كلمة المرور القديمة'];
            $this->validate($request , [
                'oldPassword' => ['required'],
                'password'    => 'required|min:8|confirmed',
            ] , [] , $form_validate);
            
            
            if (Hash::check($request->oldPassword , $user->password)) {
                $changePass = Driver::find($user->id)->update(array(
                    'password' => bcrypt($request->password)
                ));
    
                if ($changePass) {
                    $response = $this->successfulMessage(200 , 'تم تغيير كلمة المرور بنجاح' , 'success' , $user);
                }else {
                    $response = $this->notFoundMessage('حدث خطأ ما , حاول مرة أخرى');
                }    
            }else {
                $response = $this->notFoundMessage('كلمة المرور القديمة خاطئة');   
            }
        }else {
            $response = $this->notFoundMessage('عذرا , انت غير مسجل دخولك');
        }

        return response($response);
    }

    /**
     * Connect Support
     */


    public function support(Request $request) {

        $order = Order::find($request->order_id);



        $support = new Support;
        $support->order_id = $order->id;
        $support->customer_id = $order->customer_id;
        $support->company_id = $order->company_id;
        $support->message  = $request->message;
        $support->save();

        
        $response = $this->successfulMessage(200,'success' , 'تم الإرسال بنجاح',$order);        
        return response($response);

    }


    /**
     * 
     * download airwaybill
     */

    public function pdf($id , $order_id)
    {
        $order = Order::where('order_id','=',$order_id)->find($id);

        $generator = new BarcodeGeneratorSVG;
        $svg = $generator->getBarcode($order->order_id, $generator::TYPE_CODE_128 , 2 , 50);
        $svg2 = $generator->getBarcode($order->order_id, $generator::TYPE_CODE_128 , 2 , 15);

        $svg = str_replace('<?xml version="1.0" standalone="no" ?>', "" , $svg);
       $svg2 = str_replace('<?xml version="1.0" standalone="no" ?>', "" , $svg2);
       
       $pdf = PDF::loadView('customer.orders.pdfar', compact('order' , 'svg' , 'svg2'));

        $filename = 'airwaybill_' . date('M d Y', $order->created_at->timestamp) .'.pdf';
        return $pdf->stream($filename);
    }
}
