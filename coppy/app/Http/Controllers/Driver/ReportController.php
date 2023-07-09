<?php

namespace App\Http\Controllers\Driver;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Status;
use App\Models\Company;
use App\Models\orderLogs;
use App\Driver;
use Auth;
use Validator;
use Datatables;
use PDF;
use Excel;
use DB;
use Carbon\Carbon;
use Picqer\Barcode\BarcodeGeneratorSVG;
use LaravelLocalization;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $driver_id = Auth::guard('driver')->user()->id;

        $orders = DB::table('statuses')->whereIn('orders.status' , ['delivered' , 'to_be_returned'])
            ->join('orders', 'orders.id', '=', 'statuses.order_id')
            ->when($driver_id , function ($query , $driver_id) {
                $query->select()->from('statuses')->whereRaw('statuses.driver_id = '.$driver_id);
            })->get();

        $totalOrders = DB::table('statuses')
            ->join('orders', 'orders.id', '=', 'statuses.order_id')
            ->when($driver_id , function ($query , $driver_id) {
                $query->select()->from('statuses')->whereRaw('statuses.driver_id = '.$driver_id);
            })->count();

        $totalDeliveredOrders = DB::table('statuses')
            ->join('orders', 'orders.id', '=', 'statuses.order_id')->where('orders.status' , '=' , 'delivered')
            ->when($driver_id , function ($query , $driver_id) {
                $query->select()->from('statuses')->whereRaw('statuses.driver_id = '.$driver_id);
            })->count();
        

        $totalReturnedOrders = DB::table('statuses')
            ->join('orders', 'orders.id', '=', 'statuses.order_id')->where('orders.status' , '=' , 'to_be_returned')
            ->when($driver_id , function ($query , $driver_id) {
                $query->select()->from('statuses')->whereRaw('statuses.driver_id = '.$driver_id);
            })->count();

        return view('driver.reports.index' , compact('orders','totalOrders','totalDeliveredOrders','totalReturnedOrders'));
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
