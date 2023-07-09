<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Staff;
use App\Customer;
class CustomerRoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('customer.auth:customer');
        $this->middleware('staff:super');
    }

    public function attach(Customer $customer, Staff $staff)
    {
        $customer->roles()->attach($staff->id);

        return redirect()->back();
    }

    public function detach(Customer $customer, Staff $staff)
    {
        $customer->roles()->detach($staff->id);

        return redirect()->back();
    }
}
