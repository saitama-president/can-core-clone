<?php

namespace App\CCC\data\user;

use Illuminate\Database\Eloquent\Model;

class user_housing extends Model implements \App\Common\CreateTable {

    public $table="user_housing";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('user_id');
        $b->timestamps();
        $b->index(["user_id"],"idx_user_card_housing");
    }
    
    
    
    public function user()
    {
        return $this->belongsTo(user::class);
    }


}
