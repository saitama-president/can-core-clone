<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CCC\service;

/**
 * Description of UserUpgradeService
 *
 * @author s-yoshihara
 */
class UserRepairService {
    
    private $user;


    public function __construct(\App\CCC\data\user $u) {
        $this->user=$u;
    }
    

    //put your code here
}
