<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ChargeController extends Controller implements \App\Common\ControllerRoute
{
    public $scene_name="charge";
    use Traits\JsSceneTrait;
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
    
    
    public static function Routes() {
        Route::get("/js/home", "ChargeController@js_scene");
        
        Route::get("/play/charge","ChargeController@index");
    }

}
