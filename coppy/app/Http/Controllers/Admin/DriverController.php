<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Driver;
use App\Models\Order;
use App\Models\City;
use App\Models\Vehicle;
use Illuminate\Support\Str;
use App\Models\DriverWorks;
use App\Models\Notification;
use App\Models\Panishment;
use App\Models\Attendance;
use App\Models\Rating;
use App\Models\Country;
use Validator;
use Datatables;
use DB;
use Auth;
use Carbon\Carbon;
class DriverController extends Controller
{


    public function __construct()
    {
        $this->middleware('admin.auth:admin');
        $this->middleware('role:drivers');
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
                $drivers = Driver::get();
            }else {
                $city_id  = Auth::guard('admin')->user()->city_id;
                $drivers = Driver::where('city_id' , $city_id)->get();
            }
            return datatables()->of($drivers)->addColumn('id', function($data){
               return $data->driver_id;
            })->addColumn('fname', function($data){
                return $data->fname;
             })->addColumn('lname', function($data){
                return $data->lname;
             })->addColumn('login_info', function($data){
                return $data->email . '<br>' . $data->phone;
             })->addColumn('contract_type' , function($data) {
                 if( $data->type == 0) {
                     $type = trans('app.monthly_salary');
                 }elseif ($data->type == 1) {
                    $type = trans('app.daily');
                 }else {
                    $type = trans('app.perorder');
                 }
                return  $type .' / ' . $data->salary;
            })->addColumn('vehicle' , function($data) {
                return  $data->vehicle->car_id . '<br>' . $data->vehicle->carName  . '<br>' . $data->vehicle->reg_number;
            })->addColumn('status' , function($data) {
                $active = $data->active;

                if ($active == 0) {
                    $btn = '<span class="badge badge-info">' . trans('app.new'). '</span>';
                }elseif ($active == 1) {
                    $btn = '<span class="badge badge-success">' . trans('app.active'). '</span>';
                }elseif ($active == 2) {
                    $btn = '<span class="badge badge-dark">' . trans('app.pending'). '</span>';
                }elseif ($active == 3) {
                    $btn = '<span class="badge badge-danger">' . trans('app.block'). '</span>';
                }

                return $btn;
            })->addColumn('action' , function($data) {
                $buttons = '<div class="dropdown custom-dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="flaticon-dot-three"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <a class="dropdown-item" href="'. url(route('drivers.show' , [$data->id])) .'">'. trans('app.view').'</a>
                    <a class="dropdown-item" href="'. url(route('drivers.edit' , [$data->id])) .'">'. trans('app.edit').'</a>
                    <a class="dropdown-item" href="'. url(route('drivers.changePassword' , [$data->id])).'">'.trans('app.changepassword').'</a>
                </div>
              </div>';
              return $buttons;
            })->rawColumns([
                'id' , 'vehicle', 'status', 'login_info', 'fname','lname' , 'contract_type', 'action'])->make(true);
        }

        $cities = City::get();
        return view('admin.drivers.index', compact('cities'));
    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function activeDrivers(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::guard('admin')->user()->id == 1) {
                $drivers = Driver::active()->get();
            }else {
                $city_id  = Auth::guard('admin')->user()->city_id;
                $drivers = Driver::active()->where('city_id' , $city_id)->get();
            }

            return datatables()->of($drivers)->addColumn('id', function($data){
               return $data->driver_id;
            })->addColumn('fname', function($data){
                return $data->fname;
             })->addColumn('lname', function($data){
                return $data->lname;
             })->addColumn('login_info', function($data){
                return $data->email . '<br>' . $data->phone;
             })->addColumn('contract_type' , function($data) {
                 if( $data->type == 0) {
                     $type = trans('app.monthly_salary');
                 }elseif ($data->type == 1) {
                    $type = trans('app.daily');
                 }else {
                    $type = trans('app.perorder');
                 }
                return  $type .' / ' . $data->salary;
            })->addColumn('vehicle' , function($data) {
                return  $data->vehicle->car_id . '<br>' . $data->vehicle->carName  . '<br>' . $data->vehicle->reg_number;
            })->addColumn('status' , function($data) {
                $active = $data->active;

                if ($active == 0) {
                    $btn = '<span class="badge badge-info">' . trans('app.new'). '</span>';
                }elseif ($active == 1) {
                    $btn = '<span class="badge badge-success">' . trans('app.active'). '</span>';
                }elseif ($active == 2) {
                    $btn = '<span class="badge badge-dark">' . trans('app.pending'). '</span>';
                }elseif ($active == 3) {
                    $btn = '<span class="badge badge-danger">' . trans('app.block'). '</span>';
                }

                return $btn;
            })->addColumn('action' , function($data) {
                $buttons = '<div class="dropdown custom-dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="flaticon-dot-three"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <a class="dropdown-item" href="'. url(route('drivers.show' , [$data->id])) .'">'. trans('app.view').'</a>
                    <a class="dropdown-item" href="'. url(route('drivers.edit' , [$data->id])) .'">'. trans('app.edit').'</a>
                    <a class="dropdown-item" href="'. url(route('drivers.changePassword' , [$data->id])).'">'.trans('app.changepassword').'</a>
                </div>
              </div>';
              return $buttons;
            })->rawColumns([
                'id' , 'vehicle', 'status', 'login_info', 'fname','lname' , 'contract_type', 'action'])->make(true);
        }

        $cities = City::get();
        return view('admin.drivers.index', compact('cities'));
    }







    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pendingDrivers(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::guard('admin')->user()->id == 1) {
                $drivers = Driver::pending()->get();
            }else {
                $city_id  = Auth::guard('admin')->user()->city_id;
                $drivers = Driver::pending()->where('city_id' , $city_id)->get();
            }

            return datatables()->of($drivers)->addColumn('id', function($data){
               return $data->driver_id;
            })->addColumn('fname', function($data){
                return $data->fname;
             })->addColumn('lname', function($data){
                return $data->lname;
             })->addColumn('login_info', function($data){
                return $data->email . '<br>' . $data->phone;
             })->addColumn('contract_type' , function($data) {
                 if( $data->type == 0) {
                     $type = trans('app.monthly_salary');
                 }elseif ($data->type == 1) {
                    $type = trans('app.daily');
                 }else {
                    $type = trans('app.perorder');
                 }
                return  $type .' / ' . $data->salary;
            })->addColumn('vehicle' , function($data) {
                return  $data->vehicle->car_id . '<br>' . $data->vehicle->carName  . '<br>' . $data->vehicle->reg_number;
            })->addColumn('status' , function($data) {
                $active = $data->active;

                if ($active == 0) {
                    $btn = '<span class="badge badge-info">' . trans('app.new'). '</span>';
                }elseif ($active == 1) {
                    $btn = '<span class="badge badge-success">' . trans('app.active'). '</span>';
                }elseif ($active == 2) {
                    $btn = '<span class="badge badge-dark">' . trans('app.pending'). '</span>';
                }elseif ($active == 3) {
                    $btn = '<span class="badge badge-danger">' . trans('app.block'). '</span>';
                }

                return $btn;
            })->addColumn('action' , function($data) {
                $buttons = '<div class="dropdown custom-dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="flaticon-dot-three"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <a class="dropdown-item" href="'. url(route('drivers.show' , [$data->id])) .'">'. trans('app.view').'</a>
                    <a class="dropdown-item" href="'. url(route('drivers.edit' , [$data->id])) .'">'. trans('app.edit').'</a>
                    <a class="dropdown-item" href="'. url(route('drivers.changePassword' , [$data->id])).'">'.trans('app.changepassword').'</a>
                </div>
              </div>';
              return $buttons;
            })->rawColumns([
                'id' , 'vehicle', 'status', 'login_info', 'fname','lname' , 'contract_type', 'action'])->make(true);
        }

    }







    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @method blockDrivers
     */
    public function blockDrivers(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::guard('admin')->user()->id == 1) {
                $drivers = Driver::block()->get();
            }else {
                $city_id  = Auth::guard('admin')->user()->city_id;
                $drivers = Driver::block()->where('city_id' , $city_id)->get();   
            }
            return datatables()->of($drivers)->addColumn('id', function($data){
               return $data->driver_id;
            })->addColumn('fname', function($data){
                return $data->fname;
             })->addColumn('lname', function($data){
                return $data->lname;
             })->addColumn('login_info', function($data){
                return $data->email . '<br>' . $data->phone;
             })->addColumn('contract_type' , function($data) {
                 if( $data->type == 0) {
                     $type = trans('app.monthly_salary');
                 }elseif ($data->type == 1) {
                    $type = trans('app.daily');
                 }else {
                    $type = trans('app.perorder');
                 }
                return  $type .' / ' . $data->salary;
            })->addColumn('vehicle' , function($data) {
                return  $data->vehicle->car_id . '<br>' . $data->vehicle->carName  . '<br>' . $data->vehicle->reg_number;
            })->addColumn('status' , function($data) {
                $active = $data->active;

                if ($active == 0) {
                    $btn = '<span class="badge badge-info">' . trans('app.new'). '</span>';
                }elseif ($active == 1) {
                    $btn = '<span class="badge badge-success">' . trans('app.active'). '</span>';
                }elseif ($active == 2) {
                    $btn = '<span class="badge badge-dark">' . trans('app.pending'). '</span>';
                }elseif ($active == 3) {
                    $btn = '<span class="badge badge-danger">' . trans('app.block'). '</span>';
                }

                return $btn;
            })->addColumn('action' , function($data) {
                $buttons = '<div class="dropdown custom-dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="flaticon-dot-three"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <a class="dropdown-item" href="'. url(route('drivers.show' , [$data->id])) .'">'. trans('app.view').'</a>
                    <a class="dropdown-item" href="'. url(route('drivers.edit' , [$data->id])) .'">'. trans('app.edit').'</a>
                    <a class="dropdown-item" href="'. url(route('drivers.changePassword' , [$data->id])).'">'.trans('app.changepassword').'</a>
                </div>
              </div>';
              return $buttons;
            })->rawColumns([
                'id' , 'vehicle', 'status', 'login_info', 'fname','lname' , 'contract_type', 'action'])->make(true);
        }
    }



     

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::guard('admin')->user()->id == 1) {
            $Allvehicles = Vehicle::where('active' , 0)->orderBy('created_at','desc')->get();
        }else {
            $city_id  = Auth::guard('admin')->user()->city_id;
            $Allvehicles = Vehicle::where('city_id' , $city_id)->where('active' , 0)->orderBy('created_at','desc')->get();   
        }
        $countries = Country::get();
        $cities = City::get();
        // exists
        $vehicles = [];

        if (isset($Allvehicles)) {
            foreach ($Allvehicles as $vehicle) {
                if(!Driver::where('vehicle_id' , $vehicle->id)->exists()) {
                    // $item  = Vehicle::find($vehicle->id);
                    array_push($vehicles , $vehicle);
                }
            }
        }
        
        return view('admin.drivers.create' , compact('vehicles','cities' , 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request['valid_phone'] = str_replace("_" , "" , $request->phone );
        
        
        $form_validate = [
            'fname' => trans('app.fname'),
            'lname' => trans('app.lname'),
            'email' => trans('app.email'),
            'phone' => trans('app.phone'),
            'valid_phone' => trans('app.phone'),
            'password' => trans('app.password'),
            'state_num' => trans('app.state_num'),
            'vehicle_id' => trans('app.vehicle'),
            'license_image' => trans('app.license_image'),
            'nationality_image' => trans('app.nationality_image'),
            'state_image' => trans('app.state_image'),
            'car_isemara' => trans('app.car_isemara'),
            'bank_card' => trans('app.bank_card'),
            'account_number_image' => trans('app.account_number_image'),
        ];

        if ($request->isMethod('post')) {

            $this->validate($request , [
                'fname' => 'required',
                'lname' => 'required',
                'phone' => 'required|min:10|unique:drivers',
                'password' => 'required|min:6',
                'country_id' => 'required|not_in:0',
                'vehicle_id' => 'required|not_in:0',
                'license_image' => 'mimes:jpeg,png,jpg,gif,svg',
                'driver_image' => 'mimes:jpeg,png,jpg,gif,svg',
                'state_image' => 'mimes:jpeg,png,jpg,gif,svg',
                'car_image' => 'mimes:jpeg,png,jpg,gif,svg',
                'insurance_image' => 'mimes:jpeg,png,jpg,gif,svg',
                'car_isemara' => 'mimes:jpeg,png,jpg,gif,svg',
                'bank_card' => 'mimes:jpeg,png,jpg,gif,svg',
                'account_number_image' => 'mimes:jpeg,png,jpg,gif,svg',
                'day' => 'required',
            ] , [] , $form_validate);

            $driver = new Driver;
            $driver->driver_id = 'D' . rand(11111111,9999999);
            $driver->fname = $request->fname;
            $driver->lname = $request->lname;
            $driver->email = $request->email;
            $driver->password = Hash::make($request->password);
            $driver->phone = $request->phone;
            $driver->state_num = $request->state_num;
            $driver->bank_name = $request->bank_name;
            $driver->bank_num = $request->bank_num;
            $driver->country_id = $request->country_id;
            $driver->city_id = $request->city_id;
            $driver->vehicle_id = $request->vehicle_id;
            $driver->person_name = $request->person_name;
            $driver->license_num = $request->license_num;
            $driver->birthdate = $request->birthdate;
            $driver->birthdate_hijri = $request->birthdate_hijri;
            $driver->type = $request->type;
            $driver->salary = $request->salary;
            $driver->state_expire_date = $request->state_expire_date;
            $driver->license_expire_date = $request->license_expire_date;
            $driver->license_type = $request->license_type;
            $driver->language = $request->language;
            $driver->api_token = Str::random(100);

           
            // first image 
            if ($request->hasFile('license_image')) {
                $license_image = 'license_image' . time() . '.' . $request->license_image->getClientOriginalExtension();
                $request->license_image->move(public_path('uploads') , $license_image);
                $imageUrllicense_image = 'public/uploads/' . $license_image;
                $driver->license_image = $imageUrllicense_image;
            }
            // second
            
            if($request->hasFile('driver_image')) {
                $driver_image = 'driver_image' . time() . '.' . $request->driver_image->getClientOriginalExtension();
                $request->driver_image->move(public_path('uploads') , $driver_image);

                $imageUrldriver_image = 'public/uploads/' . $driver_image;
                $driver->driver_image = $imageUrldriver_image;
            }
            // state_image
            if ($request->hasFile('state_image')) {
                $state_image =  'state_image' . time() . '.' . $request->state_image->getClientOriginalExtension();
                $request->state_image->move(public_path('uploads') , $state_image);
                $imageUrlstate_image = 'public/uploads/' . $state_image;
                $driver->state_image = $imageUrlstate_image;
            }

            // car_image
            if($request->hasFile('car_image')) {
                $car_image =  'car_image' . time() . '.' . $request->car_image->getClientOriginalExtension();
                $request->car_image->move(public_path('uploads') , $car_image);
                $imageUrlcar_image = 'public/uploads/' . $car_image;
                $driver->car_image = $imageUrlcar_image;
            }


            // insurance_image
            if ($request->hasFile('insurance_image')) {
                $insurance_image =  'insurance_image' . time() . '.' . $request->insurance_image->getClientOriginalExtension();
                $request->insurance_image->move(public_path('uploads') , $insurance_image);
                $imageUrlinsurance_image = 'public/uploads/' . $insurance_image;
                $driver->insurance_image = $imageUrlinsurance_image;
            }

            // car_isemara
            if ($request->hasFile('car_isemara')) {
                $car_isemara =  'car_isemara' . time() . '.' . $request->car_isemara->getClientOriginalExtension();
                $request->car_isemara->move(public_path('uploads') , $car_isemara);
                $imageUrlcar_isemara = 'public/uploads/' . $car_isemara;
                $driver->car_isemara = $imageUrlcar_isemara;
            }

            // bank_card
            if ($request->hasFile('bank_card')) {
                $bank_card =  'bank_card' . time() . '.' . $request->bank_card->getClientOriginalExtension();
                $request->bank_card->move(public_path('uploads') , $bank_card);
                $imageUrlbank_card = 'public/uploads/' . $bank_card;
                $driver->bank_card = $imageUrlbank_card;
            }


            // account_number_image
            if ($request->hasFile('account_number_image')) {
                $account_number_image =  'account_number_image' . time() . '.' . $request->account_number_image->getClientOriginalExtension();
                $request->account_number_image->move(public_path('uploads') , $account_number_image);
                $imageUrlaccount_number_image = 'public/uploads/' . $account_number_image;
                $driver->account_number_image = $imageUrlaccount_number_image;
            }
            



            $driver->save();
            
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

                DriverWorks::create([
                    'driver_id' => $driver->id,
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

            return back()->with(['type' => 'success' , 'message' => trans('app.saveSuccessful')]);
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
        $driver = Driver::find($id);
        
        $orders = Order::where('driver_id', $driver->id)->get();

        $panishments = Panishment::get();
    
        if ($driver) {
            return view('admin.drivers.show' , compact('driver' , 'orders','panishments'));
        }else {
            return back()->with(['type' => 'success' , 'message' => 'Error , Try Again']);
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
        $driver = Driver::find($id);
    

        $cities = City::get();
        $vehicles = Vehicle::get();
        $countries = Country::get();
        if ($driver) {
            return view('admin.drivers.edit' , compact('driver','cities', 'vehicles' , 'countries'));
        }else {
            return back()->with(['type' => 'success' , 'message' => 'Error , Try Again']);
        }
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


        if ($request->isMethod('post')) {
            
            $request['valid_phone'] = str_replace("_" , "" , $request->phone );
        
            $driver = Driver::find($id);


            $form_validate = [
                'fname' => trans('app.fname'),
                'lname' => trans('app.lname'),
                'email' => trans('app.email'),
                'phone' => trans('app.phone'),
                'valid_phone' => trans('app.phone'),
                'state_num' => trans('app.state_num'),
                'vehicle_id' => trans('app.vehicle'),
                'city_id' => trans('app.city'),
                'license_image' => trans('app.license_image'),
                'nationality_image' => trans('app.nationality_image'),
                'state_image' => trans('app.state_image'),
                'car_isemara' => trans('app.car_isemara'),
                'bank_card' => trans('app.bank_card'),
                'account_number_image' => trans('app.account_number_image'),
            ];


            $this->validate($request , [
                'fname' => 'required',
                'lname' => 'required',
                'valid_phone' => 'required|min:10',
                'city_id' => 'required|not_in:0',
                'country_id' => 'required|not_in:0',
                'vehicle_id' => 'required|not_in:0',
                'license_image' => 'mimes:jpeg,png,jpg,gif,svg',
                'driver_image' => 'mimes:jpeg,png,jpg,gif,svg',
                'state_image' => 'mimes:jpeg,png,jpg,gif,svg',
                'car_image' => 'mimes:jpeg,png,jpg,gif,svg',
                'insurance_image' => 'mimes:jpeg,png,jpg,gif,svg',
                'car_isemara' => 'mimes:jpeg,png,jpg,gif,svg',
                'bank_card' => 'mimes:jpeg,png,jpg,gif,svg',
                'account_number_image' => 'mimes:jpeg,png,jpg,gif,svg',
            ] , [] , $form_validate);

            
            

           
            // first image 
            if ($request->hasFile('license_image')) {
                $license_image = 'license_image' . time() . '.' . $request->license_image->getClientOriginalExtension();
                $request->license_image->move(public_path('uploads') , $license_image);
                $imageUrllicense_image = 'public/uploads/' . $license_image;
                $license_image = $imageUrllicense_image;
            }else {
                $license_image = $driver->license_image;
            }
            // second
            
            if($request->hasFile('driver_image')) {
                $driver_image = 'driver_image' . time() . '.' . $request->driver_image->getClientOriginalExtension();
                $request->driver_image->move(public_path('uploads') , $driver_image);

                $imageUrldriver_image = 'public/uploads/' . $driver_image;
                $driver_image = $imageUrldriver_image;
            }else {
                $driver_image = $driver->driver_image;
            }
            // state_image
            if ($request->hasFile('state_image')) {
                $state_image =  'state_image' . time() . '.' . $request->state_image->getClientOriginalExtension();
                $request->state_image->move(public_path('uploads') , $state_image);
                $imageUrlstate_image = 'public/uploads/' . $state_image;
                $state_image = $imageUrlstate_image;
            }else {
                $state_image = $driver->state_image;
            }

            // car_image
            if($request->hasFile('car_image')) {
                $car_image =  'car_image' . time() . '.' . $request->car_image->getClientOriginalExtension();
                $request->car_image->move(public_path('uploads') , $car_image);
                $imageUrlcar_image = 'public/uploads/' . $car_image;
                $car_image = $imageUrlcar_image;
            }else {
                $car_image = $driver->car_image;
            }


            // insurance_image
            if ($request->hasFile('insurance_image')) {
                $insurance_image =  'insurance_image' . time() . '.' . $request->insurance_image->getClientOriginalExtension();
                $request->insurance_image->move(public_path('uploads') , $insurance_image);
                $imageUrlinsurance_image = 'public/uploads/' . $insurance_image;
                $insurance_image = $imageUrlinsurance_image;
            }else {
                $insurance_image = $driver->insurance_image;
            }

            // car_isemara
            if ($request->hasFile('car_isemara')) {
                $car_isemara =  'car_isemara' . time() . '.' . $request->car_isemara->getClientOriginalExtension();
                $request->car_isemara->move(public_path('uploads') , $car_isemara);
                $imageUrlcar_isemara = 'public/uploads/' . $car_isemara;
                $car_isemara = $imageUrlcar_isemara;
            }else {
                $car_isemara = $driver->car_isemara;
            }

            // bank_card
            if ($request->hasFile('bank_card')) {
                $bank_card =  'bank_card' . time() . '.' . $request->bank_card->getClientOriginalExtension();
                $request->bank_card->move(public_path('uploads') , $bank_card);
                $imageUrlbank_card = 'public/uploads/' . $bank_card;
                $bank_card = $imageUrlbank_card;
            }else {
                $bank_card = $driver->bank_card;
            }


            // account_number_image
            if ($request->hasFile('account_number_image')) {
                $account_number_image =  'account_number_image' . time() . '.' . $request->account_number_image->getClientOriginalExtension();
                $request->account_number_image->move(public_path('uploads') , $account_number_image);
                $imageUrlaccount_number_image = 'public/uploads/' . $account_number_image;
                $account_number_image = $imageUrlaccount_number_image;
            }else{
                $account_number_image = $driver->account_number_image;
            }
            
            $update = $driver->update(array(
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone' => $request->phone,
                'state_num' => $request->state_num,
                'bank_name' => $request->bank_name,
                'bank_num' => $request->bank_num,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'vehicle_id' => $request->vehicle_id,
                'person_name' => $request->person_name,
                'license_num' => $request->license_num,
                'birthdate' => $request->birthdate,
                'birthdate_hijri' => $request->birthdate_hijri,
                'type' => $request->type,
                'salary' => $request->salary,
                'state_expire_date' => $request->state_expire_date,
                'license_expire_date' => $request->license_expire_date,
                'license_type' => $request->license_type,
                'language' => $request->language,

                'license_image' => $license_image,
                'driver_image' => $driver_image,
                'state_image' => $state_image,
                'car_image' => $car_image,
                'insurance_image' => $insurance_image,
                'car_isemara' => $car_isemara,
                'bank_card' => $bank_card,
                'account_number_image' => $account_number_image,
            ));


            if ($update) {
                return redirect()->route('drivers.index')->with(['type' => 'success' , 'message' => trans('app.updatedSuccess')]);
            }else {
                return back()->with(['type' => 'danger' , 'message' => trans('app.updatedError')]);
            }

        }
    }


    /**
     * 
     * تطبيق العقوبة على السائق
     */

     public function attendance(Request $request , $id) {
        $driver = Driver::find($id);
        
        Notification::create([
            'driver_id' => $id,
            'notification_ar' => 'تم إضافة عقوبة من قبل الإدارة ',
            'notification_en' => 'Punishment added by management',
        ]);

        Attendance::create([
            'driver_id' => $id,
            'panishment_id' => $request->panishment_id,
        ]);

        return back()->with(['type' => 'success' , 'message' => trans('app.saveSuccessful')]); 

     }
    /**
     * Change Driver Status
     * Active , Pending , Block
     */

     public function status ($driver_id , $status_id){
        $driver = Driver::find($driver_id);

        if ($status_id == 1) {
            Notification::create([
                'driver_id' => $driver_id,
                'notification_ar' => 'تم تفعيل حسابك ',
                'notification_en' => 'Your Account is Active',
            ]);
        }elseif ($status_id == 2) {
            Notification::create([
                'driver_id' => $driver_id,
                'notification_ar' => 'حسابك قيد المراجعة ',
                'notification_en' => 'Your account is in review',
            ]);
        }elseif ($status_id == 3) {
            Notification::create([
                'driver_id' => $driver_id,
                'notification_ar' => 'تم حظر حسابك ',
                'notification_en' => 'Your Account is Blocked',
            ]);
        }

        $api_token = Str::random(100);

        $update = $driver->update(array(
            'active' => $status_id,
            'api_token' => $api_token 
        ));


        if ($update) {
            return back()->with(['type' => 'success' , 'message' => trans('app.saveSuccessful')]);
        }else {
            return back()->with(['type' => 'danger' , 'message' => trans('app.saveFailes')]);
        }

     }













     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @method $driver changePassword
     */
    public function changePassword($id)
    {
        $driver = Driver::find($id);
        return view('admin.drivers.changePassword' , compact('driver'));
    }

    /**
     * Change Drivers Password
     * @var $id
     * @param $request
     * @method $driver storePassword
     */

    public function storePassword(Request $request , $id) {

        $driver = Driver::find($id);

        $form_validate = ['password' => trans('app.password')];
        $this->validate($request , [
            'password'    => 'required|min:8|confirmed',
        ] , [] , $form_validate);


        $changePass = Driver::find($driver->id)->update(array(
            'password' => bcrypt($request->password)
        ));

        return redirect()->route('drivers.index')->with(['type' => 'success' , 'message' => trans('app.passwordSuccess')]);


    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
