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
    
    public function rename(){
      \Log::Debug("リネーム");
      $user= request()->user;
      
      $name=request("name");
      $card_id=request("card_id");
      
      $card= $user->cards()->where("id",$card_id)->first();
      
      $card->uniq_name="$name";
      $card->save();
      
      return "OK";
    }
    
    /**
     * 装備に対してカードを紐づける
     * @param type $card_id
     */
    public function equip($card_id){

        $user= request()->user;
        //取れる
        
        $equip_id=request("equip_id");
        $slot_id=request("slot_id");
        
        \Log::Debug("装備変更！[{$card_id}:{$slot_id}]→$equip_id}]");
        
        if(empty($equip_id)){
            \Log::Debug("装備を外す");
            //外すパターン
            $equip=$user->equips()
                ->where("attachment_card_id",$card_id)
                ->where("attachment_slot_id",$slot_id)
                ->first();
            $equip->attachment_card_id = null;
            $equip->attachment_slot_id = null;
        }
        else{
            //つけるパターン
            $equip=$user->equips()->where("id",$equip_id)->first();
            $equip->attachment_card_id = $card_id;
            $equip->attachment_slot_id = $slot_id;
                                    
        }
        $equip->save();
        
        return "OK";
    }
    
    public function upgrade($card_id){
        
        $card_ids=[
            request("A"),
            request("B"),
            request("C"),
            request("D"),
        ];
        
        return "OK";
    }

    public static function Routes() {
        Route::get("/play/upgrade","UpgradeController@index");
        Route::POST("/play/upgrade/rename","UpgradeController@rename");
        Route::POST("/api/upgrade/equip/{id}","UpgradeController@equip");        
        Route::POST("/api/upgrade/upgrade/{id}","UpgradeController@upgrade");
        
        Route::get("/js/upgrade","UpgradeController@js_scene");
        
    }

}
