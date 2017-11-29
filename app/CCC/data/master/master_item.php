<?php

namespace App\CCC\data\master;

use Illuminate\Database\Eloquent\Model;

class master_item extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_item";
    public $fillable = ["id", "name", "description"];
    
    
    

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->tinyInteger('item_type')->default(1);
        $b->string('name', 20);
        $b->text('description')->default('');


        $b->timestamps();
    }

    public static function InitTable() {
        
    }
    
    public static function MasterAsset(){
        return master_item::where("item_type",master_item_type::TYPE_ASSET);        
    }
    public static function MasterStock(){
        return master_item::where("item_type",master_item_type::TYPE_STOCK);        
    }
    public static function MasterAchive(){
        return master_item::where("item_type",master_item_type::TYPE_ACHIVE);        
    }
    public static function MasterUnique(){
        return master_item::where("item_type",master_item_type::TYPE_UNIQUE);        
    }
    public static function MasterCard(){
        return master_item::where("item_type",master_item_type::TYPE_CARD);        
    }
    

    public static function RegistMasterRow(array $data = array()) {

        if (empty($data["名前"])) {
            return;
        }

        self::updateOrCreate(
            ["id" => $data["ID"]], [
            "name" => $data["名前"],
            "item_type" => $data["種別ID"],
            ]
        );
    }

}
