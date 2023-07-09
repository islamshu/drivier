<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\Status;
use App\Driver;
use Auth;
use DB;
class HomeController extends Controller
{

    protected $redirectTo = '/driver/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('driver.auth:driver');
    }

    /**
     * Show the Driver dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $driver_id  = Auth::guard('driver')->user()->id;
    
        $orders = DB::table('statuses')
            ->join('orders', 'orders.id', '=', 'statuses.order_id')
            ->when($driver_id , function ($query , $driver_id) {
                $query->select()->from('statuses')->whereRaw('statuses.driver_id = '.$driver_id);
            })->count();

        $totalDeliveredOrders = DB::table('statuses')
            ->join('orders', 'orders.id', '=', 'statuses.order_id')->where('orders.status' , '=' , 'delivered')
            ->when($driver_id , function ($query , $driver_id) {
                $query->select()->from('statuses')->whereRaw('statuses.driver_id = '.$driver_id);
            })->count();
        

        $totalReturnedOrders = DB::table('statuses')
            ->join('orders', 'orders.id', '=', 'statuses.order_id')->where('orders.status' , '=' , 'to_be_returned')
            ->when($driver_id , function ($query , $driver_id) {
                $query->select()->from('statuses')->whereRaw('statuses.driver_id = '.$driver_id);
            })->count();

        $totalBalance = Status::with('order')->where('driver_id', Auth::guard('driver')->user()->id)->get();

        return view('driver.home' , compact('orders','totalDeliveredOrders','totalReturnedOrders', 'totalBalance'));
    }

}