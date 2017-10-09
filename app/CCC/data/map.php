<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class map extends Model implements \App\Common\CreateTable {

  public $table="map";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->timestamps();
    }

}
