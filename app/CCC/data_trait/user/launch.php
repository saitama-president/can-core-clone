<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CCC\data_trait\user;

/**
 * Description of launch
 *
 * @author s-yoshihara
 */
trait launch {
    //出撃とか
    public function launches() {
        return $this->hasMany("App\CCC\data\user_launch")->get();
    }
}
