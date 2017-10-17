<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MissionController extends Controller
{
    public $scene_name="mission";
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
    public function launch(){
        
        
        $team_id = request("team_id");
        $launch_id = request("launch_id");
        
        
        
        //出撃結果を取得する
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
}
