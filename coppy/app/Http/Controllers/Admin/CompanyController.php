<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Company;
use App\Models\CompanyWorks;
use App\Customer;
use App\Staff;
use App\Models\City;
use Validator;
use Datatables;
use Auth;

class CompanyController extends Controller
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
                $companies = Company::orderByDesc('created_at')->get();
            }else {
                $city_id  = Auth::guard('admin')->user()->city_id;
                $companies = Company::where('city_id' , $city_id)->get();
            }
            
            return datatables()->of($companies)->addColumn('id' , function($data){
                return $data->company_id;
            })->addColumn('name', function($data){
               return $data->company_name ;
            })->addColumn('phone' , function($data) {
                return $data->company_phone;
            })->addColumn('type' , function($data) {
                if ($data->company_type == 1) {
                    $type = '<span class="badge badge-info">' . trans('app.fast_deliverey') . '</span>';
                }

                return $type;
            })->addColumn('address' , function($data) {
                $address = $data->company_address . "<br>" . $data->city->name;
                return isset($address) ? $address : "N/A";
            })->addColumn('action' , function($data) {
                if ($data->status == 0) {
                    $buttons = '<div class="dropdown custom-dropdown">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="flaticon-dot-three"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                    <a class="dropdown-item" href="'. url(route('companies.active' , [$data->id])).'">'.trans('app.active').'</a>
                                    <a class="dropdown-item" href="'. url(route('companies.show' , [$data->id])).'">'.trans('app.view').'</a>
                                    <a class="dropdown-item" href="'. url(route('companies.edit' , [$data->id])).'">'.trans('app.edit').'</a>
                                </div>
                            </div>';
                }else {
                    $buttons = '<div class="dropdown custom-dropdown">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="flaticon-dot-three"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                    <a class="dropdown-item" href="'. url(route('companies.deactive' , [$data->id])).'">'.trans('app.deactive').'</a>
                                    <a class="dropdown-item" href="'. url(route('companies.show' , [$data->id])).'">'.trans('app.view').'</a>
                                    <a class="dropdown-item" href="'. url(route('companies.edit' , [$data->id])).'">'.trans('app.edit').'</a>
                                    <a class="dropdown-item" href="'. url(route('companies.addBranch' , [$data->id])).'">'.trans('app.branches') .'</a>
                                </div>
                            </div>';
                }
              return $buttons;
            })->addColumn('date' , function($data) {
                $date = date('d/m/Y  H:i', $data->created_at->timestamp);
                return $date;
            })->rawColumns([
                'id', 'name' , 'phone' , 'address' ,'date' , 'type' , 'action'])->make(true);
        }
        return view('admin.company.index');
    }


    /**
     * 
     * Add Branches 
     */

     public function addBranch($id) {
         $company = Company::find($id);

         $roles = Staff::all();
         $cities = City::get();
         return view('admin.company.add_branch' , compact('company','roles','cities'));
     }







     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBranch(Request $request)
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
            
            return redirect()->route('customer.index')->with(['type' => 'success' , 'message' => trans('app.saveSuccessful')]);
        }
    }


    /**
     * 
     * Activate Store Account
     * @param status
     * @var $id
     */
    public function active($id) {
        $company = Company::find($id);

        $update = $company->update(array(
            'status' => 1,
        ));

        if ($update) {
            return back()->with(['type' => 'success' , 'message' => trans('app.activeSuccess')]);
        }else {
            return back()->with(['type' => 'danger' , 'message' => trans('app.activeError')]);
        }
    }

    /**
     * 
     * Deactivate Store Account
     * @param status
     * @var $id
     */
    public function deactive($id) {
        $company = Company::find($id);

        $update = $company->update(array(
            'status' => 0
        ));

        if ($update) {
            return back()->with(['type' => 'success' , 'message' => trans('app.deactiveSuccess')]);
        }else {
            return back()->with(['type' => 'danger' , 'message' => trans('app.activeError')]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::get();
        return view('admin.company.create' , compact('cities'));
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
            'company_name' => trans('app.storename'),
            'name' => trans('app.name'),
        ];

        $this->validate($request, [
            'name' => 'required|max:255',
            'company_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:customers',
            'password' => 'required|min:8',
            'company_logo' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'day' => 'required',
        ],[] , $form_validate);

        if ($request->hasFile('company_logo')) {

            $company_logo = 'company_logo' . time() . '.' . $request->company_logo->getClientOriginalExtension();
            $request->company_logo->move(public_path('uploads/logos') , $company_logo);
            $url = 'public/uploads/logos/' . $company_logo;

        }else {
            $url = "";
        }

        $company = Company::create([
            'company_id'   => rand(111111111,999999999),
            'company_name' => $request['company_name'],
            'company_logo' => $url,
            'city_id' => $request['city_id'],
            'company_address' => $request['address'],
            'company_phone' => $request['company_phone'],
            'company_type' => 1,
            'company_currency' => $request['company_currency'],
            'company_Num' => $request['company_Num'],
            'company_taxNum' => $request['company_taxNum'],
            'company_carType' => $request['company_carType'],
            'contact_name' => $request['contact_name'],
            'contact_phone' => $request['contact_phone'],
            'contact_email' => $request['contact_email'],
            'contact_job' => $request['contact_job'],
            'bank_name' => $request['bank_name'],
            'bank_iban' => $request['bank_iban'],
            'bank_person' => $request['bank_person'],
            'bank_accountNum' => $request['bank_accountNum'],
            'bank_phone' => $request['bank_phone'],
            'bank_email' => $request['bank_email'],
            'company_lat' => $request['company_lat'],
            'company_long' => $request['company_long'],
            'delivery_type' => 0,
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
            'branch_lat' => $request['company_lat'],
            'branch_long' => $request['company_long'],
            'city_id' => $request['city_id'],
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        foreach ( $request->day as $day ) {
            isset($day['saturday']) ? $day['saturday'] = 1 : $day['saturday'] = 0;
            isset($day['sunday']) ? $day['sunday'] = 1 : $day['sunday'] = 0;
            isset($day['monday']) ? $day['monday'] = 1 : $day['monday'] = 0;
            isset($day['tuesday']) ? $day['tuesday'] = 1 : $day['tuesday'] = 0;
            isset($day['wednesday']) ? $day['wednesday'] = 1 : $day['wednesday'] = 0;
            isset($day['thursday']) ? $day['thursday'] = 1 : $day['thursday'] = 0;
            isset($day['friday']) ? $day['friday'] = 1 : $day['friday'] = 0;
            isset($day['from_time']) ? $day['from_time'] : $day['from_time'] = 0;
            isset($day['to_time']) ? $day['to_time'] : $day['to_time'] = 0;

            CompanyWorks::create([
                'company_id' => $company->id,
                'saturday'  => $day['saturday'],
                'sunday'  => $day['sunday'],
                'monday'  => $day['monday'],
                'tuesday'  => $day['tuesday'],
                'wednesday'  => $day['wednesday'],
                'thursday'  => $day['thursday'],
                'friday'  => $day['friday'],
                'from_time'  => $day['from_time'],
                'to_time'  => $day['to_time'],
            ]);
  
        }

        $customer->roles()->sync([1]);

        return back()->with(['type' => 'success' , 'message' => trans('app.saveSuccessful')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        if ($company) {
            return view('admin.company.show' , compact('company'));
        }else {
            return redirect()->route('admin.dashboard')->with(['type' => 'danger' , 'message' => trans('app.saveFailes')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        $cities = City::get();
        return view('admin.company.edit' , compact('company','cities'));
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
            'company_name' => trans('app.name'),
            'company_phone' => trans('app.phone'),
            'delivery_type' => trans('app.type'),
        ];

        if ($request->isMethod('post')) {

            
            $this->validate($request, [
                'company_name' => 'required|max:255',
                'company_phone' => 'required|max:255',
                'contract_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],[] , $form_validate);

            $company = Company::find($id);

            if ($request->hasFile('contract_image')) {
                $contract_image = 'contract_image' . time() . '.' . $request->contract_image->getClientOriginalExtension();
                $request->contract_image->move(public_path('uploads/contracts') , $contract_image);
                $url = 'public/uploads/contracts/' . $contract_image;
            }else {
                $url = '';
            }

            // dd($request);
            $update = $company->update(array(
                'company_name' => $request->company_name,
                'company_phone' => $request->company_phone,
                'contract_image' => $url,
                'delivery_type' => $request->delivery_type,
                'delivery_fee'  => $request->delivery_fee,
                'company_type' => 1,
                'fee_fast' => $request->fee_fast,
                'fee_goods' => $request->fee_goods,
                'km_fast' => $request->km_fast,
                'km_goods' => $request->km_goods,
                'km_fee_fast' => $request->km_fee_fast,
                'km_fee_goods' => $request->km_fee_goods,
                'city_id' => $request->city_id,
            ));

            if ($update) {
                return back()->with(['type' => 'success' , 'message' => trans('app.updatedSuccess')]);
            }else {
                return back()->with(['type' => 'danger' , 'message' => trans('app.updatedError')]);
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
        //
    }





}
