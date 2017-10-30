<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_card extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_card";
    public $fillable = [
        "id",
        "item_id",
        "parent_card_id",
        "character_id",
        "rare",
        "card_class_id",
        ];

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('item_id');
        $b->unique(["item_id"], "uniq_master_card");
        $b->timestamps();
        //キャラクタID
        $b->integer('character_id');
        //レアリティ
        $b->integer('rare');
        //カードクラス
        $b->integer('card_class_id');
        
    }
    
    public function itemMaster(){
        
    }

    public static function InitTable() {
        
    }
    
    

    public static function RegistMasterRow(array $data = array()) {
        if (empty($data["名前"])) {
            return;
        }

        self::updateOrCreate(
            ["id" => $data["ID"]], [
            "item_id" => $data["アイテムID"],
            "rare" => $data["レアリティID"],
            "character_id" => $data["キャラクタID"],
            "card_class_id" => 1,
            ]
        );
    }
    
    public function parent(){
        
        
    }
    public function voices(){
        
    }
    
    public function spec() {
        return $this->hasOne("App\CCC\data\master_card_spec");
    }

    public function character() {
        return $this->hasOne("App\CCC\data\master_character","");
    }

    public function master_class() {
        return $this->belongsTo("App\CCC\data\master_card_class", "class_id");
    }

}
