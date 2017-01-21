<?php

namespace App\Http\Middleware;

use Closure;
use App\SystemSetting;
use App\ClAccess;

class AdminAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $cl_access_id = null)
    {
        if(\Session::has('user_type') 
               && (\Session::get('user_type') == \Config::get('constants.USER_ROLE_ADMIN'))
               && \Session::has('admin_accesses') 
               && (in_array($cl_access_id, \Session::get('admin_accesses')))
            )
        {
            return $next($request);
        }

        return redirect('/')->with('no_admin_access', trans('common.no_admin_access'));
    }
}
