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
            
            $user=User::where("email","test@test.com")->first();
                
                ;
            if(!empty($user)){
                auth()->loginUsingId($user->id);
                
                return redirect("home");
            }
            
            
            $user=User::create([
                    'name' => "admin",
                    'email' => "test@test.com",
                    'password' => bcrypt("xxxxxx"),
                ]);

            auth()->loginUsingId($user->id);
            
            

            \Log::Debug("強制ユーザ作成");

            $ccc_user=new \App\CCC\data\user();



            $ccc_user->id=$user->id;
            $ccc_user->name=$user->name;        
            $ccc_user->save();
            $hash= \App\CCC\data\session_token::RegUniqueToken($user->id);
            
            //プレゼントをぶっこむ
            
            $present=new \App\CCC\data\user_present();
            /*
            $present->user_id = $user->id;
            */
            //課金もぶっこむ
            $payment=new \App\CCC\data\user_payment();
            $payment->user_id = $user->id;
            $payment->created_at = \Carbon\Carbon::now(); 
            $payment->save();
            
            
            
            \Event::Fire(new \App\Events\UserRegistedEvent($ccc_user));
            
            
        });
        
        $hash=\App\CCC\data\session_token::where("user_id",auth()->id())
            ->first()
            ->token;
        
        return redirect("/home");
    }  

}
