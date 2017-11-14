<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user_story
extends Model implements \App\Common\CreateTable {

    public $table="user_story";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('user_id');
        $b->integer('story_id');
        $b->unique(["user_id","story_id"],"uniq_user_story");
        
        $b->tinyInteger('status')->default(0);//0=見えない 1=未開放（見える） 2=解放（入れる) 3=クリア済み
        $b->timestamp('last_update')->default(\Carbon\Carbon::now());
        $b->timestamps();
    }
    

    public function master(){
        return $this->hasOne("App\CCC\data\master_story","id","story_id")
            ->first();
    }


}
