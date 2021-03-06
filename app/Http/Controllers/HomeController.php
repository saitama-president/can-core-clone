<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller implements \App\Common\ControllerRoute
{
    public $scene_name="home";
    use Traits\JsSceneTrait;
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
           // "user"=> request()->user
        ]);
    }
        
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('iframe.home',[
            "user"=> request()->user
        ]);
    }
    
    public function status(){
        $user=request()->user;
        
        return $user->status();
    }

    public static function Routes() {
        Route::get("/js/home","HomeController@js_scene");
        Route::get("/play/home","HomeController@index");
        Route::get('/index',"HomeController@index");
        Route::get("/api/status","HomeController@status");
    }

}
