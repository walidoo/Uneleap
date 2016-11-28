<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Closure;

class isUserActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       if ( Auth::user()->status == Config::get('constants.User_Status_Suspend') ) {
            return redirect('/user/activate');
        }
        else if( Auth::user()->status == Config::get('constants.User_Status_Terminate') )
        {
            return redirect('/user/terminate');
        }
        return $next($request);
    }
}
