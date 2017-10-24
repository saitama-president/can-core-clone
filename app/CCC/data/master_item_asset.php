<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_item_asset extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_item_asset";
    
    public $fillable= ["id","item_id","cycle","max_count"];

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('item_id');

        $b->unique(["item_id"], "uniq_master_item_asset");
        $b->timestamps();

        $b->integer('cycle')->default(60);
        $b->integer('max_count')->default(99999);//カンスト
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
            "cycle"=>$data["回復時間"],           
            "max_count"=>$data["最大数"],           
            ]
        );
        
    }

}
