<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Driver;
use App\Models\Order;
use App\Models\Status;
use App\Models\City;
use App\Models\Vehicle;
use Illuminate\Support\Str;
// use App\Models\Category;
use App\Models\Rating;
use Validator;
use Datatables;
use Excel;
use DB;
use Auth;
use Carbon\Carbon;

class VehiclesController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin.auth:admin');
        $this->middleware('role:vehicles');
    }

    /**
     * Display a listing of Vehicles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $city_id  = Auth::guard('admin')->user()->city_id;

            $vehicles = Vehicle::where('city_id',$city_id)->get();

            return datatables()->of($vehicles)->addColumn('id', function($data){
                return $data->car_id;
             })->addColumn('name', function($data){
               return $data->carName;
            })->addColumn('type', function($data){
                $type = '';
                if ($data->carType == 0) {
                    $type = trans('app.sedan');
                }elseif ($data->carType == 1) {
                    $type = trans('app.truck');
                }elseif ($data->carType == 2) {
                    $type = trans('app.pickup');
                }elseif ($data->carType == 3) {
                    $type = trans('app.coolcar');
                }elseif ($data->carType == 4) {
                    $type = trans('app.allcars');
                }

                return $type;
            })->addColumn('color', function($data){
                return $data->color ?? 'N/A';
            })->addColumn('reg_number' , function($data) {
                return  $data->reg_number;
            })->addColumn('capacity' , function($data) {
                return  $data->capacity ?? 'N/A';
            })->addColumn('status' , function($data) {
                if ($data->active == 0) {
                    $status = '<span class="badge badge-success">'. trans('app.active') .'</span>';
                }else {
                    $status = '<span class="badge badge-danger">'. trans('app.deactive') .'</span>';
                }

                return $status;
            })->addColumn('action' , function($data) {
                if ($data->active == 1) {
                    $buttons = '<div class="dropdown custom-dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="flaticon-dot-three"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                        <a class="dropdown-item" href="'. url(route('vehicles.active' , [$data->id])) .'">'.trans('app.active').'</a>
                                        <a class="dropdown-item" href="'. url(route('vehicles.edit' , [$data->id])) .'">'. trans('app.edit').'</a>
                                    </div>
                                </div>';
                }else {
                    $buttons = '<div class="dropdown custom-dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="flaticon-dot-three"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                        <a class="dropdown-item" href="'. url(route('vehicles.deactive' , [$data->id])) .'">'.trans('app.deactive').'</a>
                                        <a class="dropdown-item" href="'. url(route('vehicles.edit' , [$data->id])) .'">'. trans('app.edit').'</a>
                                    </div>
                                </div>';
                }
                return $buttons;
            })->rawColumns(['id', 'date' , 'type' , 'email', 'status', 'name' , 'action'])->make(true);
        }
        return view('admin.vehicles.index');
    }







    /**
     * Display a listing of Vehicles.
     *
     * @return \Illuminate\Http\Response
     */
    public function activeVeclies(Request $request)
    {
        if ($request->ajax()) {
            $city_id  = Auth::guard('admin')->user()->city_id;

            $vehicles = Vehicle::active()->where('city_id',$city_id)->get();

            return datatables()->of($vehicles)->addColumn('id', function($data){
                return $data->car_id;
             })->addColumn('name', function($data){
               return $data->carName;
            })->addColumn('type', function($data){
                $type = '';
                if ($data->carType == 0) {
                    $type = trans('app.sedan');
                }elseif ($data->carType == 1) {
                    $type = trans('app.truck');
                }elseif ($data->carType == 2) {
                    $type = trans('app.pickup');
                }elseif ($data->carType == 3) {
                    $type = trans('app.coolcar');
                }elseif ($data->carType == 4) {
                    $type = trans('app.allcars');
                }

                return $type;
            })->addColumn('color', function($data){
                return $data->color ?? 'N/A';
            })->addColumn('reg_number' , function($data) {
                return  $data->reg_number;
            })->addColumn('capacity' , function($data) {
                return  $data->capacity ?? 'N/A';
            })->addColumn('status' , function($data) {
                if ($data->active == 0) {
                    $status = '<span class="badge badge-success">'. trans('app.active') .'</span>';
                }else {
                    $status = '<span class="badge badge-danger">'. trans('app.deactive') .'</span>';
                }

                return $status;
            })->addColumn('action' , function($data) {
                if ($data->active == 1) {
                    $buttons = '<div class="dropdown custom-dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="flaticon-dot-three"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                        <a class="dropdown-item" href="'. url(route('vehicles.active' , [$data->id])) .'">'.trans('app.active').'</a>
                                        <a class="dropdown-item" href="'. url(route('vehicles.edit' , [$data->id])) .'">'. trans('app.edit').'</a>
                                    </div>
                                </div>';
                }else {
                    $buttons = '<div class="dropdown custom-dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="flaticon-dot-three"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                        <a class="dropdown-item" href="'. url(route('vehicles.deactive' , [$data->id])) .'">'.trans('app.deactive').'</a>
                                        <a class="dropdown-item" href="'. url(route('vehicles.edit' , [$data->id])) .'">'. trans('app.edit').'</a>
                                    </div>
                                </div>';
                }
                return $buttons;
            })->rawColumns(['id', 'date' , 'type' , 'email', 'status', 'name' , 'action'])->make(true);
        }
    }









    /**
     * Display a listing of Vehicles.
     *
     * @return \Illuminate\Http\Response
     */
    public function deactiveVeclies(Request $request)
    {
        if ($request->ajax()) {
            $city_id  = Auth::guard('admin')->user()->city_id;

            $vehicles = Vehicle::deactive()->where('city_id',$city_id)->get();

            return datatables()->of($vehicles)->addColumn('id', function($data){
                return $data->car_id;
             })->addColumn('name', function($data){
               return $data->carName;
            })->addColumn('type', function($data){
                $type = '';
                if ($data->carType == 0) {
                    $type = trans('app.sedan');
                }elseif ($data->carType == 1) {
                    $type = trans('app.truck');
                }elseif ($data->carType == 2) {
                    $type = trans('app.pickup');
                }elseif ($data->carType == 3) {
                    $type = trans('app.coolcar');
                }elseif ($data->carType == 4) {
                    $type = trans('app.allcars');
                }

                return $type;
            })->addColumn('color', function($data){
                return $data->color ?? 'N/A';
            })->addColumn('reg_number' , function($data) {
                return  $data->reg_number;
            })->addColumn('capacity' , function($data) {
                return  $data->capacity ?? 'N/A';
            })->addColumn('status' , function($data) {
                if ($data->active == 0) {
                    $status = '<span class="badge badge-success">'. trans('app.active') .'</span>';
                }else {
                    $status = '<span class="badge badge-danger">'. trans('app.deactive') .'</span>';
                }

                return $status;
            })->addColumn('action' , function($data) {
                if ($data->active == 1) {
                    $buttons = '<div class="dropdown custom-dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="flaticon-dot-three"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                        <a class="dropdown-item" href="'. url(route('vehicles.active' , [$data->id])) .'">'.trans('app.active').'</a>
                                        <a class="dropdown-item" href="'. url(route('vehicles.edit' , [$data->id])) .'">'. trans('app.edit').'</a>
                                    </div>
                                </div>';
                }else {
                    $buttons = '<div class="dropdown custom-dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="flaticon-dot-three"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                        <a class="dropdown-item" href="'. url(route('vehicles.deactive' , [$data->id])) .'">'.trans('app.deactive').'</a>
                                        <a class="dropdown-item" href="'. url(route('vehicles.edit' , [$data->id])) .'">'. trans('app.edit').'</a>
                                    </div>
                                </div>';
                }
                return $buttons;
            })->rawColumns(['id', 'date' , 'type' , 'email', 'status', 'name' , 'action'])->make(true);
        }
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
        $form_validate = [
            'carName' => trans('app.carName'),
            'reg_number' => trans('app.reg_number'),
        ];


        $this->validate($request , [
            'carName' => 'required',
            'reg_number' => 'required|unique:vehicles',
        ], [],$form_validate);


        if ($request->isMethod('post')) {
            $city_id  = Auth::guard('admin')->user()->city_id;

            $vehicle = new Vehicle;
            $vehicle->car_id = rand(1111111,999999);
            $vehicle->carName = $request->carName;
            $vehicle->color = $request->color;
            $vehicle->year = $request->year;
            $vehicle->carType = $request->carType;
            $vehicle->reg_number = $request->reg_number;
            $vehicle->capacity = $request->capacity;
            $vehicle->city_id = $city_id;

            if ($vehicle->save()) {
                return back()->with(['type' => 'success' , 'message' => trans('app.saveSuccessful')]);
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
    public function active($id)
    {
        $vehicle = Vehicle::find($id);

        $update = $vehicle->update(array(
            'active' => 0,
        ));

        if ($update) {
            return back()->with(['type' => 'success' , 'message' => trans('app.activeSuccess')]);
        }else {
            return back()->with(['type' => 'danger' , 'message' => trans('app.activeError')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactive($id)
    {
        $vehicle = Vehicle::find($id);

        $update = $vehicle->update(array(
            'active' => 1,
        ));

        if ($update) {
            return back()->with(['type' => 'success' , 'message' => trans('app.deactiveSuccess')]);
        }else {
            return back()->with(['type' => 'danger' , 'message' => trans('app.activeError')]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicle = Vehicle::find($id);
        return view('admin.vehicles.edit' , compact('vehicle'));
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
            $form_validate = [
                'carName' => trans('app.carName'),
                'reg_number' => trans('app.reg_number'),
            ];
    
    
            $this->validate($request , [
                'carName' => 'required',
                'reg_number' => 'required|numeric|unique:vehicles,reg_number,'.$id,
            ], [],$form_validate);
    
            
            $vehicle = Vehicle::find($id);
            
            $update = $vehicle->update(array(
                'carName' => $request->carName,
                'color' => $request->color,
                'year' => $request->year,
                'carType' => $request->carType,
                'reg_number' => $request->reg_number,
                'capacity' => $request->capacity,
            ));

            if ($vehicle->save()) {
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
