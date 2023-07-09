<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyWorks;
use App\Models\City;
use App\Customer;
use Auth;
use Validator;

class CompanyController extends Controller
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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_id = Auth::guard('customer')->user()->company_id;
        $company = Company::find($company_id);
        $cities = City::get();

        $city = City::find(Auth::guard('customer')->user()->city_id);
        return view('customer.company.index' , compact('company' , 'cities','city'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
            'company_name' => trans('app.name'),
            'company_phone' => trans('app.phone'),
            'company_address' => trans('app.address'),
            'company_logo' => trans('app.company_logo'),
        ];

        $company = Company::find($id);

        if ($request->isMethod('post')) {

            $this->validate($request , [
                'company_name' => 'required|max:255',
                'city_id' => 'required|not_in:0',
                'company_logo' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            ] , [] , $form_validate);

            if ($request->hasFile('company_logo')) {

                $company_logo = 'company_logo' . time() . '.' . $request->company_logo->getClientOriginalExtension();
                $request->company_logo->move(public_path('uploads/logos') , $company_logo);
                $url = 'public/uploads/logos/' . $company_logo;

            }else {
                $url = $company->company_logo;
            }

            // dd($request->workings_day);

            $customer = Customer::where('company_id' , $company->id)->first();

            $customer->update(array(
                'branch_name' => $request->company_name,
                'branch_phone' => $request->company_phone,
                'branch_address' => $request->company_address,
                'branch_lat' => $request->company_lat,
                'branch_long' => $request->company_long,
                'city_id' => $request->city_id,
            ));

            

            if (isset($request->day)) {
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
            }

            
            $update = $company->update(array(
                'company_name' => $request->company_name,
                'company_phone' => $request->company_phone ,
                'company_address' => $request->company_address ,
                'company_logo' => $url,
                'city_id' => $request->city_id,
                'company_carType' => $request->company_carType,
                'company_currency' => $request->company_currency,
                'company_Num' => $request->company_Num,
                'company_taxNum' => $request->company_taxNum,
                'contact_phone' => $request->contact_phone,
                'contact_name' => $request->contact_name,
                'contact_email' => $request->contact_email,
                'contact_job' => $request->contact_job,
                'bank_name' => $request->bank_name,
                'bank_iban' => $request->bank_iban,
                'bank_person' => $request->bank_person,
                'bank_accountNum' => $request->bank_accountNum,
                'bank_phone' => $request->bank_phone,
                'bank_email' => $request->bank_email,
                'company_lat' => $request->company_lat,
                'company_long' => $request->company_long,
                'company_type' => 1,
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
