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

    private $team;
    private $map;

    public function __construct(
        user\user_team $team,
        master\master_map $map) {
        $this->team = $team;
        $this->map = $map;
    }

    public function Start() {
        
        \Log::Debug("map start");

        $team = $this->team;
        $members = $team->members();
        $map = $this->map;



        /**
         * チェック開始
         */
        foreach ($members->get() as $member) {
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
    }

}
