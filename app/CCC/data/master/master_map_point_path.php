<?php

namespace App\CCC\data\master;

use Illuminate\Database\Eloquent\Model;

class master_map_point_path extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_map_point_path";

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("map_id");
        $b->string('from_point',2);
        $b->string('to_point',2);
        $b->unique(["from_point","to_point"]);
        $b->timestamps();
    }    
    public static function InitTable() {
        for($i=0;$i<100;$i++){
            
            
        }
        
    }

    public static function RegistMasterRow(array $data = array()) {
        
    }

}
