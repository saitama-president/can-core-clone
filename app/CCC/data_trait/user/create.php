<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CCC\data_trait\user;
use App\CCC\data\user_create;
/**
 * Description of create
 *
 * @author s-yoshihara
 */
trait create {
    //製造とか
    public function creates() {
        return new \App\CCC\data_collection\assets($this->hasMany("App\CCC\data\user_create"));
        //return $this->hasMany("App\CCC\data\user_create");
    }
    
    public function creates_imcomplete(){
      return $this->creates()->imcompletes();
        //where("taked_at",null);
    }
    
    
    public function add_create(
        $line_id,
        $master_card_id,
        $complete_time = 120
        ){
        $complete= \Carbon\Carbon::now()->addSecond($complete_time);
        
        $user= request()->user();
        \Log::Debug("取得しようとする:{$user->id}");
        $create=user_create::firstOrCreate([
            "user_id"=>$user->id,
            "line_id"=>$line_id,
            "master_card_id"=>$master_card_id,
            "complete_at"=>$complete,
            
        ]);
        return $create->id;
    }   
}
