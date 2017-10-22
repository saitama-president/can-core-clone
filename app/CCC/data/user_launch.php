<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user_launch extends Model implements \App\Common\CreateTable {

  public $table="user_launch";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("user_id");
        $b->integer("launch_id");
        $b->tinyInteger("open_flg")->default(0);
        $b->timestamps();        
        $b->index(["user_id"],"idx_user_launch");
    }

    public function user() {
        return $this->belongsTo('App\CCC\data\user');
    }
    
    public function master(){
        return $this->hasOne("App\CCC\data\master_launch","id","launch_id")
            ->first();
    }

}
