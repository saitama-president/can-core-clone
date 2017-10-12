<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;
/**
 * 時間単位で動作をコントロールするテーブル
 */
class game_controll extends Model implements \App\Common\CreateTable {
  
    public $table="game_controll";
    
    public static function now2key(){
        
        return \Carbon\Carbon::now()->format("YmdH");
    }

    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->timestamps();
    }

}
