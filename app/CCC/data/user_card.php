<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user_card extends Model implements \App\Common\CreateTable {

  public $table="user_card";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("user_id");
        $b->integer("master_card_id");
        $b->timestamps();
        $b->index(["user_id"],"idx_user_card");
    }

    public function user() {
        return $this->belongsTo('App\CCC\data\user');
    }
    
    public function master(){
        return $this->hasOne("App\CCC\data\master_card","id","master_card_id");  
    }

}
