<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Country;
use App\Models\City;
use App\Models\Vehicle;
use App\Models\Rating;
use App\Models\Questionair;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\DriverWorks;
use App\Driver;
use Validator;
use Auth;
use App\Models\Contact;
use App\Models\Career;
use LaravelLocalization;

class AppController extends Controller
{
    
    public function index() {
        return view('index');
    }

    public function terms() {
        return view('pages.terms');
    }
    
    public function business() {
        return view('pages.business');
    }

    public function contact() {
        return view('pages.contact');
    }
    

    public function storeContact(Request $request) {

        $form_validate = [
            'name' => trans('app.name'),
            'email' => trans('app.email'),
            'subject' => trans('app.subject'),
            'message' => trans('app.message'),
        ];

        if ($request->isMethod('post')) {

            $this->validate($request,[
                'name'     => 'required',
                'email'    => 'required',
                'subject'  => 'required',
                'message'  => 'required',
            ],[] , $form_validate);

            $contact = new Contact;
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->save();

            return back()->with(['type' => 'success' , 'message' => trans('app.saveContactMessage')]);

        }
    }

    public function fleet() {
        return view('pages.fleet');
    }


    public function careers() {
        return view('pages.careers');
    }

    public function storeCareer(Request $request) {

        $form_validate = [
            'name' => trans('app.name'),
            'email' => trans('app.email'),
            'subject' => trans('app.subject'),
            'message' => trans('app.message'),
        ];

        if ($request->isMethod('post')) {

            $this->validate($request,[
                'name'     => 'required',
                'email'    => 'required',
                'subject'  => 'required',
                'message'  => 'required',
            ],[] , $form_validate);

            $career = new Career;
            $career->name = $request->name;
            $career->email = $request->email;
            $career->subject = $request->subject;
            $career->message = $request->message;
            $career->save();

            return back()->with(['type' => 'success' , 'message' => trans('app.saveContactMessage')]);

        }
    }

    public function join() {
        return view('pages.join');
    }
    




    /**
     * 
     * Client Url Tracking
     */

     public function trackingURL($id,$code) {
        $order = Order::where('security_code' , $code)->find($id);

        if($order) {
            return view('tracking' , compact('order'));
        }else {
            return redirect('/');
        }
     }

    public function privacy() {
        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            return view('privicyandpolicy_ar');
        }else {
            return view('privicyandpolicy_en');
        }
    }



    public function track(Request $request) {
        $id = $request->input('id');
        $order_id = $request->input('order_id');
        if (isset($id) && isset($order_id) ) {
            $order = Order::where('order_id','=',$id)->first();
            return view('track' , compact('id','order'));
        }else {
            return view('track');
        }
    }


    public function rating($id) {
        $order = Order::find($id);
        if ($order) {
         $existing = Rating::where('order_id', $order->id)->exists();
         $questionairs = Questionair::get();
         return view('feedback' , compact('order' , 'questionairs' , 'existing'));
        }else {
            return redirect('/track');
        }
    }

    /**
     * Rating Store
     */

     public function ratingStore(Request $request , $id) {
        if ($request->isMethod('post')) {

            $order = Order::find($id);

            foreach ($request->ratings as $key => $value) {
                Rating::create([
                    'order_id' => $order->id,
                    'questionair_id' => $key ,
                    'rating' => $value,
                ]);
            }

            return back()->with(['type' => 'success' , 'message' => trans('app.saveSuccessful')]);

        }
     }


    public function signup() {

        $cities = City::get();
        $countries = Country::get();
        return view('driver_singup' , compact('cities' , 'countries'));
    }
    /**
     * Store Driver
     */
    public function signupStore(Request $request) {

        $request['valid_phone'] = str_replace("_" , "" , $request->phone );


        $form_validate = [
            'carName' => trans('app.carName'),
            'reg_number' => trans('app.reg_number'),
            'fname' => trans('app.fname'),
            'lname' => trans('app.lname'),
            'email' => trans('app.email'),
            'phone' => trans('app.phone'),
            'valid_phone' => trans('app.phone'),
            'password' => trans('app.password'),
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
            'carName' => 'required',
            'reg_number' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required|min:10|unique:drivers',
            'email' =>  'unique:drivers',
            'password' => 'required|min:6',
            'city_id' => 'required|not_in:0',
            'country_id' => 'required|not_in:0',
            'license_image' => 'mimes:jpeg,png,jpg,gif,svg',
            'driver_image' => 'mimes:jpeg,png,jpg,gif,svg',
            'state_image' => 'mimes:jpeg,png,jpg,gif,svg',
            'car_image' => 'mimes:jpeg,png,jpg,gif,svg',
            'insurance_image' => 'mimes:jpeg,png,jpg,gif,svg',
            'car_isemara' => 'mimes:jpeg,png,jpg,gif,svg',
            'bank_card' => 'mimes:jpeg,png,jpg,gif,svg',
            'account_number_image' => 'mimes:jpeg,png,jpg,gif,svg',
            'day' => 'required',
        ], [],$form_validate);

        

        if ($request->isMethod('post')) {

            $vehicle = Vehicle::updateOrCreate(['reg_number' => $request->reg_number] , [
                'car_id' => rand(1111111,999999),
                'carName' => $request->carName,
                'color' => $request->color,
                'year' => $request->year,
                'carType' => $request->carType,
                'capacity' => $request->capacity,
            ]);


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
            $driver->vehicle_id = $vehicle->id;
            $driver->person_name = $request->person_name;
            $driver->license_num = $request->license_num;
            $driver->birthdate = $request->birthdate;
            $driver->birthdate_hijri = $request->birthdate_hijri;
            $driver->state_expire_date = $request->state_expire_date;
            $driver->license_expire_date = $request->license_expire_date;
            $driver->license_type = $request->license_type;
            $driver->language = $request->language;
            $driver->api_token = Str::random(100);
            $driver->active = 0;

           
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
            }

            return back()->with(['type' => 'success' , 'message' => trans('app.saveSuccessfulDriverStore')]);

        }
    }
}
