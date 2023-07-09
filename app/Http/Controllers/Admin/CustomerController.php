<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Customer;
use App\Models\Order;
use Validator;
use Datatables;
use Auth;
class CustomerController extends Controller
{


    public function __construct()
    {
        $this->middleware('admin.auth:admin');
        $this->middleware('role:manage_stores');
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
                $customers = Customer::get();
            }else {
                $city_id  = Auth::guard('admin')->user()->city_id;
                $customers = Customer::where('city_id' , $city_id)->get();
            }

            
            return datatables()->of($customers)->addColumn('id' , function($data){
                return $data->customer_id;
            })->addColumn('name', function($data){
               return $data->name ;
            })->addColumn('email' , function($data) {
                return $data->email;
            })->addColumn('company' , function($data) {
                return $data->company->company_name;
            })->addColumn('branch' , function($data) {
                return $data->branch_name;
            })->addColumn('action' , function($data) {
                $buttons = '<div class="dropdown custom-dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="flaticon-dot-three"></i>
                </a>
              
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <a class="dropdown-item" href="'. url(route('customer.changePassword' , [$data->id])).'">'.trans('app.changepassword').'</a>
                    <a class="dropdown-item" href="'.url('admin/customer/'. $data->id . '/delete').'">'.trans('app.delete').'</a>
                </div>
              </div>';
              return $buttons;
            })->addColumn('date' , function($data) {
                $date = date('d/m/Y', $data->created_at->timestamp);
                return $date;
            })->rawColumns([
                'id', 'name' ,'email' , 'company' ,'branch' ,'date' , 'action'])->make(true);
        }

        return view('admin.customers.index');
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword($id)
    {
        $customer = Customer::find($id);
        return view('admin.customers.changePassword' , compact('customer'));
    }

    /**
     * Change Users Password
     * @var $id
     * @param $request
     * 
     */

    public function storePassword(Request $request , $id) {

        $customer = Customer::find($id);

        $form_validate = ['password' => trans('app.password')];
        $this->validate($request , [
            'password'    => 'required|min:8|confirmed',
        ] , [] , $form_validate);


        $changePass = Customer::find($customer->id)->update(array(
            'password' => bcrypt($request->password)
        ));

        return redirect()->route('customer.index')->with(['type' => 'success' , 'message' => trans('app.passwordSuccess')]);


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
        //
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
        $customer = Customer::find($id);
        if ($customer->forceDelete()) {
            return back()->with(['type' => 'success' , 'message' => 'Deleted Successfully']);
        }else {
            return back()->with(['type' => 'danger' , 'message' =>'Failed, Try Again']);
        }
    }
}
