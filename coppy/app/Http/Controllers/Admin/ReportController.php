<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Driver;
use App\Models\Order;
use App\Models\Company;
use App\Models\City;
use Validator;
use Datatables;
use DB;
use Auth;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
        $this->middleware('role:accounting');
    }


     /**
      * Get Payments reports 
      *
      */

      public function payments(Request $request) {

        $company_id = $request->input('company_id');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        $city_id  = Auth::guard('admin')->user()->city_id;


        if (isset($company_id)) {
            
            $this->validate($request , [
                'company_id' => 'required|not_in:0'
            ], [] , ['company_id' => 'Company']);
            
            $company = Company::find($company_id);            
            $orders = Order::where('company_id', $company->id)->whereBetween('created_at', [$from_date ." 00:00:00" , $to_date ." 23:59:59"])->whereIn('status' , ['delivered' , 'canceled'])->get();

            $companies = Customer::where('city_id' , $city_id)->get();
            return view('admin.reports.payments' , compact('companies' , 'company' , 'orders'));
        }else {
            $companies = Customer::where('city_id' , $city_id)->get();
            return view('admin.reports.payments' , compact('companies'));
        }
      }



    public function makePaid(Request $request) {
        

        if (is_array( $request->orders) || is_object( $request->orders)) {


            foreach ($request->orders as $key => $order) {


                $orders = Order::whereIn('id' , [$key])->update(array(
                    'payment' => 1,
                ));
            }


            return back()->with(['type' => 'success' , 'message' => trans('app.updatedSuccess')]);
            // dd($allorders);
        }

    }





      /**
      * Get Orders reports 
      *
      */

      public function orders(Request $request) {

        $status = $request->input('status');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $customer = $request->input('customer');

        $city_id  = Auth::guard('admin')->user()->city_id;
        
        $customers = Customer::get();
        if (isset($status) && isset($from_date) && isset($to_date) ) {

            if ($status != 'all') {
                if ($customer != 0) {
                    $orders = Order::where('customer_id' , $customer)->where('city_id',$city_id)->whereBetween('created_at', [$from_date ." 00:00:00" , $to_date ." 23:59:59"])->where('status' , $status)->get();
                }else {
                    $orders = Order::where('city_id',$city_id)->whereBetween('created_at', [$from_date ." 00:00:00" , $to_date ." 23:59:59"])->where('status' , $status)->get();
                }
                
            }else {
                if ($customer != 0) {
                    $orders = Order::where('customer_id' , $customer)->where('city_id',$city_id)->whereBetween('created_at', [$from_date ." 00:00:00" , $to_date ." 23:59:59"])->get();
                }else {
                    $orders = Order::where('city_id',$city_id)->whereBetween('created_at', [$from_date ." 00:00:00" , $to_date ." 23:59:59"])->get();
                }
            }

            
            return view('admin.reports.orders' , compact('orders' , 'customers'));
        }else {
            return view('admin.reports.orders' , compact('customers'));
        }
      }



      /**
      * Get companies reports 
      *
      */

      public function companies(Request $request) {

        $company_id = $request->input('company_id');

        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        
        $city_id  = Auth::guard('admin')->user()->city_id;

        if (isset($company_id)) {

            $this->validate($request , [
                'company_id' => 'required|not_in:0'
            ], [] , ['company_id' => 'Company']);
            
            $company = Customer::find($company_id);

            $totalOrders          = Order::where('company_id' , $company->id)->whereBetween('created_at', [$from_date ." 00:00:00" , $to_date ." 23:59:59"])->count();
            $totalDeliveredOrders = Order::where('company_id' , $company->id)->whereBetween('created_at', [$from_date ." 00:00:00" , $to_date ." 23:59:59"])->where('status' , 'delivered')->count();
            $totalReturnedOrders  = Order::where('company_id' , $company->id)->whereBetween('created_at', [$from_date ." 00:00:00" , $to_date ." 23:59:59"])->where('status' , 'to_be_returned')->count();
            $totalOrdersPayment   = Order::where('company_id' , $company->id)->whereBetween('created_at', [$from_date ." 00:00:00" , $to_date ." 23:59:59"])->sum('delivery_fees');
            $totalOrdersUnpaid    = Order::where('company_id' , $company->id)->whereBetween('created_at', [$from_date ." 00:00:00" , $to_date ." 23:59:59"])->where('payment' , 0)->sum('delivery_fees');
            $totalOrdersPaid      = Order::where('company_id' , $company->id)->whereBetween('created_at', [$from_date ." 00:00:00" , $to_date ." 23:59:59"])->where('payment' , 1)->sum('delivery_fees');


            $companies = Customer::where('city_id' , $city_id)->get();
            return view('admin.reports.companies' , compact('companies' , 'company' ,'totalOrders','totalDeliveredOrders','totalReturnedOrders','totalOrdersPayment','totalOrdersUnpaid','totalOrdersPaid'));
        }else {
            $companies = Customer::where('city_id' , $city_id)->get();
            return view('admin.reports.companies' , compact('companies'));
        }
      }




      /**
      * Get orders_by_company reports 
      *
      */

      public function orders_by_company(Request $request) {

        $city_id  = Auth::guard('admin')->user()->city_id;


        $company_id = $request->input('company_id');
        if (isset($company_id)) {

            $this->validate($request , [
                'company_id' => 'required|not_in:0'
            ], [] , ['company_id' => 'Company']);
            
            $company = Customer::find($company_id);

            $orders = Order::where('company_id' , $company->id)->paginate(20);

            $companies = Customer::where('city_id' , $city_id)->orderBy('created_at' , 'desc')->get();
            return view('admin.reports.ordersbycompany' , compact('companies' , 'company' ,'orders'));
        }else {
            $companies = Customer::where('city_id' , $city_id)->orderBy('created_at' , 'desc')->get();
            return view('admin.reports.ordersbycompany' , compact('companies'));
        }
      }


      /**
      * Get orders_by_driver reports 
      *
      */

      public function orders_by_driver(Request $request) {

        $driver_id = $request->input('driver_id');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        if (isset($driver_id) && isset($from_date) && isset($to_date)) {
            if ($driver_id != 0) {
                $driver = Driver::find($driver_id);
                $orders = Order::where('driver_id' , $driver->id)->whereBetween('created_at', [$from_date ." 00:00:00" , $to_date ." 23:59:59"])->paginate(20);
                $drivers = Driver::where('active',1)->get();
                return view('admin.reports.ordersbydriver' , compact('drivers' , 'driver','orders'));
            }else {
                $orders = Order::whereBetween('created_at', [$from_date ." 00:00:00" , $to_date ." 23:59:59"])->paginate(20);
                
                $drivers = Driver::where('active',1)->get();
                return view('admin.reports.ordersbydriver' , compact('drivers','orders'));
            }
        }else {
            $drivers = Driver::where('active',1)->get();
            return view('admin.reports.ordersbydriver' , compact('drivers'));
        }
      }

      /**
       * Reports 
       */

      public function reportpercity(Request $request) {

        $city_id = $request->input('city_id');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        $cities = City::get();

        if (isset($city_id) && isset($from_date) && isset($to_date) ) {
            $orders = Order::whereBetween('created_at', [$from_date ." 00:00:00" , $to_date ." 23:59:59"])->where('city_id' , $city_id)->get();
            return view('admin.reports.cities' , compact('orders' ,'cities'));
        }else {
            return view('admin.reports.cities' ,compact('cities'));
        }

      }
}
