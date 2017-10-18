<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CCC\data_trait\user;

/**
 * Description of repair
 *
 * @author s-yoshihara
 */
trait repair {
    //入渠とか
    public function repaires() {
        return $this->hasMany("App\CCC\data\user_card_repair");
    }
    
    public function add_repair(){
        
        
    }
    
}
