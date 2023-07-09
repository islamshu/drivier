<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Models\Company;
use App\Models\Order;
use DB;
use Auth;
class ReportController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('customer.auth:customer');
        $this->middleware('staff:branch');
    }


    public function payments(Request $request) {
        $customer = Customer::find(Auth::guard('customer')->user()->id);
        $company = Company::find($customer->company->id);

        $status = $request->input('status');

        if ($status == 'delivered') {

            $orders = DB::table('orders')
            ->where('company_id', $company->id)
            ->where(function ($query) {
                $query->where('status' , 'delivered');
            })->get();

        }elseif($status == 'to_be_returned') {

            $orders = DB::table('orders')
            ->where('company_id', $company->id)
            ->where(function ($query) {
                $query->where('status' , 'to_be_returned');
            })->get();

        } else {

            $orders = DB::table('orders')
            ->where('company_id', $company->id)
            ->where(function ($query) {
                $query->whereIn('status' , ['delivered' , 'to_be_returned']);
            })->get();
            
        }
        

        return view('customer.report.payments' , compact('company','orders'));
    }
}
