<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

/**
 * ユニーク管理される系のアイテム
 * 
 */
class user_inventry extends Model implements \App\Common\CreateTable {

  public $table="user_inventry";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("user_id");
        $b->integer("master_item_id");        
        
        $b->index(["user_id"],"idx_user_inventry");
        $b->timestamps();
    }

    public function user() {
        return $this->belongsTo('App\CCC\data\user');
    }
    
    public function master(){
        return $this->hasOne("App\CCC\data\master_item","id","item_id")
            ->first();
    }    
}
