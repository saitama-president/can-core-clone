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
class LaunchMapService {
    
    public static function Exec(
        user\user_team $team,
        master\master_map $map,
        $progress   =   1
        ){
        
        $members = $team->members()->get();
        $points=$map->map_points();
        
        foreach($points->get() as $point){
            \Log::Debug("P=".$point);
        }
        
        $continue=true;

        while($continue){
            
            
            
            $continue=false;
        }
        
        
        foreach ($members as $member) {
            \Log::Debug("CARD_ID=" . $member->card_id);
            if (!empty($member->card_id)) {
                $card = $member->card()->first();
                $status = $card->status;

                $cost = 10;

                $status->useFuel($cost);
                $status->useAmmo($cost);

                $status->useHP(mt_rand(0, 100));

                $status->save();
            }
        }
        
        
        
        \Log::Debug("出撃終了");
    }

}
