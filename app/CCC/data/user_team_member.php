<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user_team_member extends Model implements \App\Common\CreateTable {

      public $table="user_team_member";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('user_id');        
        $b->integer("team_id");
        $b->integer("position_index");
        $b->timestamps();
        $b->index(["user_id"],"idx_user_team_member");        
        $b->integer("card_id");
        $b->unique(["user_id","team_id","card_id"],
            "uniq_team_member");
        
    }

    public function cards() {

        return $this->hasMany("App\CCC\data\user_card");
    }

    public function user() {
        return $this->belongsTo('App\CCC\data\user');
    }

}
