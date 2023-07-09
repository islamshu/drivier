<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Customer;
use App\Models\Company;
use App\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\WelcomeCompany;
use Illuminate\Support\Facades\Mail;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new admins as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    public function comapnyRegister(Request $request) {

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
            'company_type' => $request['company_type'],
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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/customer';

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
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:customers',
            'password' => 'required|min:8|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Supplier
     */
    protected function create(array $data)
    {

        $company = Company::create([
            'company_id'   => rand(111111111,999999999),
            'company_name' => $data['company_name'],
            'company_address' => $data['address'],
            'delivery_fee' => 0,
            'delivery_type' => 0,
            'city_id' => $data['city_id'],
            'company_phone' => $data['company_phone'],
        ]);

        $customer =  Customer::create([
            'company_id' => $company->id,
            'customer_id' => rand(111111111,999999999),
            'api_token' => Str::random(150),
            'branch_name' => $data['company_name'],
            'branch_address' => $data['address'],
            'branch_phone' => $data['company_phone'],
            'city_id' => $data['city_id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);


        $customer->roles()->sync([1]);

        return $customer;
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

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('customer');
    }

}
