<?php

namespace App\CCC\data\master;

use Illuminate\Database\Eloquent\Model;

/**
 * 対戦。マスタが必要かどうかは要相談
 */
class master_launch_pvp extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table="master_launch_pvp";
  
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('level')->default(1);
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
