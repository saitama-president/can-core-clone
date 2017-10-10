<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaunchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
      
        return view('play',[
            "user"=> request()->user
        ]);
    }
    
    public function status(){
        $user=request()->user;
        
        return $user->status();
    }
}
