<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CCC\data_trait\user;

/**
 * Description of charge
 *
 * @author s-yoshihara
 */
trait charge {
    //補給とか
    public function charges() {
        return $this->hasMany("App\CCC\data\user_card_charge")->get();
    }
}
