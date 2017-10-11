<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user_status extends Model implements \App\Common\CreateTable {

    public $table="user_statuses";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('user_id');
        //$b->primary("user_id");
        $b->unique(['user_id'],"uniq_user_status");
        $b->integer('max_card')->default(20);
        $b->timestamps();
    }
    
    public function user(){
        return $this->belongsTo('App\CCC\data\user');
    }

}
