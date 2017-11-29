<?php

namespace App\CCC\data\user;

use Illuminate\Database\Eloquent\Model;

/*
 *  時間で回復するテンションを管理
 * 信頼度もこのテーブルで管理する。
 *  */
class user_card_tension extends Model implements \App\Common\CreateTable {

   public $table="user_card_tension";
   public $fillable=[
       "user_id",
       "card_id",
   ];
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("user_id");
        $b->biginteger("card_id");
        $b->tinyInteger("tension_type")->default(1);
        $b->unique(["user_id","card_id","tension_type"],"uniq_uct");
        
        $b->timestamps();        
        $b->integer('last_value')->default(50);
        $b->integer('max_value')->default(100);
        $b->timestamp('last_update')->default(\Carbon\Carbon::now());

    }

    public function user() {
        return $this->belongsTo('App\CCC\data\user');
    }

    /**
     * 現在の値を取得
     * →テンションは時間経過により50に値を戻そうとする仕組み。
     * つまり、valueに対して距離が時間により徐々に減ることになる。
     */
    public function value(){
        $now= \Carbon\Carbon::now();
        //$master=$this->master();
        $duration= abs($now->diffInSeconds(\Carbon\Carbon::parse($this->last_update)));
        return $this->last_value;

    }

    
}
