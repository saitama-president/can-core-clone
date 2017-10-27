<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class UpgradeController extends Controller
 implements \App\Common\ControllerRoute
{
    public $scene_name="upgrade";
    use Traits\JsSceneTrait;
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

    public static function Routes() {
        Route::get("/play/upgrade","UpgradeController@index");
        Route::get("/js/upgrade","UpgradeController@js_scene");
    }

}
