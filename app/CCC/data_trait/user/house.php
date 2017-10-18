<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CCC\data_trait\user;

/**
 * Description of house
 *
 * @author s-yoshihara
 */
trait house {
     //お部屋とか
    public function housings(){
        return $this->hasOne("App\CCC\data\user_housing");
    }
}
