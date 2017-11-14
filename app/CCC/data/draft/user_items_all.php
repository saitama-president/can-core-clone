<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

/**
 * 現在受けているミッション
 */
class user_items_all extends Model implements \App\Common\CreateTable {

    public $table="user_items_all";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('user_id');
        $b->index('user_id',"idx_uia");        
        $b->integer('item_id');        
        $b->timestamps();
    }
    
    public function user(){
        return $this->belongsTo('App\CCC\data\user');
    }
    
    public function master(){
        return $this->belongsTo('App\CCC\data\master_item',"id","item_id");
    }

}
