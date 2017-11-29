<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CCC\service;
use App\CCC\data\user\user;

/**
 * Description of UserUpgradeService
 *
 * @author s-yoshihara
 */
class UserMissionService {
    
    private $user;


    public function __construct(user $u) {
        $this->user=$u;
    }
    
    
    public function getCurrentOpenMissions(){
        
        
    }
    
    public function getTryingMission(){
    }
    
    public function getMissionCompleteHistory(){
    }
    
    public function tryMission(){
    }
    
    public function cancelMission(){
    }
    
    public function completeMission(){
    }
    
    public function takeRewordByMission(){
        
    }


    //put your code here
}
