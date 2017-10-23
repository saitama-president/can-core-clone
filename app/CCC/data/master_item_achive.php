<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

/**
 * 実績開放系（一度解放したら解放しっぱなし）
 */
class master_item_achive extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table="master_item_archive";
  
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('item_id');
        
        $b->unique(["item_id"],"uniq_master_item_archive");
        $b->text('description')->default('');        
        $b->timestamps();
    }


    public static function InitTable() {

    }

    public static function RegistMasterRow(array $data = array()) {
        
    }

}
