<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CustomerAccNotActive
{

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    // protected $openRoutes = [
    //     'ar/customer/profile',
    //     'en/customer/profile',
    //     'ar/customer/company',
    //     'en/customer/company',
    // ];


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        if (Auth::guard('customer')->check()) {
            
            if (Auth::guard('customer')->user()->company->status == 1) {
                return $next($request);
            }else {
                return redirect()->route('customer.dashboard')->with(['type' => 'danger' , 'message' => trans('app.customerAccNotActive')]);
            }
        }
        return $next($request);
    }
}
