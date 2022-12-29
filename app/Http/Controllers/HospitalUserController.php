<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class HospitalUserController extends Controller
{
     public function __construct()
    {
        $this->middleware('hospital');
    }

    public function index()
    {   

        return view('authsub.hospital_dash');
    }
        public function setting_h($id){

            $data['user'] = User::where('id',$id)->get();
        
            return view('changepass.h_cpass',$data);   
    }
    public function update_h(Request $request,$id){

            if($request->pass == null && $request->cpass == null) {

                User::where('id',$id)->update([
                    "name"=>$request->name,
                    "email"=>$request->email,
                ]);
                session()->flash('success', 'Details Updated');
                return redirect()->back();

            }
            elseif($request->pass == $request->cpass) {

                User::where('id',$id)->update([
                                "password"=>Hash::make($request->pass),
                                "name"=>$request->name,
                                "email"=>$request->email,
                ]);
                session()->flash('success', 'Details and New Password Updated');
                return redirect()->back();
            }
            else{
                session()->flash('miss', "New Password Don't match , Unsuccessful Account Update");
                return redirect()->back(); 
            }  
    }
}
