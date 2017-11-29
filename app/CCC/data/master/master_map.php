<?php

namespace App\CCC\data\master;

use Illuminate\Database\Eloquent\Model;

class master_map extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_map";
    public $fillable = [
        "map_type",
        "area_id",
        "name",
    ];

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('map_type');
        $b->integer('area_id');

        $b->string('name', 50);

        $b->integer('level')->default(1);
        $b->timestamps();
    }

    public static function InitTable() {
        
    }

    public static function RegistMasterRow(array $data = array()) {
        
    }
    
    public function __toString() {
        return "{$this->id}:{$this->name}";
    }

}
