<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Region;
use App\Models\Category;
use Validator;
use Datatables;
use Excel;
class CityController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin.auth:admin');
        $this->middleware('role:manage_cities');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if ($request->ajax()) {

            $cities = City::latest()->get();
            
            return datatables()->of($cities)->addColumn('id' , function($data){
                return $data->id;
            })->addColumn('name', function($data){
               return $data->name ;
            })->addColumn('action' , function($data) {
                $buttons = '<div class="dropdown custom-dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="flaticon-dot-three"></i>
                </a>
              
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <a class="dropdown-item" href="'. url(route('cities.region' , [$data->id])).'">'.trans('app.add_region').'</a>
                    <a class="dropdown-item" href="'. url(route('cities.show' , [$data->id])).'">'.trans('app.view').'</a>
                    <a class="dropdown-item" href="'. url(route('cities.edit' , [$data->id])).'">'.trans('app.edit').'</a>
                    <a class="dropdown-item" href="'. url('admin/cities/'. $data->id . '/delete').'">'.trans('app.delete').'</a>
                </div>
              </div>';
              return $buttons;
            })->rawColumns(['id', 'name' , 'action'])->make(true);
        }

        return view('admin.cities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);
        $form_validate = [
            'name' => trans('app.city'),
            'lat' => trans('app.lat'),
            'lng' => trans('app.lng'),
        ];

        if ($request->isMethod('post')) {

            $this->validate($request , [
                'name' => 'required|max:255|unique:cities',
                'lat' => 'required',
                'lng' => 'required',
            ] , [] , $form_validate);

            
            $city = new City;
            $city->name = $request->name;
            $city->lat = $request->lat;
            $city->lng = $request->lng;
            if ($city->save()) {
                return redirect(route('cities.index'))->with(['type' => 'success' , 'message' => trans('app.saveSuccessful')]);
            }else {
                return back()->with(['type' => 'danger' , 'message' => trans('app.saveFailes')]);
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
        $city = City::find($id);
        if ($city) {
            return view('admin.cities.show' , compact('city'));
        }else {
            return back()->with(['type' => 'danger' , 'message' => trans('app.saveFailes')]);
        }
    }

    /**
     * 
     * Add Region to the city 
     */

    public function addRegion($city_id) {

        $city = City::find($city_id);
        return view('admin.regions.create' , compact('city'));
    }

    /**
     * 
     * Store Region 
     * @var Request
     * @param $city_id
     */
    public function storeRegion(Request $request , $city_id) {
        $form_validate = [
            'name' => trans('app.region'),
        ];
            
        if ($request->isMethod('POST')) {

            $this->validate($request , [
                'name' => 'required|max:255|unique:regions',
            ] , [] , $form_validate);

            
            $region = new Region;
            $region->city_id = $city_id;

            $region->name = $request->name;

            if ($region->save()) {
                return redirect()->route('cities.index')->with(['type' => 'success' , 'message' => trans('app.saveSuccessful')]);
            }else {
                return back()->with(['type' => 'danger' , 'message' => trans('app.saveFailes')]);
            }
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
        $city = City::find($id);
        if ($city) {
            return view('admin.cities.edit' , compact('city'));
        }else {
            return back()->with(['type' => 'danger' , 'message' => trans('app.saveFailes')]);
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
        $form_validate = [
            'name' => trans('app.city'),
            'lat' => trans('app.lat'),
            'lng' => trans('app.lng'),
        ];

        $city = City::find($id);

        if ($request->isMethod('post')) {

            $this->validate($request , [
                'name' => 'required|max:255|unique:cities,name,' . $city->id,
                'lat'  => 'required',
                'lng'  => 'required',
            ] , [] , $form_validate);

            
            $update = $city->update(array(
                'name' => $request->name,
                'lat' => $request->lat,
                'lng' => $request->lng,
            ));
            if ($update) {
                return redirect()->route('cities.index')->with(['type' => 'success' , 'message' => trans('app.updatedSuccess')]);
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
        $city = City::find($id);
        if ($city->forceDelete()) {
            return back()->with(['type' => 'success' , 'message' => trans('app.updatedSuccess')]);
        }else {
            return back()->with(['type' => 'danger' , 'message' => trans('app.saveFailes')]);
        }
    }
}
