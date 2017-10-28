<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Route;

class DebugController extends Controller implements \App\Common\ControllerRoute {

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    
  }

  public function status() {

    $user = request()->user;
    
    


    return view("debug.status", [
        "user" => $user
    ]);
  }
  
  public function home(){
      
    return view("debug.status", [
        "user" => $user
    ]);
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function login() {
    try {
      DB::transaction(function() {
        \Log::Debug("強制ユーザ作成");
        $debug = new \App\CCC\service\DebugService();
        $user = $debug->user_add("email", "test@test.com");
        if (!empty($user)) {
          auth()->loginUsingId($user->id);
        }
      });
      return redirect("/home");
    } catch (\Exception $e) {
      \Log::debug($e->getMessage());
    }
    

    return abort(403);
  }
  
  public function asset_full(\App\CCC\data\user $user){
    \Log::Debug("素材回復するで{$user->id}");
    
    foreach($user->assets()->get() as $asset){
      \Log::Debug("素材更新{$asset->id}");
      $asset->last_update= \Carbon\Carbon::now()->addDay(-1);
      $asset->save();
    }
    return redirect("/debug/status");
  }
  
  public function master(){
      
      
      return view("debug.master",[
          "master_character"=> \App\CCC\data\master_character::all(),
          "master_rare"=> \App\CCC\data\master_rare_type::all(),
          "voice_type"=> \App\CCC\data\master_card_voice_type::all(),
      ]);
  }

    public static function Routes() {
        Route::get("/debug/create", "CreateController@js_scene");
        Route::get("/debug/status","DebugController@status");
        Route::get("/debug/login","DebugController@login");
        
        //マスタ一覧画面
        Route::get("/debug/master","DebugController@master");
        
        Route::get("/debug/master_reload",function(){
            
            Artisan::call("master:load");
            
            return redirect("/debug/master")->with("message","取り込み完了");
        });
        
        Route::get("/debug/asset_full","DebugController@asset_full");
        
    }


}
