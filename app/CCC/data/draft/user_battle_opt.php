<?php

namespace App\CCC\data\user;

use Illuminate\Database\Eloquent\Model;
use App\CCC\data\master\master_card;


class user_battle_opt extends Model implements \App\Common\CreateTable {

  public $table="user_battle_opt";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("user_id");
        $b->integer("opt_id");
        $b->integer("select_id");
        $b->timestamps();
        $b->index(["user_id"],"idx_user_battle_opt");
    }

    public function user() {
        return $this->belongsTo(user::class);
    }
    
    public function master(){
        return $this->hasOne(master_card::class,"id","master_card_id")
            ->first();  
    }

}
