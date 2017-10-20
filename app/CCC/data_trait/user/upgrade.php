<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CCC\data_trait\user;

/**
 * Description of upgrade
 *
 * @author s-yoshihara
 */
trait upgrade {
    //改造とか
    public function upgrades() {
        return $this->hasMany("App\CCC\data\user_card_upgrade");
    }
    
    public function upgrade(){
        return new \App\CCC\service\UserUpgradeService($this);
    }
    
}
