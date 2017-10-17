<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaunchResultController extends Controller
{
    public $scene_name="launch_result";
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
     * 選択を行う
     * @return type
     */
    public function select(){
        
        
        $opt_id = request("opt_id");

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
