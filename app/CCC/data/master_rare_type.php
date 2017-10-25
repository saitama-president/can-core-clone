<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_rare_type extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_rare_type";
    public $fillable = [
        "id",
        "level",
        "name",
        "code"
    ];

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("level");
        $b->unique(["level"], "uniq_master_rare_type");
        $b->string('name', 20);
        $b->string('code', 4);
        $b->unique(["code"], "code_rare_type");
        $b->timestamps();
    }

    public static function InitTable() {
        
    }



    public static function RegistMasterRow(array $row = array()) {
        
       if (empty($data["名前"])) {
            return;
        }

        self::updateOrCreate(
            ["id" => $data["ID"]], [
            "level" => $data["レア度"],
            "name" => $data["名前"],
            "code" => $data["略称"],
                
            ]
        );
    }

}
