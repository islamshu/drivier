<?php

namespace App\Http\Controllers\Driver;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\DriverMatchOldPassword;
use Auth;
use App\Driver;
use Validator;
use Datatables;
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
        $this->middleware('driver.auth:driver');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $driver_id = Auth::guard('driver')->user()->id;
        
        if ($driver_id) {
            $driver = Driver::find($driver_id);
            return view('driver.auth.profile' , ['driver' => $driver]);
        }
    }


    /**
     * 
     * index Users 
     */

     public function users(Request $request) {

        
     }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'oldPassword'   => ['required' , new DriverMatchOldPassword],
            'password'      => 'required|min:6|confirmed',
        ]);

        
        Driver::find(Auth::guard('driver')->user()->id)->update(array(
            'password' => bcrypt($request->password)
        ));

        return redirect(route('driver.dashboard'))->with(['type' => 'success' ,'message' => 'Your password changed successfully']);
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
                'email' => 'required|email|max:255|unique:drivers,email,' . Auth::guard('driver')->user()->id,
            ] ,[] , $form_validate);

            $driver  = Driver::where('id' , $id)->update(array(
                'name' => $request->name,
                'email' => $request->email,
            ));

            if ($driver) {
                return back()->with(['type' => 'success' , 'message' => 'Profile Updated Successfully']);
            }else {
                return back()->with(['type' => 'error' , 'message' =>'Failed, Try Again']);
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
