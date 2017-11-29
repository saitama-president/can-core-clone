<?php

namespace App\CCC\data\master;

use Illuminate\Database\Eloquent\Model;

class master_quest extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_quest";

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('name',50);
        
        $b->timestamps();
    }

    public static function InitTable() {
        
        
    }


    public static function RegistMasterRow(array $data = array()) {
        
    }

}
