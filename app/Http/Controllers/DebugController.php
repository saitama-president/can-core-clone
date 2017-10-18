<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class DebugController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function status(){
        
        $user=request()->user;

        return view("debug.status",[
            "user"=>$user
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {      
        DB::transaction(function(){
            \Log::Debug("強制ユーザ作成");
            $debug=new \App\CCC\service\DebugService();
            
            $user=$debug->user_add("email","test@test.com");
                            
            if(!empty($user)){
                auth()->loginUsingId($user->id);
                
                return redirect("/home");
            }
            
       
        });
                
        return abort(403);
    }  

}
