<?php

namespace App\CCC\data\master;

use Illuminate\Database\Eloquent\Model;
/**
 * マスタ定義マスタ
 * （項目名マスタ）
 */
class master_master_group extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table="master_master_group";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('group_code',4);
        $b->string('group_name',30);
        $b->string('name',20);
        $b->integer('code_id');
        $b->unique(['group_code'],'uniq_mmg_code');
        $b->unique(['group_code','id'],'uniq_mmg_id');
        $b->unique(['group_code','code_id'],'uniq_mmg_code_id');
        
    }

  public static function InitTable() {
    

  }
  

    public static function RegistMasterRow(array $data = array()) {
        
    }

}
