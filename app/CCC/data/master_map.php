<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_map extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_map";

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('name',50);
        $b->string('key',20);
        $b->integer('level')->default(1);        
        $b->timestamps();
    }

    public static function InitTable() {
        
        
    }
    

    

}
