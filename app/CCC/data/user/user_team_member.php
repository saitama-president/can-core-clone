<?php

namespace App\CCC\data\user;

use Illuminate\Database\Eloquent\Model;

class user_team_member extends Model implements \App\Common\CreateTable {

      public $table="user_team_member";
      public $fillable=[
          "user_id",
          "team_id",
          "position_index",
          "card_id"
      ];
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('user_id');        
        $b->integer("team_id");
        $b->integer("position_index");
        $b->timestamps();
        $b->index(["user_id"],"idx_user_team_member");        
        $b->integer("card_id")->nullable();
        $b->unique(["user_id","team_id","position_index"],
            "uniq_team_member");
        
    }

    public function card() {
        
        return $this->belongsTo('App\CCC\data\user_card');
    }
    
    

    public function user() {
        return $this->belongsTo('App\CCC\data\user');
    }

}
