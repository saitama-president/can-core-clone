<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

/**
 * 装備クラス定義
 */
class master_equipment_type extends Model implements \App\Common\CreateTable , \App\Common\MasterTable{

  public $table="master_equipment_type";
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
