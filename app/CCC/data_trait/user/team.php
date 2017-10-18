<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CCC\data_trait\user;

/**
 * Description of team
 *
 * @author s-yoshihara
 */
trait team {
    //編成とか
    public function teams() {
        return $this->hasMany("App\CCC\data\user_team");
    }
}
