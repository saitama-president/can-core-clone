<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_card_voice extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_card_voice";

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('master_card_id');
        $b->string('voice_type');
        $b->string('voice_resource_path');
        $b->string('voice_text');
        
        $b->boolean("enable")->default(1);
        
        $b->index(["master_card_id"],"idx_mcv_cid");
        $b->timestamps();
    }

    /**
     */
    public static function InitTable() {
        
    }

    public static function RegistMasterRow(array $data = array()) {
        
    }

}
