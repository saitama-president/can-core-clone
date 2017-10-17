<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CCC\data_trait\user;

use App\CCC\data\user_card;
/**
 * Description of card
 *
 * @author s-yoshihara
 */
trait card {
        //持ってる艦娘
    public function cards() {
        return $this->hasMany("App\CCC\data\user_card");
    }
    
    
    public function add_card($master_car_id){        
        $card=new user_card;
        $card->user_id= $this->id;
        $card->master_card_id= $master_car_id;
        $card->created_at=\Carbon\Carbon::now();        
        $card->save();
    }
}
