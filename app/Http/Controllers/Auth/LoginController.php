<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    
    public function is_login(){
      
      if(empty(auth()->id())){
        return abort(403,"require login");
      }
      
      return "OK";
    }

    //手動でemail/passをもらって認証
    public function manual_login(){
        \Log::debug("手動ログイン");
        if(!empty(auth()->id())){
          return "OK";
        }
        
        $email= request("email");
        $password= request("password");
        
        if(auth()->attempt([
            "email"=>$email,
            "password"=>$password
        ],true)){
            return "OK";
        }
        
        
        return abort(403);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
