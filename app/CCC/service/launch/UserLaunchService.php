<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CCC\service\launch;
use App\CCC\data\user as user;
use App\CCC\data\master as master;
/**
 * Description of UserUpgradeService
 *
 * @author s-yoshihara
 */
class UserLaunchService {
    
    private $user;


    public function __construct(user\user $u) {
        $this->user=$u;
    }
    
    
    
    
    //put your code here
}
