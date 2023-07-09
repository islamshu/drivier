<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\fastOrderImport;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderLog;
use App\Models\Notification;
use App\Models\Alert;
use App\Models\Support;
use App\Models\City;
use App\Models\Reply;
use App\Driver;
use App\Customer;
use Auth;
use DB;
use Validator;
use Datatables;
use PDF;
use Avatar;
use Carbon\Carbon;
use Picqer\Barcode\BarcodeGeneratorSVG;
use App\Imports\AdminOrdersImport;
use LaravelLocalization;
class OrderController extends Controller
{


    // note / description longText with spaces
    
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
        $this->middleware('role:orders');
        $this->middleware('role:orders_editing');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

        
        if ($request->ajax()) {

            if (Auth::guard('admin')->user()->id == 1) {
                $orders = Order::whereNotIn('status' , ['car_damage' , 'rescheduled'])->get();
            }else {
                $city_id  = Auth::guard('admin')->user()->city_id;
                $orders = Order::whereNotIn('status' , ['car_damage' , 'rescheduled'])
                        ->where('city_id' , $city_id)
                        ->get();
            }
            
            return datatables()->of($orders)->addColumn('loop', function ($data) {
                return $data->id;
            })->addColumn('id', function ($data) {
                $button = '<a href="' . url(route('orders.show', [$data->id])) . '" class="text-primary">' . $data->order_id . '</a>';
                return $button;
            })->addColumn('name', function ($data) {
                $name = $data->name ?? 'N/A';
                if ($data->type == 1) {
                    return $name;
                }
            })->addColumn('region', function ($data) {
                    $address = $data->city->name . ' ' . $data->region;
                    return $address;

            })->addColumn('status', function ($data) {

                if ($data->status == 'unassigned') {
               return '<a href="javascript:;" class="text-danger" data-orderid="'.$data->id.'" data-orderlongid="'.$data->order_id.'"  data-toggle="modal" data-target="#changeOrderStatus">'.trans('app.assign_to_driver').'</a>';
               //     return '<a href="javascript:;" class="badge badge-info" style="background-color: #ffd22d">' . trans('app.assign_to_driver') . '</a>';
                } elseif ($data->status == 'assign_to_driver') {
                    return '<a href="javascript:;" class="badge badge-info" style="background-color: #ffd22d">' . trans('app.assign_to_driver') . '</a>';
                } elseif ($data->status == 'delivered') {
                    return '<a href="javascript:;" class="badge badge-success">' . trans('app.delivered') . '</a>';
                } elseif ($data->status == 'to_be_delivered') {
                    return '<a href="javascript:;" class="badge badge-info">' . trans('app.to_be_delivered') . '</a>';
                } elseif ($data->status == 'rescheduled') {
                    return '<a href="javascript:;" class="badge badge-success">' . trans('app.rescheduled') . '</a>';
                } elseif ($data->status == 'car_damage') {
                    return '<a href="javascript:;" class="badge badge-danger">' . trans('app.car_damage') . '</a>';
                } elseif ($data->status == 'canceled') {
                    return '<a href="javascript:;" class="badge badge-danger">' . trans('app.canceled') . '</a>';
                    //accept
                } elseif ($data->status == 'start') {
                    return '<a href="javascript:;" class="badge badge-info" style="background-color: #006d20">' . trans('app.start') . '</a>';
                } elseif ($data->status == 'accepted') {
                    return '<a href="javascript:;" class="badge badge-info" style="background-color: #ff34cb">' . trans('app.accepted') . '</a>';
                    //end accept
                } else {
                    return '<a href="javascript:;" class="text-danger">' . $data->status . '</a>';
                }

            })->addColumn('date', function ($data) {
                return $data->created_at->format('Y/m/d h:i');
            })->addColumn('goods_type', function ($data) {
                return $data->goods_type ?? 'N/A';
            })->addColumn('approx_km', function ($data) {
                $approx_km = $data->approx_km ?? 0;

                return $approx_km . ' ' . trans('app.km');
            })
                ->addColumn('delivery_fees', function ($data) {
                    $cod_amount = $data->delivery_fees?? 'N/A';
                    return $cod_amount . ' ' . trans('app.ras');
                })
                ->addColumn('company', function ($data) {
                        return $data->company->company_name;
                    }) ->addColumn('customer', function ($data) {
                        return $data->customer->branch_name ;
                    })->addColumn('action', function ($data) {
                    $buttons = '<div class="dropdown custom-dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="flaticon-dot-three"></i>
                </a>
              
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <a class="dropdown-item" href="' . url(route('orders.show', [$data->id])) . '">' . trans('app.view') . '</a>
                    <a class="dropdown-item" href="' . url(route('admin.order.pdf', [$data->id, 'order_id' => $data->order_id])) . '">' . trans('app.awb') . '</a>
                    <a target="_blank" class="dropdown-item" href="' . url('/t/' . $data->id . '/' . $data->security_code) . '">' . trans('app.tracking') . '</a>
                   <a href="javascript:;" class="dropdown-item" data-orderid="' . $data->id . '" data-orderlongid="' . $data->order_id . '"  data-toggle="modal" data-target="#change_driver">' . trans('app.change_driver') . '</a>
                   <a href="javascript:;" class="dropdown-item" data-orderid="' . $data->id . '" data-orderlongid="' . $data->order_id . '"  data-toggle="modal" data-target="#CancellingOrder">' . trans('app.cancelOrder') . '</a>
                </div>
              </div>';
                    return $buttons;
                })->rawColumns([
                    'id', 'name', 'date', 'amount', 'status', 'company', 'action'])->make(true);
            
        }
        
        $city_id  = Auth::guard('admin')->user()->city_id;
        if (Auth::guard('admin')->user()->id == 1) {
            $drivers = Driver::where('active' ,1)->get();
        }else {
            $drivers = Driver::where('city_id' , $city_id)->where('active' ,1)->get();
        }
        $customers = Customer::orderByDesc('created_at')->get();
        return view('admin.orders.index' , compact('drivers' , 'customers'));
    }

    /**
     * Fast Deliverey Orders
     */
    public function fast_deliverey(Request $request) {

        if ($request->ajax()) {

            if (Auth::guard('admin')->user()->id == 1) {
                $orders = Order::where('type' , 1)
                    ->whereNotIn('status' , ['car_damage' , 'rescheduled'])
                    ->get();
            }else {
                $city_id  = Auth::guard('admin')->user()->city_id;
                $orders = Order::where('type' , 1)
                    ->whereNotIn('status' , ['car_damage' , 'rescheduled'])
                    ->where('city_id' , $city_id)
                    ->get();
            }
                
            return datatables()->of($orders)->addColumn('loop', function ($data) {
                return $data->id;
            })->addColumn('id', function ($data) {
                $button = '<a href="' . url(route('orders.show', [$data->id])) . '" class="text-primary">' . $data->order_id . '</a>';
                return $button;
            })->addColumn('name', function ($data) {
                $name = $data->name ?? 'N/A';
                $phone = $data->phone ?? 'N/A';
                $city = $data->city->name;
                $region = Str::limit($data->region, 20, '...') ?? 'N/A';
                if ($data->type == 1) {
                    return $name . '<br>' . $phone . '<br>' . $city . " ," . $region;
                } else {
                    $address = $data->city . ', <br> ' . $data->region;
                    return $name . '<br>' . $phone . '<br>' . $address;
                }
            })->addColumn('status', function ($data) {

                 if ($data->status == 'unassigned') {
                    return '<a href="javascript:;" class="text-danger" data-orderid="'.$data->id.'" data-orderlongid="'.$data->order_id.'"  data-toggle="modal" data-target="#changeOrderStatus">'.trans('app.assign_to_driver').'</a>';
                    //     return '<a href="javascript:;" class="badge badge-info" style="background-color: #ffd22d">' . trans('app.assign_to_driver') . '</a>';
                } elseif ($data->status == 'assign_to_driver') {
                    return '<a href="javascript:;" class="badge badge-info" style="background-color: #ffd22d">' . trans('app.assign_to_driver') . '</a>';
                } elseif ($data->status == 'delivered') {
                    return '<a href="javascript:;" class="badge badge-success">' . trans('app.delivered') . '</a>';
                } elseif ($data->status == 'to_be_delivered') {
                    return '<a href="javascript:;" class="badge badge-info">' . trans('app.to_be_delivered') . '</a>';
                } elseif ($data->status == 'rescheduled') {
                    return '<a href="javascript:;" class="badge badge-success">' . trans('app.rescheduled') . '</a>';
                } elseif ($data->status == 'car_damage') {
                    return '<a href="javascript:;" class="badge badge-danger">' . trans('app.car_damage') . '</a>';
                } elseif ($data->status == 'canceled') {
                    return '<a href="javascript:;" class="badge badge-danger">' . trans('app.canceled') . '</a>';
                    //accept
                } elseif ($data->status == 'start') {
                    return '<a href="javascript:;" class="badge badge-info" style="background-color: #006d20">' . trans('app.start') . '</a>';
                } elseif ($data->status == 'accepted') {
                    return '<a href="javascript:;" class="badge badge-info" style="background-color: #ff34cb">' . trans('app.accepted') . '</a>';
                    //end accept
                } else {
                    return '<a href="javascript:;" class="text-danger">' . $data->status . '</a>';
                }

            })->addColumn('date', function ($data) {
                return $data->created_at->format('Y/m/d h:i');
            })->addColumn('amount', function ($data) {
                return $data->delivery_fees . ' ' . trans('app.ras');
            })->addColumn('company', function ($data) {
                return $data->company->company_name;
            })->addColumn('action', function ($data) {

                $buttons = '<div class="dropdown custom-dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="flaticon-dot-three"></i>
                </a>
              
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <a class="dropdown-item" href="' . url(route('orders.show', [$data->id])) . '">' . trans('app.view') . '</a>
                    <a class="dropdown-item" href="' . url(route('admin.order.pdf', [$data->id, 'order_id' => $data->order_id])) . '">' . trans('app.awb') . '</a>
                    <a target="_blank" class="dropdown-item" href="' . url('/t/' . $data->id . '/' . $data->security_code) . '">' . trans('app.tracking') . '</a>
                </div>
              </div>';
                return $buttons;
            })->rawColumns([
                'id', 'name', 'date', 'amount', 'status', 'company', 'action'])->make(true);
        }
    
    }

    /**
     * Goods Deliverey Orders
     */
    public function goods_deliverey(Request $request) {
        if ($request->ajax()) {

            if (Auth::guard('admin')->user()->id == 1) {
                $orders = Order::where('type' , 0)
                    ->whereNotIn('status' , ['car_damage' , 'rescheduled'])
                    ->get();
            }else {
                $city_id  = Auth::guard('admin')->user()->city_id;
                $orders = Order::where('type' , 0)
                    ->whereNotIn('status' , ['car_damage' , 'rescheduled'])
                    ->where('city_id' , $city_id)
                    ->get();
            }
            
                return datatables()->of($orders)->addColumn('loop' , function($data) {
                    return $data->id;
                })->addColumn('id' , function($data){
                    $button = '<a href="'. url(route('orders.show' , [$data->id])) .'" class="text-primary">'. $data->order_id .'</a>';
                    return $button;
                })->addColumn('company' , function($data) {
                    return $data->customer->branch_name;
                })->addColumn('name', function($data){
                    $name = $data->name ?? 'N/A';
                    $city = $data->city->name;
                    $region = Str::limit($data->region, 20, '...') ?? 'N/A';
                    if ($data->type == 1) {
                        return $name . '<br>' . $city . " ,". $region;
                    } else {
                        $address = $data->city . ', <br> '. $data->region;
                        return $name . '<br>' . $address;
                    }
                })->addColumn('phone' , function($data) {
                    return $data->phone;
                })->addColumn('status' , function($data) {
    
                    if ($data->status == 'unassigned') {
                        return '<a href="javascript:;" class="text-danger" data-orderid="'.$data->id.'" data-orderlongid="'.$data->order_id.'"  data-toggle="modal" data-target="#changeOrderStatus">'.trans('app.assign_to_driver').'</a>';
                    }elseif ($data->status == 'assign_to_driver') {
                        return '<a href="javascript:;" class="text-primary" data-orderid="'.$data->id.'" data-orderlongid="'.$data->order_id.'"  data-toggle="modal" data-target="#change_driver">'.trans('app.change_driver').'</a>';
                    }else {
                        return '<a href="javascript:;" class="text-primary" data-orderid="'.$data->id.'" data-orderlongid="'.$data->order_id.'"  data-toggle="modal" data-target="#change_driver">'.trans('app.change_driver').'</a>';
                    }
                    
                })->addColumn('dirverName' , function($data) {
                    return $data->driver->fname . ' ' . $data->driver->lname;
                })->addColumn('driver_phone' , function($data) {
                    $phone = $data->driver->phone ?? 'N/A';
                    return $phone;
                })->addColumn('delivery_fee' , function($data) {
                    $delivery_fees = $data->delivery_fees ?? 'N/A';
                    return $delivery_fees . ' ' . trans('app.ras');
                })->addColumn('distance' , function($data) {
                    $approx_km = $data->approx_km ?? 0;
                    return $approx_km . ' '. trans('app.km') ?? 'N/A';
                })->addColumn('time' , function($data) {
                    return $data->approx_time ?? 'N/A';
                })->addColumn('date' , function($data) {
                    return $data->created_at;
                })->addColumn('updated_at' , function($data) {
                    return $data->updated_at;
                })->addColumn('canceld_at' , function($data) {
                    return $data->canceled_at;
                })->addColumn('canceled_after' , function($data) {
                    return $data->canceled_after;
                })->addColumn('amount' , function($data) {
                    $cod_amount = $data->cod_amount ?? 'N/A';
                    return $cod_amount . ' ' . trans('app.ras');
                })->addColumn('action' , function($data) {
                    $buttons = '<div class="dropdown custom-dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="flaticon-dot-three"></i>
                    </a>
                  
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                        <a class="dropdown-item" href="'. url(route('orders.show' , [ $data->id])) .'">'.trans('app.view').'</a>
                        <a class="dropdown-item" href="'. url(route('admin.order.pdf' , [ $data->id , 'order_id' => $data->order_id])) .'">'.trans('app.awb').'</a>
                        <a target="_blank" class="dropdown-item" href="'. url('/t/' . $data->id . '/' . $data->security_code).'">'.trans('app.tracking').'</a>
                    </div>
                  </div>';
                  return $buttons;
                })->rawColumns([
                    'id', 'name' ,'date' , 'canceld_at' ,'canceled_after', 'amount' , 'driver_phone', 'status' , 'company' , 'action'])->make(true);
        }
    
    }
    /**
     * requrire_attention
     * 
     */

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function requrireAttention(Request $request)
    {   

        
        if ($request->ajax()) {

            if (Auth::guard('admin')->user()->id == 1) {
                $orders = Order::where('status' , 'car_damage')
                        ->OrWhere('status' , 'rescheduled')
                        ->get();
            }else {
                $city_id  = Auth::guard('admin')->user()->city_id;
                $orders = Order::where('status' , 'car_damage')
                        ->OrWhere('status' , 'rescheduled')
                        ->where('city_id' , $city_id)
                        ->get();
            }
            
            return datatables()->of($orders)->addColumn('loop' , function($data) {
                return $data->id;
            })->addColumn('id' , function($data){
                $button = '<a href="'. url(route('orders.show' , [ $data->id])) .'" class="text-primary">'. $data->order_id .'</a>';
                return $button;
            })->addColumn('name', function($data){
                $name = $data->name ?? 'N/A';
                $phone = $data->phone ?? 'N/A';
                $city = $data->city->name;
                $region = Str::limit($data->region, 20, '...') ?? 'N/A';
                if ($data->type == 1) {
                    return $name . '<br>' . $phone . '<br>' . $city . " ,". $region;
                } else {
                    $address = $data->city . ', <br> '. $data->region;
                    return $name . '<br>' . $phone . '<br>' . $address;
                }
            })->addColumn('status' , function($data) {

                if ($data->status == 'unassigned') {
                    return '<a href="javascript:;" class="text-danger" data-orderid="'.$data->id.'" data-orderlongid="'.$data->order_id.'"  data-toggle="modal" data-target="#changeOrderStatus">'.trans('app.assign_to_driver').'</a>';
                }elseif ($data->status == 'assign_to_driver') {
                    return '<a href="javascript:;" class="text-primary" data-orderid="'.$data->id.'" data-orderlongid="'.$data->order_id.'"  data-toggle="modal" data-target="#change_driver">'.trans('app.change_driver').'</a>';
                }elseif($data->status == 'delivered') {
                    return '<a href="javascript:;" class="badge badge-success">'. trans('app.delivered') .'</a>';
                }elseif($data->status == 'to_be_delivered') {
                    return '<a href="javascript:;" class="badge badge-info">'. trans('app.to_be_delivered') .'</a>';
                }elseif($data->status == 'rescheduled') {
                    return '<a href="javascript:;" class="badge badge-success">'. trans('app.rescheduled') .'</a>';
                }elseif($data->status == 'car_damage') {
                    return '<a href="javascript:;" class="badge badge-danger" data-orderid="'.$data->id.'" data-orderlongid="'.$data->order_id.'"  data-toggle="modal" data-target="#change_driver">'.trans('app.car_damage').'</a>';
                }else {
                    return '<a href="javascript:;" class="text-danger">'. $data->status .'</a>';
                }
                
            })->addColumn('date' , function($data) {

                return $data->created_at->format('Y/m/d h:i');
            })->addColumn('amount' , function($data) {
                return $data->delivery_fees . ' ' . trans('app.ras');
            })->addColumn('company' , function($data) {
                return $data->company->company_name;
            })->addColumn('action' , function($data) {                
                $buttons = '<div class="dropdown custom-dropdown">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="flaticon-dot-three"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                    <a class="dropdown-item" href="'. url(route('orders.show' , [ $data->id])) .'">'.trans('app.view').'</a>
                                    <a class="dropdown-item" href="'. url(route('admin.order.pdf' , [ $data->id , 'order_id' => $data->order_id])) .'">'.trans('app.awb').'</a>
                                    <a target="_blank" class="dropdown-item" href="'. url('/t/' . $data->id . '/' . $data->security_code).'">'.trans('app.tracking').'</a>
                                </div>
                            </div>';
              return $buttons;
            })->rawColumns([
                'id', 'name' ,'date' , 'amount' , 'status' , 'company' , 'action'])->make(true);
        }
        
        if (Auth::guard('admin')->user()->id == 1) {
            $drivers = Driver::where('active' ,1)->get();
        }else {
            $city_id  = Auth::guard('admin')->user()->city_id;
            $drivers = Driver::where('city_id' , $city_id)->where('active' ,1)->get();
        }
        return view('admin.orders.requrire_attention' , compact('drivers'));
    }



    /**
     * Change Status 
     * @var cancelOrder
     * @param $order_id
     * @return change_status
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
            'message'  => 'تم إلغاء الطلب من قبل الإدارة'  . $order->order_id . ' ' . $totalDuration ,
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
     * Change Status
     *  */    
    public function changeStatus(Request $request) {

        $order = Order::find($request->order_id);
        if ($order) {
            
            if ($request->status == 'assign_to_driver') {

                // dd($request);
                $this->validate($request , [
                    'order_id' =>  'required|not_in:0', 
                ],[] , ['order_id' => trans('app.id')]);
              

                Notification::create([
                    'driver_id' => $request->driver_id,
                    'notification_ar' => 'لديك طلب جديد',
                    'notification_en' => 'You have new Order',
                ]);
                // $driver = Driver::find($request->driver_id);

                $orderLogs = new OrderLog;
                $orderLogs->order_id = $request->order_id;
                $orderLogs->change_by_user = Auth::guard('admin')->user()->name;
                $orderLogs->note_ar = 'تم تسليم الطلب للسائق';
                $orderLogs->note_en = 'The Order Delivered to the Driver';
                $orderLogs->save();
                
                $update = Order::where('id' , $order->id)->update(array(
                    'status' => $request->status,
                    'driver_id' => $request->driver_id,
                    'change_by_user' => Auth::guard('admin')->user()->name
                ));                

                if ($update) {
                    return back()->with(['type' => 'success' , 'message' => trans('app.changeStatusSuccess')]);
                }else {
                    return back()->with(['type' => 'danger' , 'message' => trans('app.saveFailes')]);
                }
            }elseif($request->status == 'change_driver'){
                $this->validate($request , [
                    'order_id' =>  'required|not_in:0', 
                ],[] , ['order_id' => trans('app.id')]);

                Notification::create([
                    'driver_id' => $request->driver_id,
                    'notification_ar' => 'لديك طلب جديد',
                    'notification_en' => 'You have new Order',
                ]);


                $orderLogs = new orderLog;
                $orderLogs->order_id = $order->id;
                $orderLogs->change_by_user = Auth::guard('admin')->user()->name;
                $orderLogs->note_en = 'The Order delivered to other Driver';
                $orderLogs->note_ar = 'تم تسليم الشحنة إلى سائق أخر';
                $orderLogs->save();
                
                
                $update = Order::where('id' , $order->id)->update(array(
                    'status' => 'assign_to_driver',
                    'driver_id' => $request->driver_id,
                    'change_by_user' => Auth::guard('admin')->user()->name,
                ));


                if ($update) {
                    return back()->with(['type' => 'success' , 'message' => trans('app.changeStatusSuccess')]);
                }else {
                    return back()->with(['type' => 'danger' , 'message' => trans('app.saveFailes')]);
                }
            } else {
                return back()->with(['type' => 'danger' , 'message' => trans('app.saveFailes')]);
            }
        }
        
    }
















    // supportRequest

    public function supportRequest() {
        $supports = Support::orderBy('created_at' , 'desc')->paginate(20);
        return view('admin.orders.supportRequest', compact('supports'));
    }

    public function supportStore(Request $request , $support_id) {
        $form_validate = [
            'reply' => 'الرد',
        ];

        if ($request->isMethod('post')) {
            $this->validate($request , [
                'reply' => 'required',
            ], [] , $form_validate);

            $reply = new Reply;
            $reply->support_id = $support_id;
            $reply->reply = $request->reply;

            $reply->save();


            return back()->with(['type' => 'success' , 'message' => trans('app.saveSuccessful')]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        if ($order) {
            return view('admin.orders.show' , compact('order'));
        }else {
            return redirect()->route('admin.dashboard')->with(['type' => 'danger' , 'message' => trans('app.saveFailes')]);
        }
    }


    /**
     * 
     * Print PDF
     */


    public function pdf($id , $order_id)
    {
        $order = Order::where('order_id','=',$order_id)->find($id);

        $generator = new BarcodeGeneratorSVG;
        $svg = $generator->getBarcode($order->order_id, $generator::TYPE_CODE_128 , 2 , 50);
        $svg2 = $generator->getBarcode($order->order_id, $generator::TYPE_CODE_128 , 2 , 15);
        // $pdf = PDF::loadView('customer.orders.pdf', compact('order' , 'svg' , 'svg2') , [], ['format' => 'A4-L']);

        $svg = str_replace('<?xml version="1.0" standalone="no" ?>', "" , $svg);
       $svg2 = str_replace('<?xml version="1.0" standalone="no" ?>', "" , $svg2);
       
        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            $pdf = PDF::loadView('customer.orders.pdfar', compact('order' , 'svg' , 'svg2'));
        }else {
            $pdf = PDF::loadView('customer.orders.pdf', compact('order' , 'svg' , 'svg2'));
        }
        $filename = 'airwaybill_' . date('M d Y', $order->created_at->timestamp) .'.pdf';
        return $pdf->download($filename);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        return view('admin.orders.edit' , compact('order'));
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






    /**
    * 
    * notifications
    * 
    */

    public function notifications() {
        if (Auth::guard('admin')->user()->id == 1) {
            $orders = Order::orderBy('created_at' , 'desc')->paginate(20);
            $drivers = Driver::where('active' ,1)->get();
        }else {
            $city_id  = Auth::guard('admin')->user()->city_id;
            $orders = Order::where('city_id',$city_id)->orderBy('created_at' , 'desc')->paginate(20);
            $drivers = Driver::where('city_id',$city_id)->where('active' ,1 )->get();
        }

        return view('admin.notifications.index' , compact('orders' , 'drivers'));
    }





    /**
     * 
     * Admin Map
     * 
     */
    public function map() {
        date_default_timezone_set("Asia/Riyadh");

        if (Auth::guard('admin')->user()->id == 1) {
            $customers = Customer::get();
            $orders = Order::with('customer')->where('status' , 'assign_to_driver')->get();
            $onlineDrivers = Driver::where('active' , 1)->where('online' , 1)->get();
            $drivers  = Driver::where('active' ,1)->where('online' , 0)->get();
        }else {
            $city_id  = Auth::guard('admin')->user()->city_id;
            $city = City::find($city_id);
            $customers = Customer::where('city_id' , $city_id)->get();
            $orders = Order::with('customer')->where('city_id' , $city_id)->where('status' , 'assign_to_driver')->get();
            $onlineDrivers = Driver::where('city_id' , $city_id)->where('active' , 1)->where('online' , 1)->get();
            $drivers  = Driver::where('city_id' , $city_id)->where('active' ,1)->where('online' , 0)->get();
        }

        return view('admin.map.map' , compact('customers' , 'orders' , 'onlineDrivers' , 'drivers','city'));
    }

    public function mapCustomers($id) {
        if (Auth::guard('admin')->user()->id == 1) {
           $customers = Customer::get();
        }else {
            $city_id  = Auth::guard('admin')->user()->city_id;
            $customers = Customer::where('city_id' , $city_id)->get();
        }
       return response()->json($customers);
    }


    /**
     * Map Show Orders
     */

    public function mapOrders($id) {
        if (Auth::guard('admin')->user()->id == 1) {
            $orders = Order::with('customer')->where('status' , 'assign_to_driver')->get();
        }else {
            $city_id  = Auth::guard('admin')->user()->city_id;
            $orders = Order::with('customer')->where('city_id',$city_id)->where('status' , 'assign_to_driver')->get();   
        }
        return response()->json($orders);
    }

    /**
     * Online Drivers
     */
    public function mapOnlineDrivers($id) {
        if (Auth::guard('admin')->user()->id == 1) {
            $onlineDrivers = Driver::where('active' , 1)->where('online' , 1)->get();
        }else {
            $city_id  = Auth::guard('admin')->user()->city_id;
            $onlineDrivers = Driver::where('city_id' , $city_id)->where('active' , 1)->where('online' , 1)->get();   
        }
        return response()->json($onlineDrivers);
    }

    public function mapDrivers($id) {
        if (Auth::guard('admin')->user()->id == 1) {
            $drivers  = Driver::where('active' ,1)->where('online' , 0)->get();
        }else {
            $city_id  = Auth::guard('admin')->user()->city_id;
            $drivers  = Driver::where('city_id',$city_id)->where('active' ,1)->where('online' , 0)->get();   
        }
        return response()->json($drivers);
    }

    /**
     * Mark Admin Notification as Read 
     */
    public function makeNotificationRead($id) {
        
        $orders = Order::where('city_id' , $id)->orderBy('created_at' , 'desc')->get();

        foreach ($orders as $order) {
            foreach ($order->alerts as $alert) {
                Alert::where('read','=', 0)->update(array('read' => 1));
            }  
        }
        
        return response()->json(true);
    }



    /**
     * 
     * getUnreadNotification
     */
    public function getUnreadNotification($id) {

        if (Auth::guard('admin')->user()->id == 1) {
            $orders = Order::orderBy('created_at' , 'desc')->get();
        }else {
            $city_id  = Auth::guard('admin')->user()->city_id;
            $orders = Order::where('city_id' , $city_id)->orderBy('created_at' , 'desc')->get();
        }

        $alerts = [];

        foreach ($orders as $order) {
            foreach ($order->alerts as $alert) {
                $alert = Alert::where('id',$alert->id)->where('read',0)->first();
                if ($alert) {
                    array_push($alerts , $alert); 
                } 
            }  
        }

        $alertsCount = count($alerts);

        if (count($alerts) != 0) {
            $response = [
                'code'    => 200,
                'success' => true,
                'count' => $alertsCount,
                'notifications'    => $alerts,
            ];
        }else {

            $response =  [
                'code' => 404,
                'success' => false,
                // 'notifications'    => $alerts,
            ];
        }
        return response()->json($response);
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * import Orders Excel
     */
    public function import(Request $request) {
        $this->validate($request , [
            'orders_file' => 'required',
            'customer_id' => 'required|not_in:0',
        ],[] ,['orders_file' => 'الملف']);

        $customer = Customer::findOrFail($request->customer_id);

        Excel::import(new fastOrderImport($customer), $request->orders_file);
        return back()->with(['type' => 'success' , 'message' => 'تم رفع الطلبات بنجاح']);
    }
}
