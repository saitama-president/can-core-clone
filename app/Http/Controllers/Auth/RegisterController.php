<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Request;
use App\CCC\data\user\user;

class RegisterController extends Controller
{

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
     /**
     * ユーザが登録されたときに発火する
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user\
     * @return mixed
     */
    protected function registered(\Symfony\Component\HttpFoundation\Request 
 $request, $user)
    {
        \Log::debug("ユーザが登録された");
        $ccc_user=new user();
        
        
        
        $ccc_user->id=$user->id;
        $ccc_user->name=$user->name;        
        $ccc_user->save();
        
        
        \Event::Fire(new \App\Events\UserRegistedEvent($ccc_user));
        
  }
}
