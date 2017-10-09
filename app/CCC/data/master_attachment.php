<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_attachment extends Model implements \App\Common\CreateTable , \App\Common\MasterTable{

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->timestamps();
    }

  public static function InitTable() {
    
  }

}
