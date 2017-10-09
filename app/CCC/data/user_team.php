<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user_team extends Model implements \App\Common\CreateTable {

      public $table="user_team";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->integer('user_id');
        $b->increments('id');
        $b->timestamps();
        $b->index(["user_id"],"idx_user_team");
    }

    public function cards() {

        return $this->hasMany("App\CCC\data\user_card");
    }

    public function user() {
        return $this->belongsTo('App\CCC\data\user');
    }

}
