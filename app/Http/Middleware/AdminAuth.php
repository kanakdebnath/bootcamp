<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminAuth
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
            return $next($request);
        }else if (Auth::user()->type == 'user') {
            return redirect()->route('user.dashboard')->with('success','Login Successfully');
        }else{
            Session::flush();
            Auth::logout();
            return redirect()->route('login')->with('failed', collect(['Something Went Wrong. Please try again.']));
        }
    }
}
