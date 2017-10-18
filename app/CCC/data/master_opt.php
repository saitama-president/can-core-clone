<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_opt extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table="master_opt";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('opt_type');
        $b->string('opt_key',20);
        $b->integer('opt_order')->default(1);
        $b->string('label',20);
        $b->string("description");
        $b->unique(['opt_type','opt_key'],'uniq_master_opt');
    }

  public static function InitTable() {
      master_opt::insert([
        ["opt_type"=>1,
            "label"=>"追撃する",
            "opt_key"=>"YES",
            "description"=>"夜戦に突入します"],
        ["opt_type"=>1,
            "label"=>"追撃しない",
            "opt_key"=>"NO",
            "description"=>"戦闘を終了します"], 

        ["opt_type"=>2,
            "label"=>"進軍する",
            "opt_key"=>"YES",
            "description"=>"攻略を継続します"],
        ["opt_type"=>2,
            "label"=>"撤退",
            "opt_key"=>"NO",
            "description"=>"攻略を終了します"], 
        
    ]);
      
  }
  
  public function type(){
      
  }

}
