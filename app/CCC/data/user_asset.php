<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user_asset extends Model implements \App\Common\CreateTable {

    
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('user_id');
        $b->integer('asset_id');
        $b->unique(["user_id","asset_id"],"uniq_user_asset");
        $b->string('name',20);
        $b->integer('last_value')->default(100);
        $b->integer('max_value')->default(100);
        $b->timestamp('last_update')->default(\Carbon\Carbon::now());
        $b->timestamps();
    }
    
    


}
