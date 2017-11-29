<?php

namespace App\CCC\data\game;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/**
 * 時間単位で動作をコントロールするテーブル
 */
class game_controll extends Model implements \App\Common\CreateTable {
  
    public $table="game_controll";
    
    public static function now2key(){        
        return \Carbon\Carbon::now()->format("YmdH");
    }
    
    public static function NowControll(){
        $key= self::now2key();
        //game_controll::
        
    }

    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("time_key");
        $b->integer("max_regist_user")->default(10);
        $b->integer("left_regist_user")->default(10);
        $b->timestamps();
    }

}
