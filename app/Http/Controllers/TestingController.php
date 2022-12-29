<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestingController extends Controller
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
    public function index()
    {
        if (isset($_GET['stat'])) {
            if ($_GET['stat'] == 'update') {
                session()->flash('success', 'Quarantine Facility Updated');
            }
            if ($_GET['stat'] == 'create') {
                session()->flash('success', 'Quarantine Facility Created');
            }
        }
        return view('t.testing_main');
    }
    public function new_testing()
    {
        return view('t.t_new');
    }

    public function update_testing()
    {
        return view('t.t_update');
    }
}
