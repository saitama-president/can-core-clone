<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

class MasterEditController extends Controller implements \App\Common\ControllerRoute {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
    }


    public static function Routes() {
        //マスタ一覧画面
        Route::get("/debug/master","DebugController@master");        
        Route::get("/debug/master_reload",function(){            
            Artisan::call("master:load");            
            return redirect("/debug/master")->with("message","取り込み完了");
        });
        
        Route::GET("master/map/add",function(){
            
            $item=new \App\CCC\data\master_map([
                "map_type"=>1,
                "area_id"=>99,
                "name"=>"未構築"                
            ]);
            $item->save();
            return redirect("/debug/master")->with("message","追加:{$item->id}");
        });
        Route::GET("master/map/edit/{id}",function($id){
            
            
            return view("debug.map_edit",["map_id"=>$id]);
        });
        

    }

}
