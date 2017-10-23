<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

/**
 * 装備品などの管理
 */
class master_item_unique extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table="master_item_unique";
  
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
       
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
