<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CCC\data_trait\user;

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
}
