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
        return $this->hasMany("App\CCC\data\user_create")->get();
    }
    
    public function add_create(
        $line_id,
        $master_card_id,
        $complete_time = 120){
        $complete= \Carbon\Carbon::now()->addSecond($complete_time);
        
        $create=new user_create();
        $create->user_id= $this->id;
        $create->line_id= $line_id;
        $create->master_card_id=$master_card_id;
        $create->complete_at=$complete;
        $create->created_at=\Carbon\Carbon::now();
        
        $create->save();
        return $create->id;
    }
}
