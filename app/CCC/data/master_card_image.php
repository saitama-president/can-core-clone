<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_card_image extends Model implements \App\Common\CreateTable {

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->timestamps();
    }

}
