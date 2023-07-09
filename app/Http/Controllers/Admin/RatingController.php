<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Questionair;
use App\Models\Rating;
use App\Driver;
use Validator;
use Datatables;
class RatingController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin.auth:admin');
        $this->middleware('role:super');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        

        if ($request->ajax()) {

            $questions = Questionair::latest()->get();
            
            return datatables()->of($questions)->addColumn('id' , function($data){
                return $data->id;
            })->addColumn('question_ar', function($data){
               return $data->question_ar;
            })->addColumn('question_en', function($data){
                return $data->question_en;
            })->rawColumns(['id', 'question_en' , 'question_ar'])->make(true);
        }

        return view('admin.rating.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rating.create');
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
            'question_ar' => trans('app.question_ar'),
            'question_en' => trans('app.question_en'),
        ];


        if ($request->isMethod('post')) {
            $this->validate($request , [
                'question_ar' => 'required|string|max:255',
                'question_en' => 'required|string|max:255',
            ],[], $form_validate);


            $questionair = new Questionair;
            $questionair->question_ar = $request->question_ar;
            $questionair->question_en = $request->question_en;

            if ($questionair->save()) {
                return redirect()->route('questionair.index')->with(['type' => 'success' , 'message' => 'Saved Successfuly']);
            }else {
                return back()->with(['type' => 'danger' , 'message' => 'Error , Try again']);
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
        //
    }
}
