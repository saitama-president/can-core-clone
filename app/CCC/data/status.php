<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class status extends Model implements \App\Common\CreateTable {

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->timestamps();
    }

}
