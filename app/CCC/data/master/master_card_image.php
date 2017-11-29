<?php

namespace App\CCC\data\master;

use Illuminate\Database\Eloquent\Model;

class master_card_image extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_card_image";

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->timestamps();
    }

    /**
     * ノーマル
     * 小破
     * 中破
     * カットイン
     * 
     * 喜怒哀楽
     */
    public static function InitTable() {
        
    }

    public static function RegistMasterRow(array $data = array()) {
        
    }

}
