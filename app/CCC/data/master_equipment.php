<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;


class master_equipment extends Model implements \App\Common\CreateTable , \App\Common\MasterTable{

  public $table="master_equipment";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string("name");
        
        $b->timestamps();
    }

  public static function InitTable() {
    
  }

    public static function RegistMasterRow(array $data = array()) {
        
    }

}
