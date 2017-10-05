<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user extends Model implements \App\Common\CreateTable {

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->timestamps();
    }

    public function cards() {
        return $this->hasMany("App\CCC\data\user_card");
    }

    public function teams() {
        return $this->hasMany("App\CCC\data\user_team");
    }

    public function repair() {

        return $this->hasOne("App\CCC\data\user_card_repair");
    }

    public function upgrade() {
        return $this->hasOne("App\CCC\data\user_card_upgrade");
    }

    public function charge() {
        return $this->hasOne("App\CCC\data\user_card_charge");
    }
    
    public function creates() {
        return $this->hasOne("App\CCC\data\user_create");
    }
    
    public function launches() {
        return $this->hasOne("App\CCC\data\user_launch");
    }
    
    public function housings(){
        return $this->hasOne("App\CCC\data\user_housing");
    }

}
