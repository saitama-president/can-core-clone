<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

/**
 * 戦場的な
 */
class master_story extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table="master_story";
  
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('name',20);
        $b->string('key',10);
        $b->text('description')->default('');
        $b->timestamps();
    }


    public static function InitTable() {
    }

    public static function RegistMasterRow(array $data = array()) {
        
    }

}
