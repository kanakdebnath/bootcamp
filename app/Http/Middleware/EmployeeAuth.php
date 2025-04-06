<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EmployeeAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::user()->type == 'admin') {
            if(Auth::user()->admin_type == 'employee'){
                return $next($request);
            }
        }else{
            Session::flush();
            Auth::logout();
            return redirect()->route('login')->with('failed', collect(['Something Went Wrong. Please try again.']));
        }

    }
}
