<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user_present
extends Model implements \App\Common\CreateTable {

    public $table="user_present";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('user_id');
        $b->integer('asset_id');        
        $b->integer('last_value')->default(100);
        $b->integer('max_value')->default(100);
        $b->timestamp('last_update')->default(\Carbon\Carbon::now());
        $b->timestamps();
    }
    

    public function master(){
        return $this->hasOne("App\CCC\data\master_assets","id","asset_id")
            ->first();
    }


}
