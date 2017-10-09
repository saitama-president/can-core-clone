<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class gacha extends Model implements \App\Common\CreateTable {
  
    public $table="gacha";

    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->timestamps();
    }

}
