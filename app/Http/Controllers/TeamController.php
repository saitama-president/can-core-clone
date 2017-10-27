<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class TeamController extends Controller
 implements \App\Common\ControllerRoute
{
    public $scene_name="team";
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
        Route::get("/js/team","TeamController@js_scene");
        Route::get("/play/team","TeamController@index");
    }

}
