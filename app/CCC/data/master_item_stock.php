<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_item_stock extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table="master_item_stock";
    public $fillable= ["id","item_id","max_stock"];
  
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        
        $b->integer('item_id');
        $b->unique(["item_id"], "uniq_master_item_stock");       
        $b->timestamps();
        /*最大所持数*/
        $b->integer('max_stock')->default(99);
        
    }


    public static function InitTable() {

    }

    public static function RegistMasterRow(array $data = array()) {
        if(empty($data["アイテムID"])){
            return;
        }
        
        self::updateOrCreate(
            ["id" => $data["ID"]], [
            "item_id"=>$data["アイテムID"],
            "max_stock"=>$data["最大所持数"],
            ]
        );        
    }

}
