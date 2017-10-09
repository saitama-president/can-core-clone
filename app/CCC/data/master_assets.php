<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_assets extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table="master_assets";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('name',20);
        $b->integer('cycle')->default(60);
    }

  public static function InitTable() {
    
    master_assets::insert(
            [
                ["name"=>"燃料"],
                ["name"=>"弾薬"],
                ["name"=>"鉄"],
                ["name"=>"銅"],
            ]
            );
  }

}
