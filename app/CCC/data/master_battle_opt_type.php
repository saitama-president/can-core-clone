<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_battle_opt_type extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table="master_battle_opt_type";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('name',40);
        $b->string("description");
    }

  public static function InitTable() {
    master_battle_opt_type::insert([
        ["id"=>1,"name"=>"追撃判断","description"=>"戦闘を継続するかどうか判断します"],
        ["id"=>2,"name"=>"進軍判断","description"=>"進軍を継続するかどうか判断します"],
        
    ]);
      
  }
  
  public static function idByKey($key){
      return master_assets::where("key",$key)->first()->id;
  }

}
