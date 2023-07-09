<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\OrderLog;
use App\Models\Order;
use Auth;
class HomeController extends Controller
{

    protected $redirectTo = '/admin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        if (Auth::guard('admin')->user()->id == 1) {
            $companies = Company::orderBy('created_at' , 'desc')->limit(6)->get();
            $logs = Order::orderBy('created_at' , 'desc')->limit(5)->get();
            $orders = Order::count();
            $deliverdOrders = Order::where('status' , 'delivered')->count();
            $returnedOrders = Order::where('status' , 'canceled')->count();
        }else {
            $city_id  = Auth::guard('admin')->user()->city_id;
            $companies = Company::where('city_id' , $city_id)->orderBy('created_at' , 'desc')->limit(6)->get();
            $logs = Order::where('city_id' , $city_id)->orderBy('created_at' , 'desc')->limit(5)->get();
            $orders = Order::where('city_id' , $city_id)->count();
            $deliverdOrders = Order::where('city_id' , $city_id)->where('status' , 'delivered')->count();
            $returnedOrders = Order::where('city_id' , $city_id)->where('status' , 'canceled')->count();
        }
        return view('admin.home' , compact('companies' , 'logs' , 'orders' , 'deliverdOrders' ,'returnedOrders'));
    }

}