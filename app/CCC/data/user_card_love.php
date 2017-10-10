<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;
/**
 * ケッコンカッコカリ的な
 */
class user_card_love extends Model implements \App\Common\CreateTable {

  public $table="user_card_love";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        //絆を結んだカードは信愛度が高いと能力が向上する。
        //逆は下がる
        
        $b->increments('id');
        $b->integer("user_id");
        $b->timestamps();
        $b->index(["user_id"],"idx_user_card");
    }

    public function user() {
        return $this->belongsTo('App\CCC\data\user');
    }

}
