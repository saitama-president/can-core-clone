<?php

namespace App\CCC\data\user;

use Illuminate\Database\Eloquent\Model;

/**
 * 現在受けているミッション
 */
class user_mission extends Model implements \App\Common\CreateTable {

    public $table="user_mission";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('user_id');
        $b->integer('mission_id');
        
        $b->integer('open_flg')->default(0);
        $b->integer('progress')->default(0);
        $b->integer('max_progress')->default(100);
        
        $b->unique(["user_id","mission_id"],"user_uniq_mission");
        $b->timestamps();
    }
    
    public function user(){
        return $this->belongsTo('App\CCC\data\user');
    }
    public function master(){
        return $this->belongsTo('App\CCC\data\master_mission');
    }

}
