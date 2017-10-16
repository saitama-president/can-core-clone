<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_recipient_out extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    //レシピテーブルから出るアイテム
    public $table = "master_recipient_out";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('master_recipient_id');
        $b->integer('master_card_id');
        $b->unique(["master_recipient_id","master_card_id"],"uniq_recipient_out");
        $b->integer('rate')->default();
        
        $b->timestamps();
    }

    public static function InitTable() {
        
    }
    
    

}
