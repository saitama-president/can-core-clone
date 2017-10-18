<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_assets extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table="master_assets";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('name',20);
        $b->string('key',20);
        $b->unique(['key'],'uniq_master_asset_key');
        $b->integer('cycle')->default(60);
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

}
