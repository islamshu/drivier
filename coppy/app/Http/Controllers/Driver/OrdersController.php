<?php

namespace App\Http\Controllers\Driver;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Status;
use App\Models\Company;
use App\Models\OrderLog;
use App\Driver;
use Auth;
use Validator;
use Datatables;
use PDF;
use Excel;
use Avatar;
use DB;
use Carbon\Carbon;
use Picqer\Barcode\BarcodeGeneratorSVG;
use LaravelLocalization;
class OrdersController extends Controller
{


    public function __construct()
    {
        $this->middleware('driver.auth:driver');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $driver_id = Auth::guard('driver')->user()->id;
            $orders = Status::with('order')->where('driver_id', $driver_id)->get();
            
            return datatables()->of($orders)->addColumn('id' , function($data){
                $button = '<a href="'. url(route('myorders.show' , [$data->order->id])) .'" class="text-primary">'. $data->order->order_id .'</a>';
                return $button;
            })->addColumn('name', function($data){
               return $data->order->name;
            })->addColumn('status' , function($data) {

                if ($data->order->status == 'assign_to_driver') {
                    return '<a href="javascript:;" class="btn btn-classic btn-success btn-sm" data-orderid="'.$data->order->id.'" data-orderlongid="'.$data->order->order_id.'"  data-toggle="modal" data-target="#changeOrderStatus">'.trans('app.start_deliverey').'</a>';
                }elseif ($data->order->status == 'to_be_delivered') {
                    return '<a href="javascript:;" class="text-danger" data-orderid="'.$data->order->id.'" data-orderlongid="'.$data->order->order_id.'"  data-toggle="modal" data-target="#changeOrderStatus">'. $data->order->status .'</a>';
                }elseif ($data->order->status == 'rescheduled') {
                    return '<a href="javascript:;" class="text-danger" data-orderid="'.$data->order->id.'" data-orderlongid="'.$data->order->order_id.'"  data-toggle="modal" data-target="#changeOrderStatus">'. $data->order->status .'</a>';
                }elseif ($data->order->status == 'delivered') {
                    return '<a href="javascript:;" class="badge badge-success">'.trans('app.delivered'). '</a>';
                }elseif ($data->order->status == 'to_be_returned') {
                    return '<a href="javascript:;"  class="badge badge-danger" >'.trans('app.returned'). '</a>';
                } else {
                    return '<a href="javascript:;" class="text-danger">'. $data->order->status .'</a>';
                }

            })->addColumn('date' , function($data) {
                return  Carbon::createFromTimeStamp(strtotime($data->created_at))->diffForHumans();
            })->addColumn('amount' , function($data) {
                return $data->order->cod_amount . ' '  . trans('app.ras');
            })->addColumn('company' , function($data) {
                return $data->order->company->company_name;
            })->addColumn('action' , function($data) {
                $buttons = '<div class="dropdown custom-dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="flaticon-dot-three"></i>
                </a>
              
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <a class="dropdown-item" href="'. url(route('myorders.show' , [$data->order->id])) .'">'.trans('app.view'). '</a>
                    <a class="dropdown-item" href="'. url(route('myorders.order.pdf' , [$data->order->id , 'order_id' => $data->order->order_id])) .'">'.trans('app.awb'). '</a>
                </div>
              </div>';
              return $buttons;
            })->rawColumns([
               'id', 'name' ,'date' , 'amount', 'status' , 'company' , 'action'])->make(true);
        }
        
        return view('driver.orders.index');
    }



    /**
     * 
     * changeStatus
     */
    public function changeStatus(Request $request) {
        $order = Order::find($request->order_id);

        $company = Company::findOrFail($order->company_id);
        if ($order) {
            if ($request->status == 'to_be_delivered') { // to_be_delivered

                $status = Status::where('order_id' , $order->id)->first();
                
                $update = $status->update(array(
                    'change_by_user' => Auth::guard('driver')->user()->name,
                    'note' => 'Status Changed by driver to to_be_delivered',
                ));

                Order::where('id' , $order->id)->update(array(
                    'status' => $request->status,
                ));
    
                $orderLogs = new orderLog;
                $orderLogs->order_id = $order->id;
                $orderLogs->change_by_user = Auth::guard('driver')->user()->name;
                $orderLogs->note_en = 'Status Changed to ' . $request->status;
                $orderLogs->note_ar = 'تغيرت حالة الطلب إلى ' . $request->status;
                $orderLogs->save();
                
                if ($update) {
                    return back()->with(['type' => 'success' , 'message' => 'Status Changed Successfuly']);
                }else {
                    return back()->with(['type' => 'danger' , 'message' => 'Faild , try again']);
                }
            }elseif ($request->status == 'rescheduled') { // rescheduled
                $status = Status::where('order_id' , $order->id)->first();
                
                $update = $status->update(array(
                    'change_by_user' => Auth::guard('driver')->user()->name,
                    'note' => 'Status Changed by driver to rescheduled',
                    'another_time' => $request->another_date .' '. $request->timedropper,
                ));

                Order::where('id' , $order->id)->update(array(
                    'status' => $request->status,
                ));
    
                $orderLogs = new orderLogs;
                $orderLogs->order_id = $order->id;
                $orderLogs->change_by_user = Auth::guard('driver')->user()->name;
                $orderLogs->note_en = 'Status Changed to ' . $request->status;
                $orderLogs->note_ar = 'تغيرت حالة الطلب إلى ' . $request->status;
                $orderLogs->save();
                
                if ($update) {
                    return back()->with(['type' => 'success' , 'message' => 'Status Changed Successfuly']);
                }else {
                    return back()->with(['type' => 'danger' , 'message' => 'Faild , try again']);
                }
            }elseif ($request->status == 'delivered') { // delivered
                $status = Status::where('order_id' , $order->id)->first();
                
                $update = $status->update(array(
                    'change_by_user' => Auth::guard('driver')->user()->name,
                    'client_age' => $request->client_age,
                    'client_gender' => $request->client_gender,
                    'client_nationality' => $request->client_nationality,
                    'note' => 'change status by driver to Delivered',
                ));

                $net_amount = $order->cod_amount - $company->delivery_fee;

                Order::where('id' , $order->id)->update(array(
                    'status' => $request->status,
                    'net_amount' =>  $net_amount,
                ));
    
                $orderLogs = new orderLogs;
                $orderLogs->order_id = $order->id;
                $orderLogs->change_by_user = Auth::guard('driver')->user()->name;
                $orderLogs->note_en = 'Status Changed to ' . $request->status;
                $orderLogs->note_ar = 'تغيرت حالة الطلب إلى ' . $request->status;
                $orderLogs->save();
                
                if ($update) {
                    return back()->with(['type' => 'success' , 'message' => 'Status Changed Successfuly']);
                }else {
                    return back()->with(['type' => 'danger' , 'message' => 'Faild , try again']);
                }
            }elseif ($request->status == 'to_be_returned') { // to_be_returned
                $status = Status::where('order_id' , $order->id)->first();
                
                $update = $status->update(array(
                    'change_by_user' => Auth::guard('driver')->user()->name,
                    'note' => $request->note,
                ));

                $net_amount = "-" . $company->return_fee;

                Order::where('id' , $order->id)->update(array(
                    'status' => $request->status,
                    'net_amount' =>  $net_amount,
                ));
    
                $orderLogs = new orderLogs;
                $orderLogs->order_id = $order->id;
                $orderLogs->change_by_user = Auth::guard('driver')->user()->name;
                $orderLogs->note_en = 'Status Changed to ' . $request->status;
                $orderLogs->note_ar = 'تغيرت حالة الطلب إلى ' . $request->status;
                $orderLogs->save();
                
                if ($update) {
                    return back()->with(['type' => 'success' , 'message' => 'Status Changed Successfuly']);
                }else {
                    return back()->with(['type' => 'danger' , 'message' => 'Faild , try again']);
                }
            }else {
                return back()->with(['type' => 'danger' , 'message' => 'Faild , try again']);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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

        if ($order->type == 0) {
            $awb_url = url(route('myorders.order.pdf' , [$order->id , 'order_id' => $order->order_id]));
        }else {
            $awb_url = url(route('printAramexAWBLabel' , [$order->order_id]));
        }

        return view('driver.orders.show' , compact('order' , 'awb_url'));
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
     * 
     * Driver Map
     * 
     */
    public function map() {
        
        $driver_id  = Auth::guard('driver')->user()->id;
    
        $orders = DB::table('statuses')
            ->join('orders', 'orders.id', '=', 'statuses.order_id')->whereIn('orders.status' , ['assign_to_driver' , 'to_be_delivered'])
            ->when($driver_id , function ($query , $driver_id) {
                $query->select()->from('statuses')->whereRaw('statuses.driver_id = '.$driver_id);
            })->get();


        $start = DB::table('statuses')
            ->join('orders', 'orders.id', '=', 'statuses.order_id')->whereIn('orders.status' , ['assign_to_driver' , 'to_be_delivered'])
            ->when($driver_id , function ($query , $driver_id) {
                $query->select()->from('statuses')->whereRaw('statuses.driver_id = '.$driver_id);
            })->first();

        


        $start_point = $start->region;
        $places = [];

        array_push($places , 'حي العارض');

        foreach ($orders as  $order) {
            $place = $order->region;
            
            array_push($places , $place);
            array_push($places , 'حي حطين');

        }

        array_push($places , 'حي الياسمين');
        
        // $start_point  = 'حي الياسمين';
        // $start_point = 'منتزه التمامة';
        $end_point = 'منتزه الملك سلمان البري';
        return view('driver.orders.map' , compact('places' , 'start_point' , 'end_point'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
