<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
class MultiUserLoginController extends Controller
{
    public function login(Request $request){

        $creds = $request->only(['email','password']);
        if(!$token=auth()->attempt($creds)){
            return redirect()->route('login')->with('error','Invalid credential');
        }



            switch (auth()->user()->type){
                case "admin":
                    Cookie::queue(Cookie::forever('name', auth()->user()->name));
                    Cookie::queue(Cookie::forever('email', auth()->user()->email));
                    Cookie::queue(Cookie::forever('id', auth()->user()->id));
                    Cookie::queue(Cookie::forever('type', auth()->user()->type));
                    Cookie::queue(Cookie::forever('assigned', auth()->user()->assigned));
                    return redirect()->route('stats');
                    break;
                case "brgy":
                    Cookie::queue(Cookie::forever('name', auth()->user()->name));
                    Cookie::queue(Cookie::forever('email', auth()->user()->email));
                    Cookie::queue(Cookie::forever('id', auth()->user()->id));
                    Cookie::queue(Cookie::forever('assigned', auth()->user()->assigned));
                    return redirect()->route('barangay_user');
                    break;
                case "hospital":
                    Cookie::queue(Cookie::forever('name', auth()->user()->name));
                    Cookie::queue(Cookie::forever('email', auth()->user()->email));
                    Cookie::queue(Cookie::forever('id', auth()->user()->id));
                    Cookie::queue(Cookie::forever('type', auth()->user()->type));
                    Cookie::queue(Cookie::forever('assigned', auth()->user()->assigned));
                     return redirect()->route('hospital_user');
                    break;
                default:
                return redirect()->route('login')->with('error','Invalid credential');
                    break;
            }

    }

    public function logout(){
        
            Session::flush();
            Auth::logout();
            Cookie::forget('name');
            Cookie::forget('email');
            Cookie::forget('id');
            Cookie::forget('type');
            Cookie::forget('assigned');
            return redirect()->route('login')->with('success','Successfully Logged Out.');   
    }

    
}
