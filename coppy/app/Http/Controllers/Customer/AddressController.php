<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use Datatables;
use Validator;
use Auth;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('customer.auth:customer');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            // $query = Address::query();
            // $query->whereRaw("addresses.supplier_id =" . Auth::guard('supplier')->user()->id );
            // $address = $query->select('*');

            $address = Address::where('customer_id' , Auth::guard('customer')->user()->id)->latest()->get();
            
            return datatables()->of($address)->addColumn('control' , function($data){
                $button = '<button class="btn btn-sm btn-danger mr-3 delete-address"  data-id="'. $data->id .'" >Delete</button>';
                return $button;
            })->addColumn('prefix', function($data){
                return $data->prefix;
            })->addColumn('phone', function($data){
                return $data->phone;
            })->addColumn('country', function($data){
                return $data->country;
            })->addColumn('name', function($data){
                return $data->name;
            })->addColumn('city', function($data){
                return $data->city;
            })->addColumn('address', function($data){
                return "<small>" . $data->floor . "/" . $data->apartment . " - " . $data->building . "<br>" . $data->street . " / " . $data->region . " <br> " . $data->landmark . "<br>" . $data->address . "</small>";
            })->addColumn('address_type' , function($data) {

                if ($data->address_type == 0) {
                    $address = 'Residential';
                }else {
                    $address = 'Business';
                }
                return $address;
            })->rawColumns(['control','prefix','phone', 'address' , 'name' , 'city' , 'address_type' , 'country'])->make(true);

           
        }
        return view('customer.address.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $form_validate  = [
            'name' => 'Name',
            'prefix' => 'Prefix',
            'city' => 'City',
            'phone' => 'Phone',
            'apartment' => 'Apartment',
            'floor' => 'Floor',
            'building' => 'Building',
        ];

        if ($request->isMethod('post')) {

            $this->validate($request , [
                'name' => 'required',
            ] , [] , $form_validate);
            
            $customer_id = Auth::guard('customer')->user()->id;
            $address = new Address;
            $address->customer_id = $customer_id;
            $address->prefix = $request->prefix;
            $address->phone = $request->phone;
            $address->name = $request->name;
            $address->city = $request->city;
            $address->country = $request->country;
            $address->building = $request->building;
            $address->apartment = $request->apartment;
            $address->street = $request->street;
            $address->floor = $request->floor;
            $address->landmark = $request->markland;
            $address->region = $request->region;
            $address->address = $request->address;
            $address->address_type = $request->address_type;

            if ($address->save()) {
                return back()->with(['type' => 'success' , 'message' => 'Address Added Successfully']);
            }else {
                return back()->with(['type' => 'error' , 'message' =>'Failed, Try Again']);
            }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::find($id);
        
        if ($address->forceDelete()) {
            return back()->with(['type' => 'success' , 'message' => 'Deleted Successfully']);
        }else {
            return back()->with(['type' => 'error' , 'message' =>'Failed, Try Again']);
        }
    }
}
