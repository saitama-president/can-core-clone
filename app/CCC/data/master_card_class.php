<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_card_class extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_card_class";
    
    public $fillable=["id","name","weight_order"];

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('name', 50);
        $b->integer('weight_order')->default(100)->nullable(); //
        $b->timestamps();
    }

    public static function InitTable() {
        
    }

    public static function RegistMasterRow(array $data = array()) {

        if (!empty($data["id"])) {
            master_card_class::UpdateOrCreate(
                    ["id" => $data["id"]], [
                    "name" => $data["名前"],
                    "weight_order" => $data["weight_order"],
                    ]
            );            
        }
    }

}
