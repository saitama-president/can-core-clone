<?php

namespace App\CCC\data\master;

use Illuminate\Database\Eloquent\Model;

/**
 * ショップマスタ
 * ゲーム内コインもしくは課金コインで購入できるアイテムのリスト
 * 
 */
class master_shop extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table="master_shop";
  
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        
        $b->integer('item_id');
        $b->string('name',20);
        $b->string('key',10);
        $b->text('description')->default('');
        $b->timestamps();
    }


    public static function InitTable() {
    }

    public static function RegistMasterRow(array $data = array()) {
        
    }

}
