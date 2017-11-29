<?php

namespace App\CCC\data\master;

use Illuminate\Database\Eloquent\Model;

use App\CCC\data\master\master_item;
use App\CCC\data\master\master_card_spec;
use App\CCC\data\master\master_card_class;

class master_card extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_card";
    public $fillable = [
        "id",
        "item_id",
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

    public function master() {

        return $this->hasOne(master_item::class, "id", "item_id")->first();
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

    public function voices() {    
    }

    public function spec() {
        return $this->hasOne(master_card_spec::class);
    }

    public function character() {
        //return $this->hasOne("App\CCC\data\master_character", "");
    }

    public function master_class() {
        return $this->belongsTo(master_card_class::class, "class_id");
    }

    public function __toString() {
        $parent= $this->hasOne(
            master_item::class,
            "id", "item_id"
            )->first();
        
        return "[ITEM_ID:{$parent->id},NAME:{$parent->name}]";
                
    }

}
