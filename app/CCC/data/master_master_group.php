<?php

namespace App\CCC\data;

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
        $b->integer('code_id',20);
        $b->unique(['group_code'],'uniq_mm_code');
        $b->unique(['group_code','id'],'uniq_mm_id');
        
    }

  public static function InitTable() {
    
    master_assets::insert(
            [
                ["name"=>"燃料","key"=>"A"],
                ["name"=>"弾薬","key"=>"B"],
                ["name"=>"鉄","key"=>"C"],
                ["name"=>"金","key"=>"D"],
            ]
            );
  }
  
  public static function idByKey($key){
      return master_assets::where("key",$key)->first()->id;
  }

    public static function RegistMasterRow(array $data = array()) {
        
    }

}
