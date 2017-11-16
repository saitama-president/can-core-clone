<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

/**
 * カードの初期装備
 */
class master_card_equip extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_card_equip";
    public $fillable = [
        "id",
        "master_card_id",
        "slot_id",
        "master_equip_id",
    ];

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('master_card_id');
        $b->integer('slot_id');
        $b->integer('master_equip_id');
        $b->index("master_card_id");
        $b->unique(['master_card_id','slot_id']);
        $b->timestamps();
    }

    public function master() {

        return $this->hasOne(
                "App\CCC\data\master_item", "id", "item_id")->first();
    }

    public static function InitTable() {
        
        master_card_equip::insert([
            ["master_card_id"=>1,"slot_id"=>1,"master_equip_id"=>1],
            ["master_card_id"=>2,"slot_id"=>1,"master_equip_id"=>2],
            ["master_card_id"=>2,"slot_id"=>2,"master_equip_id"=>2],
            
            ["master_card_id"=>3,"slot_id"=>1,"master_equip_id"=>3],
            ["master_card_id"=>3,"slot_id"=>2,"master_equip_id"=>4],
            
        ]);
        
    }

    public static function RegistMasterRow(array $data = array()) {    }



}
