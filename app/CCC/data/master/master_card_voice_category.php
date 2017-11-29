<?php

namespace App\CCC\data\master;

use Illuminate\Database\Eloquent\Model;

class master_card_voice_category extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_card_voice_category";
    
    public $fillable=[
        "id","name","code"
    ];

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->tinyInteger("id");
        $b->string('name', 20);
        $b->string('code', 4);
        $b->text('description')->default('');
        $b->unique(["id"], "uniq_master_voice_category");
        $b->unique(["code"], "code_voice_category");
        $b->timestamps();
    }

    /**
     * 部屋
     * 
     * タッチ
     * 
     */
    public static function InitTable() {
        
    }

    public static function RegistMasterRow(array $data = array()) {

        if (empty($data["略称"])) {
            return;
        }

        self::updateOrCreate(
            ["id" => $data["ID"]], [
            "name" => $data["名前"],
            "code" => $data["略称"],
            ]
        );
    }

}
