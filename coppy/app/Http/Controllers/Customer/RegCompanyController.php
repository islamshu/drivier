<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\WelcomeCompany;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Customer;
use App\Models\Company;
use App\Models\City;
use Auth;
class RegCompanyController extends Controller
{

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/customer/login';


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('customer.guest');
    }
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $cities = City::get();
        return view('customer.auth.register' , compact('cities'));
    }


    public function signup(Request $request) {

        $form_validate = [
            'company_name' => trans('app.storename'),
            'name' => trans('app.name'),
        ];

        $this->validate($request, [
            'name' => 'required|max:255',
            'company_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:customers',
            'password' => 'required|min:8|confirmed',
        ],[] , $form_validate);

        $company = Company::create([
            'company_id'   => rand(111111111,999999999),
            'company_name' => $request['company_name'],
            'company_address' => $request['address'],
            'delivery_type' => 0,
            'city_id' => $request['city_id'],
            'company_phone' => $request['company_phone'],
            'company_type' => 1,
            'fee_fast' => 12,
            'fee_goods' => 12,
            'km_fast' => 10,
            'km_goods' => 10,
            'km_fee_fast' => 1,
            'km_fee_goods' => 1,
        ]);

        $customer =  Customer::create([
            'company_id' => $company->id,
            'customer_id' => rand(111111111,999999999),
            'api_token' => Str::random(150),
            'branch_name' => $request['company_name'],
            'branch_address' => $request['address'],
            'branch_phone' => $request['company_phone'],
            'city_id' => $request['city_id'],
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);


        $customer->roles()->sync([1]);

        Mail::to($request->email)->send(new WelcomeCompany($customer));

        return redirect()->route('customer.login')->with(['type' => 'success' , 'message' => trans('app.createCompanyAccountSuccess')]);

    }
}
