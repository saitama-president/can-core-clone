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
    
    public function edit_commit(){
        \Log::Debug("チーム編集");
        
        $user= request()->user;
        \Log::Debug(request()->all());
        $team_id= request("team_id");
        
        $members=[
            
        ];
        
        
        
        return "OK";
    }
    
    public function edit_list(){
        $user= request()->user;
        $team_id= request("team_id");
        
        
    }

    public static function Routes() {
        Route::get("/js/team","TeamController@js_scene");
        Route::POST("/api/team/edit","TeamController@edit_commit");
        Route::get("/api/team/edit","TeamController@edit_list");
        Route::get("/play/team","TeamController@index");
    }

}
