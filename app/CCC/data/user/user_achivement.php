<?php

namespace App\CCC\data\user;

use Illuminate\Database\Eloquent\Model;

/**
 * 現在受けているミッション
 */
class user_achivement extends Model implements \App\Common\CreateTable {

    public $table="user_achivement";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('user_id');
        $b->integer('achivement_id');        
        $b->unique(["user_id","achivement_id"],"user_uniq_achivement");
        $b->timestamps();
    }
    
    public function user(){
        return $this->belongsTo('App\CCC\data\user');
    }
    public function master(){
        return $this->belongsTo('App\CCC\data\master_item_achivement');
    }

}
