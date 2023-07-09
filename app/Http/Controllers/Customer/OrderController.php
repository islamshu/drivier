<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Requests\StoreFastOrder;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\fastOrderImport;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\City;
use App\Models\Region;
use App\Models\Vehicle;
use App\Models\Alert;
use App\Models\Company;
use App\Models\OrderLog;
use App\Models\Notification;
use App\Models\Support;
use App\Customer;
use App\Driver;
use Auth;
use Validator;
use DateTime;
use Datatables;
use PDF;
use Avatar;
use Carbon\Carbon;
use DB;
use Picqer\Barcode\BarcodeGeneratorSVG;
use LaravelLocalization;
class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('customer.auth:customer');
        $this->middleware('staff:branch');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if ($request->ajax()) {

            $id = Auth::guard('customer')->user()->id;
            $customer = Customer::find($id);
            $orders = Order::where('customer_id' , $customer->id)->latest()->get();

            return datatables()->of($orders)->addColumn('id' , function($data){
                return $data->id;
            })->addColumn('order_id' , function($data){
                $button = '<a href="'. url(route('customer.order.show' , ['id' => $data->id , 'order_id' => $data->order_id])) .'" class="text-primary">'. $data->order_id .'</a>';
                return $button;
            })->addColumn('name', function($data){
                $name = $data->name ?? 'N/A';
                $phone = $data->phone ?? 'N/A';
                $city = $data->city->name;
                $region = Str::limit($data->region, 20, '...') ?? 'N/A';
                if ($data->type == 1) {
                    return $name . '<br>' . $phone . '<br>' . $city . " ,". $region;
                } else {
                    $address = $data->city->name . ', <br> '. $data->region;
                    return $name . '<br>' . $phone . '<br>' . $address;
                }
            })->addColumn('deliverey_fee' , function($data) {
                $delivery_fees = $data->delivery_fees?? 'N/A';
                $approx_km = $data->approx_km ?? 0;

                return $delivery_fees . ' ' . trans('app.ras'). ' <br> ' . $approx_km . ' ' . trans('app.km');
            })->addColumn('status' , function($data) {
                if ($data->status == 'assign_to_driver') {
                    return '<a href="javascript:;" class="badge badge-info"  >' . trans('app.assign_to_driver') .'</a>';
                }elseif ($data->status == 'unassigned') {
                    return '<a href="javascript:;" class="badge badge-default" >'.trans('app.unassigned').'</a>';
                }elseif ($data->status == 'to_be_delivered' || $data->status == 'car_damage') {
                    return '<a href="javascript:;" class="badge badge-info" >'. trans('app.to_be_delivered') .'</a>';
                }elseif ($data->status == 'rescheduled') {
                    return '<a href="javascript:;" class="badge badge-warning" >'. trans('app.rescheduled') .'</a>';
                }elseif ($data->status == 'delivered') {
                    return '<a href="javascript:;" class="badge badge-success">'.trans('app.delivered').'</a>';
                }elseif ($data->status == 'canceled') {
                    return '<a href="javascript:;"  class="badge badge-danger" >'.trans('app.canceled').'</a>';
                } else {
                    return '<a href="javascript:;" class="text-danger">'. $data->status .'</a>';
                }
            })->addColumn('amount' , function($data) {
               return $data->cod_amount . ' ' . trans('app.ras');
            })->addColumn('created_at' , function($data) {
                return date('d/m/Y', $data->created_at->timestamp);
            })->addColumn('action' , function($data) {
               $buttons = '<div class="dropdown custom-dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="flaticon-dot-three"></i>
                </a>
              
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <a class="dropdown-item" href="'. url(route('customer.order.show' , ['id' => $data->id , 'order_id' => $data->order_id])).'">'.trans('app.view').'</a>
                    <a class="dropdown-item" href="'. url(route('customer.order.pdf' , ['id' => $data->id , 'order_id' => $data->order_id])).'">'.trans('app.awb').'</a>
                    <a target="_blank" class="dropdown-item" href="'. url('/t/' . $data->id . '/' . $data->security_code).'">'.trans('app.tracking').'</a>
                </div>
              </div>';
              return $buttons;
              
            })->rawColumns(['id','order_id', 'name' , 'deliverey_fee' , 'status' ,'amount' , 'created_at','action'])->make(true);
        }

        return view('customer.orders.index');
    }


    /**
     * 
     * print All AWB as PDF 
     * @param $request
     * 
     */

    public function downloadawb(Request $request) {
        
        if (is_array( $request->orders) || is_object( $request->orders)) {

            $allorders = [];

            foreach ($request->orders as $order) {
                $orders = Order::whereIn('id' , [$order])->get();

              foreach ($orders as $order) {
                $orders= array_push($allorders , $order); 
              }
            }

            $generator = new BarcodeGeneratorSVG;
            
            $pdf = PDF::loadView('customer.orders.downloadawb', compact('allorders' , 'generator'));
            $filename = 'airwaybill_' . date('M d Y') .'.pdf';
            return $pdf->download($filename);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $id = Auth::guard('customer')->user()->id;
        $company_id = Auth::guard('customer')->user()->company_id;
        $company = Company::find($company_id);
        $customer = Customer::find($id);
        $cities = City::get();
        $regions = Region::get();

        if ($company->company_type == 0) {
            return view('customer.orders.create' , compact('company','customer','cities' , 'regions'));
        }else {
            return view('customer.orders.fast' , compact('company','customer','cities' , 'regions'));
        }
    }


    /**
     * Store Fast Order Deliverey For Restuarnt 
     */

     public function fastOrder(StoreFastOrder $request) {

        if ($request->isMethod('post')) {

            $request['valid_number'] = str_replace("_" , "" , $request->phone );

            $this->validate($request , 
            [
                'name' => 'required|max:255',
                'valid_number' => 'required|min:10',
            ],
            [
                'valid_number.min' => 'يجب أن يكون طول النص الهاتف على الأقل 10 أرقام.',
            ],
            [
                'name' => trans('app.name'),
                'phone' => trans('app.phone'),
                'box_count' => trans('app.box_count'),
                'cod_amount' => trans('app.cod_amount'),
                'valid_number' => trans('app.phone'),
                'vehicle_id'  => trans('app.vehicle'),
            ]);

            
            // $driver = Driver::where('active' , 1)->inRandomOrder()->first();
            
            $customer = Customer::find(Auth::guard('customer')->user()->id);
            
            $date = new DateTime;
            $date->modify('-1 minutes');
            $formatted_date = $date->format('Y-m-d H:i:s');
            
            $driver = Driver::freedriver()
                ->whereNotNull('driver_lat')
                ->whereNotNull('driver_lon')
                ->where('active',1)
                ->where('updated_at' , '>=' , $formatted_date)
                ->where('city_id' , $customer->city->id)
                ->select('id','fname', 'lname', 'driver_lat', 'driver_lon', DB::raw(sprintf(
                    '(6371 * acos(cos(radians(%1$.7f)) * cos(radians(driver_lat)) * cos(radians(driver_lon) - radians(%2$.7f)) + sin(radians(%1$.7f)) * sin(radians(driver_lat)))) AS distance',
                    $customer->branch_lat,
                    $customer->branch_long
                )))
                ->orderBy('distance', 'asc')
                ->first();
            
            
            if (!$driver) {
                $driver = DB::table('drivers')
                ->whereNotNull('driver_lat')
                ->whereNotNull('driver_lon')
                ->where('active',1)
                ->where('updated_at' , '>=' , $formatted_date)
                ->where('city_id' , $customer->city->id)
                ->select('id','fname', 'lname', 'driver_lat', 'driver_lon', DB::raw(sprintf(
                    '(6371 * acos(cos(radians(%1$.7f)) * cos(radians(driver_lat)) * cos(radians(driver_lon) - radians(%2$.7f)) + sin(radians(%1$.7f)) * sin(radians(driver_lat)))) AS distance',
                    $customer->branch_lat,
                    $customer->branch_long
                )))
                // ->having('distance', '<', 50)
                ->orderBy('distance', 'asc')
                // ->get();
                ->first();
            }


            $random = str_replace('-','', mt_rand(0000000000000,9999999999999));

            $order = new Order;
            $order->order_id        = $random;
            $order->name            = $request->name;
            $order->phone           = $request->phone;
            $order->customer_id     = $customer->id;
            $order->company_id      = $customer->company->id;
            $order->from_lat        = $customer->branch_lat;
            $order->from_long       = $customer->branch_long;
            $order->to_lat          = $request->to_lat;
            $order->to_long         = $request->to_long;
            $order->cod_amount      = $request->cod_amount;
            $order->type            = $request->order_type;
            $order->delivery_time   = $request->approx_time;
            $order->goods_type      = $request->notes;
            $order->delivery_fees   = $request->delivery_fees;
            $order->approx_km       = $request->approx_km;
            $order->vehicle_id      = 1;
            $order->box_count       = 1;
            $order->city_id         = $customer->city->id;
            
            if ($driver) {
                $order->driver_id = $driver->id;
                $order->status = "assign_to_driver";
            }else {
                $order->driver_id = 0;
                $order->status = "unassigned";
            }
            $order->security_code = str_replace('-','', mt_rand(10000, 99999));
            $order->region = $request->clientAddress;
            
            $order->save();

            Alert::create([
                'order_id' => $order->id,
                'message'  => 'تم إستقبال طلب جديد الأن',
            ]);
            
            $customer->update(array(
                'amount' => $customer->amount = $customer->amount - $order->delivery_fees
            ));
            if ($this->is_connected()) {
                if ($customer->amount <= 200) {
                    $mobileNumber = '+' . $this->convertPhoneNumber($customer->branch_phone);
                    $message = "   مرحبا اخي العزيز يرجى الدفع في حسابك لان المبلغ الموجود لطلباتك اقل من  200
            Hello dear brother, please pay in your account because the amount available for your orders is less than 200 ";
                    // $this->sendSMS($mobileNumber, $message);
                } elseif ($customer->amount == 0) {
                    $mobileNumber = '+' . $this->convertPhoneNumber($customer->branch_phone);
                    $message = "مرحبا اخي العزيز يرجى الدفع في حسابك لان المبلغ الموجود لطلباتك صفر ولا يمكنك طلب اي طلبات ";
                    // $this->sendSMS($mobileNumber, $message);
                }
            }

            return redirect()->route('orders.select_driver' ,  [$order->id])->with(['type' => 'success' , 'message' =>  trans('app.saveSuccessful')]);
        }

     }

     protected function is_connected() {
         $connnected = @fsockopen("www.google.com" , 443);

         if ($connnected) {
             $is_conn =  true;
             fclose($connnected);
         }else {
             $is_conn = false;
         }

         return $is_conn;
     }


     /**
      * Select Driver
      */
     public function select_driver($id) {
        $order = Order::find($id);

        $customer = Customer::find($order->customer_id);
        $url  =  url('/t/' . $order->id . '/' . $order->security_code);

        $mobileNumber = '+' . $this->convertPhoneNumber($order->phone);
       

        if ($this->is_connected()) {
            if ($order->type == 1) {
                $message = "مرحبا $order->name لديك طلب توصيل من  $customer->branch_name . الرجاء اتباع هذا الرابط لتتبع طلبك $url   You have a delivery order from  $customer->branch_name  Please, follow the link to track your order. Thank you. ";
                // $this->sendSMS($mobileNumber , $message);
            }else {
                $message = "مرحبا $order->name لديك طلب توصيل من  $customer->branch_name. الرجاء اتباع هذا الرابط لتتبع طلبك $url . الكود السري الخاص بطلبك : $order->security_code You have a delivery order from  $customer->branch_name  Please, follow the link to track your order. Thank you. ";
                // $this->sendSMS($mobileNumber , $message);
            }
        }


        
        $driver = Driver::find($order->driver_id);
      
        if ($driver) {
            Notification::create([
                'driver_id' => $driver->id,
                'notification_ar' => 'لديك طلب جديد',
                'notification_en' => 'You have new Order',
            ]);
            
            $orderlog = new OrderLog;
            $orderlog->order_id = $order->id;
            $orderlog->change_by_user = Auth::guard('customer')->user()->branch_name;
            $orderlog->note_ar = 'تم إنشاء الطلب';
            $orderlog->note_en = 'Order placed';
            $orderlog->save();


            $log = new OrderLog;
            $log->order_id = $order->id;
            $log->change_by_user = $driver->fname . ' ' . $driver->lname;
            $log->note_ar = 'تم تسليم الطلب للسائق';
            $log->note_en = 'The Order Delivered to the Driver';
            $log->save();

            $this->sendNotification($order->order_id , $driver->device_token);


            return view('customer.orders.select_driver' , compact('order' , 'driver'));
        }else {
            
            Alert::create([
                'order_id' => $order->id,
                'message'  => 'لم يتم تعيين سائق لهذا الطلب',
            ]);

            
            $orderlog = new OrderLog;
            $orderlog->order_id = $order->id;
            $orderlog->change_by_user = Auth::guard('customer')->user()->branch_name;
            $orderlog->note_ar = 'تم إنشاء الطلب';
            $orderlog->note_en = 'Order placed';
            $orderlog->save();


            $no_driver = trans('app.no_driver');

            return view('customer.orders.select_driver' , compact('order' , 'no_driver'));
        }
    
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_validate = [
            'name' => trans('app.name'),
            'phone' => trans('app.phone'),
            'region_id' => trans('app.region'),
            'city_id' => trans('app.city'),
            'box_count' => trans('app.box_count'),
            'cod_amount' => trans('app.cod'),
            'valid_number' => trans('app.phone'),
        ];
        if($request->isMethod('post')) {
            
            $request['valid_number'] = str_replace("_" , "" , $request->phone );

            $this->validate($request , [
                'name' => 'required|max:255',
                'box_count' => 'required|not_in:0',
                'cod_amount' => 'required',
                'valid_number' => 'required|min:10',
            ] , [] , $form_validate);
            
            $customer = Customer::find(Auth::guard('customer')->user()->id);
            
            
            $vehicle = Vehicle::where('city_id' , $customer->city->id)->where('carType' , $request->carType)->where('active' , 0)->inRandomOrder()->first();

            if ($vehicle) {
                
                $date = new DateTime;
                $date->modify('-1 minutes');
                $formatted_date = $date->format('Y-m-d H:i:s');
                
                $driver = DB::table('drivers')->where('city_id' , $customer->city->id)->whereNotNull('driver_lat')->whereNotNull('driver_lon')->where('active',1)->where('updated_at' , '>=' , $formatted_date)->where('vehicle_id',$vehicle->id)
                    ->select('id','fname', 'lname', 'driver_lat', 'driver_lon', DB::raw(sprintf(
                        '(6371 * acos(cos(radians(%1$.7f)) * cos(radians(driver_lat)) * cos(radians(driver_lon) - radians(%2$.7f)) + sin(radians(%1$.7f)) * sin(radians(driver_lat)))) AS distance',
                        $customer->branch_lat,
                        $customer->branch_long
                    )))
                    // ->having('distance', '<', 50)
                    ->orderBy('distance', 'asc')
                    // ->get();
                    ->first();
            }else {
                $driver = '';
            }

            $city = City::find($request->city);
            $random = str_replace('-','', mt_rand(0000000000000,9999999999999));

            $order = new Order;
            $order->order_id = $random;
            $order->customer_id = $customer->id;
            $order->company_id = $customer->company->id;
            $order->name  = $request->name;
            $order->phone  = $request->phone;
            $order->cod_amount  = $request->cod_amount;
            $order->box_count  = $request->box_count;
            $order->region  = $request->region_id . ' , ' . $request->clientAddress;
            $order->city_id = $customer->city->id;
            $order->delivery_time  = $request->another_date .' '. $request->timedropper;
            // $order->vehicle_id = $vehicle->id;
            // $order->driver_id = $driver->id;
            $order->payment = 0;
            $order->type = 0;
            // $order->status = 'assign_to_driver';

            $order->from_lat = $customer->branch_lat;
            $order->from_long = $customer->branch_long;
            $order->to_lat = $request->to_lat;
            $order->to_long = $request->to_long;
            $order->approx_weight = $request->approx_weight;
            $order->delivery_fees = $request->delivery_fees;
            $order->goods_type = $request->goods_type;
            $order->approx_km = $request->approx_km;
            $order->security_code = str_replace('-','', mt_rand(1000, 9999));
            if ($vehicle) {
                $order->vehicle_id = $vehicle->id;
            }else {
                $order->vehicle_id = 0;
            }
            if ($driver) {
                $order->driver_id = $driver->id;
                $order->status = "assign_to_driver";
            }else {
                $order->driver_id = 0;
                $order->status = "unassigned";
            }
            $order->save();

            // if ($request->payment_type == 0 ){
            //     return back()->with(['type' => 'success' , 'message' =>  trans('app.saveSuccessful')]);
            // }else {
            //     return redirect()->route('customer.order.checkout' , ['id' => $order->id , 'order_id' => $order->order_id])->with(['type' => 'success' , 'message' =>  trans('app.saveSuccessful')]);
            // }
            return redirect()->route('orders.select_driver' ,  [$order->id])->with(['type' => 'success' , 'message' =>  trans('app.saveSuccessful')]);
        }
    }


    /**
     * Change Status 
     * cancelOrder
     */

     public function cancelOrder($id) {
        $order = Order::find($id);

        $created_at = Carbon::parse($order->created_at);
        $now = Carbon::now();

        $totalDuration = $now->diffForHumans($created_at);
       
        $order->update(array(
            'status' => 'canceled',
            'canceled_at' => $now,
            'canceled_after' => $totalDuration,
        ));

        Alert::create([
            'order_id' => $order->id,
            'message'  => 'تم إلغاء الطلب من قبل العميل '  . $order->order_id . ' ' . $totalDuration ,
        ]);

        $orderLogs = new orderLog;
        $orderLogs->order_id = $order->id;
        $orderLogs->change_by_user = Auth::guard('customer')->user()->name;
        $orderLogs->note_en = 'The order has been canceled ' . $totalDuration;
        $orderLogs->note_ar = 'تم الغاء الطلب  ' . $totalDuration;
        $orderLogs->save();
        
        return back()->with(['type' => 'success' , 'message' => trans('app.changeStatusSuccess')]);

     }

     /**
      * Khaled
      */

      public function contact_to_support(Request $request ,$id) {

            $order = Order::find($id);

            $customer_id = Auth::guard('customer')->user()->id;
            $company_id = Auth::guard('customer')->user()->company_id;


            $support = new Support;
            $support->order_id = $id;
            $support->customer_id = $customer_id;
            $support->company_id = $company_id;
            $support->message  = $request->message;

            $support->save();
            return back()->with(['type' => 'success' , 'message' => trans('app.saveSuccessful')]);
      }
    /**
     * 
     * Customer Map
     * 
     */
    public function map() {
        
        date_default_timezone_set("Asia/Riyadh");
        
        $places = [];

        $customers = Customer::get();

        $orders = Order::where('status' , 'unassigned')->get();


        return view('customer.map.map' , compact('customers','orders'));
    }


    public function getRegion($id) {
        $city = City::find($id);


        if ($city) {
            $regions = Region::where('city_id', $city->id)->get();
            return response()->json($regions);
        }
    }

    public function getLatlng($id) {
        $customer = Customer::find($id);
        return response()->json($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id , $order_id)
    {
        $order = Order::where('order_id','=',$order_id)->find($id);
    
        if ($order) {
            
            return view('customer.orders.show' , compact('order'));            
        }else {
            return redirect('customer')->with(['type' => 'danger' , 'message' => trans('app.saveFailes')]);
        }

    }

    /**
     * 
     * Checkout 
     */

     public function checkout($id , $order_id) {
        $order = Order::where('order_id','=',$order_id)->find($id);
        if ($order) {
            
            return view('customer.orders.checkout' , compact('order'));            
        }else {
            return redirect('customer')->with(['type' => 'danger' , 'message' =>'Failed, Try Again']);
        }
     }

     /**
      * Make Payment - Hyperpay 
      */

      public function payment(Request $request , $id , $order_id) {

          $form_validate = [
            'cardType' => trans('app.cardType'),
            'cardNumer' => trans('app.cardNumer'),
            'cardHolder' => trans('app.cardHolder'),
            'cardExpireMonth' => trans('app.cardExpireMonth'),
            'cardExpireYear' => trans('app.cardExpireYear'),
            'cardCvv' => trans('app.cardCvv'),
          ];

          if ($request->isMethod('post')) {
              $this->validate($request, [
                'cardType' => 'required|not_in:0',
                'cardNumer' => 'required|min:13|max:16',
                'cardHolder' => 'required|string|max:255',
                'cardExpireMonth' => 'required|max:2',
                'cardExpireYear' => 'required|max:4',
                'cardCvv' => 'required|max:3',
              ],[],$form_validate);
          }

          $order = Order::find($id);
          $url = "https://test.oppwa.com/v1/payments";
          $data = "entityId=8a8294174d0595bb014d05d82e5b01d2" .
                      "&amount=1.00" .
                      "&currency=EUR" .
                      "&paymentBrand=" . $request->cardType .
                      "&paymentType=DB" .
                      "&card.number=" . $request->cardNumer .
                      "&card.holder="  . $request->cardHolder .
                      "&card.expiryMonth=" .$request->cardExpireMonth .
                      "&card.expiryYear=" . $request->cardExpireYear .
                      "&card.cvv=" . $request->cardCvv .
                      "&shopperResultUrl=" . url(route('order.index')); 
      
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                         'Authorization:Bearer OGE4Mjk0MTc0ZDA1OTViYjAxNGQwNWQ4MjllNzAxZDF8OVRuSlBjMm45aA=='));
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $responseData = curl_exec($ch);
          if(curl_errno($ch)) {
              return curl_error($ch);
          }
          curl_close($ch);
          $response = json_decode($responseData, TRUE);
          
          if (isset($response->redirect)) {
            $redirectUrl = $response->redirect->url;
            $parameters = $response->redirect->parameters;
           return view('customer.order.processing' , compact('redirectUrl','parameters'));

          } {
              return back()->with(['type' => 'danger' , 'message' => 'خطأ في البيانات المدخلة']);
          }
          
      }

    public function pdf($id , $order_id)
    {
        $order = Order::where('order_id','=',$order_id)->find($id);


        $generator = new BarcodeGeneratorSVG;
        $svg = $generator->getBarcode($order->order_id, $generator::TYPE_CODE_128 , 2 , 50);
        $svg2 = $generator->getBarcode($order->order_id, $generator::TYPE_CODE_128 , 2 , 15);
       

        $svg = str_replace('<?xml version="1.0" standalone="no" ?>', "" , $svg);
        $svg2 = str_replace('<?xml version="1.0" standalone="no" ?>', "" , $svg2);

        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            $pdf = PDF::loadView('customer.orders.pdfar', compact('order' , 'svg' , 'svg2'));
        }else {
            $pdf = PDF::loadView('customer.orders.pdf', compact('order' , 'svg' , 'svg2'));
        }

        $filename = 'wtc_' . date('M d Y', $order->created_at->timestamp) .'.pdf';
        return $pdf->download($filename);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id ,$order_id)
    {
        $order = Order::where('order_id','=',$order_id)->find($id);
        if ($order) {
            return view('customer.orders.edit' , compact('order'));            
        }else {
            return redirect('customer')->with(['type' => 'danger' , 'message' =>'Failed, Try Again']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $form_validate = [
            'name' => 'Recipient Name',
            'phone' => 'Recipient Phone',
            'box_count' => 'Box Count',
            'cod_amount' => 'COD Amount',
        ];
        if($request->isMethod('post')) {
            
            $this->validate($request , [
                'name' => 'required|max:255',
                'phone' => 'required',
                'box_count' => 'required|not_in:0',
                'cod_amount' => 'required',
            ] , [] , $form_validate);
            
            
            $order = Order::find($id);
            

            $update = $order->update(array(
                'phone' => $request->phone,
                'name' => $request->name,
                'cod_amount' => $request->cod_amount,
                'box_count' => $request->box_count,
                'delivery_company' => $request->delivery_company,
                'reference_id' => $request->reference_id,
            ));
            
            if ($update) {
                return back()->with(['type' => 'success' , 'message' => 'Order Updated Successfuly']);
            }else {
                return back()->with(['type' => 'danger' , 'message' =>'Failed , try again later']);
            }
        }
    }

 

    protected function sendNotification($order_id , $token) {
        
        
        $url = "https://fcm.googleapis.com/fcm/send";

        $notification = array(
            'title' => 'لديك طلب جديد  , You have new Order',
            'body'  => 'تم إضافة طلب جديد من قبل الإدارة #'. $order_id,
        );

        $fields = array
        (
            'to' 	=> $token,
            'notification'			=> $notification
        );

        $headers = array
        (
            'Authorization: key=APA91bFpP4PXg19cAQypDxgX4_OC5uFTay3tC06l1AWa9i9AMEEmtjHUubjXSTtVnfHP1w7qZYlPDibg648c1bt06jmMp6F6GR2s4nl4rRgDQKzE6XWCTWnz0VGFMktK8OMf58s6i1ek',
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, $url );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // new 
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );  
        if ($result === FALSE) {
            die('Oops! FCM Send Error: ' . curl_error($ch));
        }
        curl_close( $ch );    
        
    }


    public function convertPhoneNumber($phone) {
        $standard = array("0","1","2","3","4","5","6","7","8","9");
        $eastern_arabic_symbols = array("٠","١","٢","٣","٤","٥","٦","٧","٨","٩");
        $phone = str_replace($eastern_arabic_symbols, $standard, $phone);
        if (substr($phone, 0, 5) == '00966'){
            $phone = str_replace("00966", "966", $phone);
            $phone = ltrim($phone, '966');
            $phone = ltrim($phone, '0');   
            $phone = '20'.$phone;  
        }

        else if (substr($phone, 0, 3) == '966'){
            //IF PHONE NUMBER HAVING 20 and 0 after that
            $phone = ltrim($phone, '966');
            $phone = ltrim($phone, '0');   
            $phone = '966'.$phone;  
        }

        //IF PHONE NUMBER NOT HAVING 20
        else if (substr($phone, 0, 3) != '966' && substr($phone, 0, 5) != '00966'){
            $phone = ltrim($phone, '0');   
            $phone = '966'.$phone;     
        }
        $phone = str_replace("+966", "966", $phone);
        return $phone;
    }

  
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
            CURLOPT_POSTFIELDS => "{ \"body\": \" $message \",\"to\" : \"$mobileNumber\",\"from\": \"HelpWay\"}",
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

    /**
     * import Orders Excel
     */
    public function import(Request $request) {
        $this->validate($request , [
            'orders_file' => 'required',
        ],[] ,['orders_file' => 'الملف']);

        $customer = Auth::guard('customer')->user();

        Excel::import(new fastOrderImport($customer), $request->orders_file);
        return back()->with(['type' => 'success' , 'message' => 'تم رفع الطلبات بنجاح']);
     }
}
