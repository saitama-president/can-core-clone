<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_card_profile extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_card_profile";

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('master_card_id');        
        $b->unique(['master_card_id'],"uniq_master_card_profile");
        
        $b->string('name',50);
        
        $b->timestamps();
    }

    public static function InitTable() {
        
    }

}
