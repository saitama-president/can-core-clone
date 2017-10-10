<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {      
        $user=\App\User::create([
            'name' => "admin",
            'email' => rand(0,999999)."@email.com",
            'password' => bcrypt("necomimi"),
        ]);
        auth()->loginUsingId($user->id);
        
        \Log::Debug("強制ユーザ作成");
        
        $ccc_user=new \App\CCC\data\user();
        
        
        
        $ccc_user->id=$user->id;
        $ccc_user->name=$user->name;        
        $ccc_user->save();
        \Event::Fire(new \App\Events\UserRegistedEvent($ccc_user));
        return redirect("/home");
    }  

}