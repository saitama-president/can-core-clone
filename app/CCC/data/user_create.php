<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user_create extends Model implements \App\Common\CreateTable {

    public $table="user_create";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('user_id');
        $b->integer('master_card_id');
        $b->timestamp('complete_at');
        $b->timestamp('taked_at')->nullable();
        
        $b->timestamps();
        $b->index(["user_id"],"idx_user_card_housing");
    }
    
    
    
    public function user()
    {
        return $this->belongsTo('App\CCC\data\user');
    }


}
