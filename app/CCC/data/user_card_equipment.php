<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

/**
 * 艦の装備に相当
 */
class user_card_equipment extends Model implements \App\Common\CreateTable {

  public $table="user_card_equipment";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("card_id");
        $b->integer("slot_id");/*装備箇所*/
        $b->integer("equipment_id");
        
        
        $b->timestamps();
        $b->unique(["card_id","slot_id"],"uniq_user_card_equip");
        $b->index(["card_id"],"idx_user_card_equip");
    }

    public function card() {
        return $this->belongsTo('App\CCC\data\card');
    }
    
    
    public function equipment(){
        return $this->hasOne("App\CCC\data\user_equipment","id","master_card_id")
            ->first();  
    }

}
