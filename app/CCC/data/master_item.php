<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_item extends Model implements \App\Common\CreateTable {

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->timestamps();
    }

}
