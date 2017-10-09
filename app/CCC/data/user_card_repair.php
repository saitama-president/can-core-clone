<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user_card_repair extends Model implements \App\Common\CreateTable {

     public $table="user_card_repair";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("user_id");
        $b->timestamps();
        $b->index(["user_id"],"idx_user_card_repair");
    }

    public function user() {
        return $this->belongsTo('App\CCC\data\user');
    }

}
