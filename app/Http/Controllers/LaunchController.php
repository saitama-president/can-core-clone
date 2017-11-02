<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class LaunchController extends Controller 
 implements \App\Common\ControllerRoute
{
    public $scene_name="launch";
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

    /**
     * 出撃を行う。
     * @return type
     */
    public function launch($launch_id,$team_id){
        
        \Log::debug("出撃した");
        
        
        
        //出撃結果を出力する
        //結果
        return [
            "OK"  
        ];
    }
        
    /**/
    public function result(){
        
        return view("launch/result",[            
            "user"=>request()->user
        ]);
    }
    
    

    /**
     * 状況を取得する
     */
    public function status(){
        return $this->user->launches()->toJson();
    }

    public static function Routes() {
        Route::get("/js/launch","LaunchController@js_scene");
        Route::get("/play/launch","LaunchController@index");
        
        Route::get("/api/launch/{launch_id}/{team_id}","LaunchController@launch");
        Route::get('/launch',"LaunchController@result");
    }

}
