<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
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
        if(auth()->user() == null){
             return redirect()->route('login')->with('error',"You don't have admin access.");
        }
        if(auth()->user()->type == "admin"){
            return $next($request);
        }
        if(auth()->user()->type == "brgy"){
            return redirect()->route('barangay_user')->with('error',"Youre barangay user. please Login as admin to access this page.");
        }
        if(auth()->user()->type == "hospital"){
            return redirect()->route('hospital_user')->with('error',"Youre hospital user. please Login as admin to access this page.");
        }
        
        return redirect()->route('login')->with('error',"You don't have admin access.");
    }
}
