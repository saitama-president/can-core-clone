<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_card_voice_type extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_card_voice_type";
    public $fillable=["id","name","description","category_id"];
    
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->tinyInteger("id");
        $b->string('name',20);
        $b->text('description')->default('');
        $b->unique(["id"],"uniq_master_voice_type");
        $b->integer("category_id");
        $b->timestamps();
    }

    /**
     * 部屋
     * 
     * タッチ
     * 
     */
    public static function InitTable() {
        /*
        master_card_voice_type::insert([
            ["id"=>self::TYPE_HOME,"name"=>"ホーム画面","description"=>"ホーム画面でしゃべります"],
        ]);
         * 
         */
    }

    public static function RegistMasterRow(array $data = array()) {
        if (empty($data["名前"])) {
            return;
        }

        self::updateOrCreate(
            ["id" => $data["ID"]], [
            "name" => $data["名前"],
            "description" => $data["説明"]?:"",
            "category_id" => $data["カテゴリID"]?:0,
            ]
        );
    }

}
