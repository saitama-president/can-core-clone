<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user extends Model implements \App\Common\CreateTable {

    public $table="ccc_user";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('name',20);
        $b->timestamps();
    }

    public function cards() {
        return $this->hasMany("App\CCC\data\user_card");
    }
    
    public function status(){
        
        $results=[];        
        foreach($this->assets()->get() as $asset){            
            $results[$asset->key()]=$asset->value();
        }
        \Log::Debug(var_export($results,true));
        return $results;
    }
    
    public function assets(){
        return $this->hasMany("App\CCC\data\user_asset");
    }

    public function teams() {
        return $this->hasMany("App\CCC\data\user_team");
    }

    public function repair() {

        return $this->hasMany("App\CCC\data\user_card_repair");
    }

    public function upgrade() {
        return $this->hasMany("App\CCC\data\user_card_upgrade");
    }

    public function charge() {
        return $this->hasMany("App\CCC\data\user_card_charge");
    }
    
    public function creates() {
        return $this->hasMany("App\CCC\data\user_create");
    }
    
    public function launches() {
        return $this->hasMany("App\CCC\data\user_launch");
    }
    
    public function housings(){
        return $this->hasOne("App\CCC\data\user_housing");
    }
    
    

}
