<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user_status extends Model implements \App\Common\CreateTable {

    public $table="user_status";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('user_id');
        
        $b->integer('max_card',20);
        $b->integer('max_card',20);
        $b->unique(["user_id","asset_id"],"uniq_user_asset");
        $b->integer('last_value')->default(100);
        $b->integer('max_value')->default(100);
        $b->timestamp('last_update')->default(\Carbon\Carbon::now());
        $b->timestamps();
    }
    
    public function user(){
        return $this->belongsTo('App\CCC\data\user');
    }

}
