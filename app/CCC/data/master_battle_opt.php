<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_battle_opt extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table="master_battle_opt";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('opt_type');
        $b->string('opt_key',20);        
        $b->string('label',20);
        $b->unique(['opt_type','opt_key'],'uniq_master_battle_opt');
    }

  public static function InitTable() {
    master_battle_opt::insert([
        ["id"=>1,"name"=>"追撃判断","description"=>"戦闘を継続するかどうか判断します"],
        ["id"=>2,"name"=>"進軍判断","description"=>"進軍を継続するかどうか判断します"],
        
    ]);
      
  }
  
  public function type(){
      
  }

}
