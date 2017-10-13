<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    
    public function home()
    {
        return view('frame',[
            "user"=> request()->user
        ]);
    }

    
    public function home_from_session($token){
        
       $user=\App\CCC\data\user::FromToken($token);
       
       if(empty(auth()->id())){
           
           auth()->loginUsingId($user->id);
       }
        return view('frame',[
            "user"=> $user
        ]);
       
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
