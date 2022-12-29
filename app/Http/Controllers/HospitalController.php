<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use PDF;
class HospitalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function stats()
    {
        return view('layouts.stats');
    }
    public function index()
    {
        return view('layouts.data_mapping');
    }
    public function data_hospital()
    {
        if (isset($_GET['stat'])) {
            if ($_GET['stat'] == 'update') {
                session()->flash('success', 'Hospital Facility Updated');
            }
        }
        return view('hospital_main');
    }

    public function user_hospital(Request $request)
    {
        User::create([
            'name' => $request->h_name,
            'email' => $request->h_email,
            'password' => Hash::make("admin"),
            'type' => 'hospital',
            'assigned' => $request->latest_id,
        ]);
        // $details = [
        //     'title' => 'Mail from ItSolutionStuff.com',
        //     'body' => 'This is for testing email using smtp'
        // ];
   
        // \Mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\MyTestMail($details));
        
        session()->flash('success', 'Hospital Facility and Hospital User Added');
        return redirect()->route('hospital');
    }
    public function new_hospital()
    {   
        return view('h_new');
    }
    public function update_hospital()
    {
        return view('h_update');
    }
    public function covid_main()
    {
        return view('c.covid_main');
    }
    public function brgy()
    {
        return view('layouts.brgy');
    }
    public function dwn()
    {
        // $pdf = PDF::loadView('report');
        // return dd($pdf->download('report.pdf'));
        return view('report');
    }
    public function setting_admin($id){

            $data['user'] = User::where('id',$id)->get();
        
            return view('changepass.cpass_a',$data);   
    }
    public function update_admin(Request $request,$id){

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
