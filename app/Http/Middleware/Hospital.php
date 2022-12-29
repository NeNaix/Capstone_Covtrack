<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Hospital
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if( auth()->user() == null){
            return redirect()->route('login')->with('error',"You don't access to this page.");
        }
        if(auth()->user()->type == "admin"){
            return redirect()->route('home')->with('error',"Youre admin user. please Login as hospital user to access this page.");
        }
        if(auth()->user()->type == "brgy"){
            return redirect()->route('barangay_user')->with('error',"Youre Barangay user. please Login as hospital user to access this page.");
        }
        if(auth()->user()->type == "hospital"){
            return $next($request);
        }
        return redirect()->route('login')->with('error',"You don't access to this page.");
    }
}
