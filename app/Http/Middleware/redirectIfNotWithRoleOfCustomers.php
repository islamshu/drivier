<?php

namespace App\Http\Middleware;

use Closure;

class redirectIfNotWithRoleOfCustomers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next , $role = 'super')
    {

        $roles = auth('customer')->user()->roles()->pluck('name');
        if (in_array('super', $roles->toArray())) {
            return $next($request);
        }

        if (!in_array(strtolower($role), $roles->toArray())) {
            return redirect(route('customer.dashboard'));
        }

        return $next($request);


        // return $next($request);
    }
}
