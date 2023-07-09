<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Staff;
use App\Customer;
use Validator;
class RoleController extends Controller
{

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
        $roles = Staff::all();

        return view('customer.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'name' => 'required'
        ]);
        Staff::create($request->all());

        return redirect(route('customer.roles'))->with(['type' => 'success' , 'message' => 'New Role is stored successfully']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $role)
    {
        return view('customer.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Staff $role, Request $request)
    {
        $this->validate($request , [
            'name' => 'required'
        ]);

        $role->update($request->all());

        return redirect(route('customer.roles'))->with(['type' => 'success' , 'message' => 'You have updated Role successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $role)
    {
        $role->delete();

        return redirect()->back()->with(['type' => 'success' , 'message' => 'You have deleted Role successfully']);
    }
}
