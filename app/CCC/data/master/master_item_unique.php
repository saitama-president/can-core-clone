<?php

namespace App\CCC\data\master;

use Illuminate\Database\Eloquent\Model;

/**
 * 装備品などの管理
 */
class master_item_unique extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table="master_item_unique";
  
    public $fillable= ["id","item_id","max_stock"];
    
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('item_id');
        $b->unique(["item_id"], "uniq_master_item_unique");       
        $b->timestamps();
        $b->integer("item_category_id");//種別
    }


    public static function InitTable() {

    }

    public static function RegistMasterRow(array $data = array()) {
        
    }

}
