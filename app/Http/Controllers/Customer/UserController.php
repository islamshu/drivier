<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\CustomerMatchOldPassword;
use Auth;
use App\Customer;
use App\Staff;
use App\Models\Company;
use App\Models\City;
use Validator;
use Datatables;
use Illuminate\Support\Str;
use Carbon\Carbon;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('customer.auth:customer');
        $this->middleware('staff:super');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer_id = Auth::guard('customer')->user()->id;
        
        if ($customer_id) {
            $customer = Customer::find($customer_id);
            return view('customer.auth.profile' , ['customer' => $customer]);
        }
    }


    /**
     * 
     * index Users 
     */

     public function users(Request $request) {

        if ($request->ajax()) {
            $company_id = Auth::guard('customer')->user()->company_id;
            $customer_id = Auth::guard('customer')->user()->id;
            
            $users = Customer::where('company_id' , $company_id)->latest()->get();
            
            return datatables()->of($users)->addColumn('id' , function($data){
                return $data->customer_id;
            })->addColumn('branch_name', function($data){
                return $data->branch_name;
            })->addColumn('name', function($data){
                return $data->name;
            })->addColumn('email' , function($data) {
                return $data->email;
            })->addColumn('roles' , function($data) {
                $roles = '' ;
                foreach ($data->roles as $role) {
                    $roles .= '<span class="badge badge-success badge-roundless">
                               '. $role->name . '
                            </span> ';
                }
                return $roles;
            })->addColumn('action' , function($data) {
               $buttons = '<div class="dropdown custom-dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="flaticon-dot-three"></i>
                </a>
              
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <a class="dropdown-item" href="'. url(route('users.customer.delete' , ['id' => $data->id])).'">'.trans('app.delete').'</a>
                </div>
              </div>';
              return $buttons;
            })->rawColumns(['id', 'branch_name' , 'name' , 'email' , 'roles' ,'action'])->make(true);
        }
        return view('customer.users.index');
     }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'oldPassword'   => ['required' , new CustomerMatchOldPassword],
            'password'      => 'required|min:6|confirmed',
        ]);

        
        Customer::find(Auth::guard('customer')->user()->id)->update(array(
            'password' => bcrypt($request->password)
        ));

        return redirect(route('customer.dashboard'))->with(['type' => 'success' ,'message' => 'Your password changed successfully']);
    }



    /**
     * 
     * create User 
     */

     public function create() {
         $roles = Staff::all();
         $cities = City::get();
         return view('customer.users.create' , compact('roles' , 'cities'));
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
            'email' => trans('app.email'),
            'password' => trans('app.password'),
        ];

        if ($request->isMethod('post')) {
            $this->validate($request , [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:customers',
                'password' => 'required|min:6|confirmed',
            ] , [] , $form_validate);

            

            $customer = Customer::create([
                'company_id' => Auth::guard('customer')->user()->company_id,
                'customer_id' => rand(111111111,999999999),
                'branch_name' => $request->branch_name,
                'branch_phone' => $request->branch_phone,
                'branch_address' => $request->branch_address,
                'branch_lat' => $request->branch_lat,
                'branch_long' => $request->branch_long,
                'city_id' => $request->city_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'api_token' => Str::random(150),
            ]);
            
            $customer->roles()->sync(request('role_id'));
            
            return redirect()->route('users.customer.index')->with(['type' => 'success' , 'message' => trans('app.saveSuccessful')]);
        }
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
            'name' => 'Name' ,
            'email' => 'Email' ,
        ];

        if ($request->isMethod('post')) {

            $this->validate($request , [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:customers,email,' . Auth::guard('customer')->user()->id,
            ] ,[] , $form_validate);

            $customer  = Customer::where('id' , $id)->update(array(
                'name' => $request->name,
                'email' => $request->email,
            ));

            if ($customer) {
                return back()->with(['type' => 'success' , 'message' => 'Profile Updated Successfully']);
            }else {
                return back()->with(['type' => 'danger' , 'message' =>'Failed, Try Again']);
            }
        }
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
