<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Company;
use App\Customer;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{

    protected $redirectTo = '/customer/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('customer.auth:customer');
    }

    /**
     * Show the Supplier dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $customer = Customer::find(Auth::guard('customer')->user()->id);
        $company = Company::find($customer->company->id);

        $totalOrders = Order::where('customer_id' , $customer->id)->count();
        $totalDeliveredOrders = Order::where('customer_id' , $customer->id)->where('status' , 'delivered')->count();
        $totalReturnedOrders = Order::where('customer_id' , $customer->id)->where('status' , 'to_be_returned')->count();
        
        $totalOrdersPayment = Order::where('customer_id' , $customer->id)->sum('cod_amount');
        $totalOrdersUnpaid = Order::where('customer_id' , $customer->id)->where('payment' , 0)->sum('cod_amount');
        $totalOrdersPaid = Order::where('customer_id' , $customer->id)->where('payment' , 1)->sum('cod_amount');
        return view('customer.home' , compact('company' , 'totalOrders' , 'totalDeliveredOrders' , 'totalReturnedOrders' , 'totalOrdersPayment' , 'totalOrdersUnpaid' , 'totalOrdersPaid'));
    }

}