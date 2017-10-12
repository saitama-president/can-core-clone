<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user_launch_result extends Model implements \App\Common\CreateTable {

  public $table="user_launch_result";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("user_id");
        $b->text("result_data");
        $b->boolean("checked")->default(0);
        $b->timestamp("checked_at")->nullable();
        $b->timestamps();        
        $b->index(["user_id"],"idx_user_launch_result");
    }

    public function user() {
        return $this->belongsTo('App\CCC\data\user');
    }
    
    public function master(){
        return $this->hasOne("App\CCC\data\master_card","id","master_card_id")
            ->first();
    }

}
