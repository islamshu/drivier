<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Admin;
use App\Role;
use App\Models\City;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
// use App\Http\Requests\AdminRequest;
use App\Notifications\RegistrationNotification;
use Illuminate\Auth\Events\Registered;

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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo;


    public function redirectTo()
    {
        return $this->redirectTo = route('admin.show');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
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
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Admin
     */
    protected function create(array $data)
    {
        $admin =  Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'city_id' => $data['city_id'],
            'password' => bcrypt($data['password']),
        ]);
        

        $admin->roles()->sync(request('role_id'));

        return $admin;
        
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return Admin
     */
    // protected function create(array $data)
    // {
    //     $admin = new Admin();

    //     $fields           = $this->tableFields();
    //     $data['password'] = bcrypt($data['password']);
    //     foreach ($fields as $field) {
    //         if (isset($data[$field])) {
    //             $admin->$field = $data[$field];
    //         }
    //     }

    //     $admin->save();
    //     $admin->roles()->sync(request('role_id'));
    //     // $this->sendConfirmationNotification($admin, request('password'));

    //     return $admin;
    // }

    protected function sendConfirmationNotification($admin, $password)
    {
        if (config('multiauth.registration_notification_email')) {
            try {
                $admin->notify(new RegistrationNotification($password));
            } catch (\Exception $e) {
                request()->session()->flash('message', 'Email not sent properly, Please check your mail configurations');
            }
        }
    }

    protected function tableFields()
    {
        return collect(\Schema::getColumnListing('admins'));
    }

    public function edit(Admin $admin)
    {
        $roles = Role::all();

        return view('admin.auth.edit', compact('admin', 'roles'));
    }

    public function update(Admin $admin, AdminRequest $request)
    {
        $request['active'] = request('activation') ?? 0;
        unset($request['activation']);

        if ($request->activation == 'on') {
            $admin->update(array('active' => 1 ));
        }else {
            $admin->update(array('active' => 0 ));
        }

        
        $admin->update($request->except('role_id'));
        $admin->roles()->sync(request('role_id'));

        return redirect(route('admin.show'))->with(['type' => 'success' , 'message' => "{$admin->name} details are successfully updated"] );
    }

    public function destroy(Admin $admin)
    {
        $prefix = config('multiauth.prefix');
        $admin->delete();

        return redirect(route('admin.show'))->with(['type' => 'success' , 'message' => "You have deleted {$prefix} successfully"]);
    }
    

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {

        $roles = Role::get();
        $cities = City::get();
        return view('admin.auth.register' , compact('roles' , 'cities'));
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        // Admin::create($this->create([$request->all()]));

        $this->create($request->all());
        // event(new Registered($user = $this->create($request->all())));

        // dd($request);

        return redirect('/admin/show')->with(['type' => 'success' , 'message' => trans('app.adminAddedSuccess')]);
    }

}
