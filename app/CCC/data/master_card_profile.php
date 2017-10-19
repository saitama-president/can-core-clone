<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_card_profile extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_card_profile";

    /**
     * 通称
     * 名前フルネーム
     * カナ
     * かな
     * アルファベット
     * 
     * 年齢
     * 性別
     * 所属
     * 種族
     * 出身地
     * 
     * 身長
     * 体重
     * 
     * 趣味
     * 性格
     * 
     * 好き
     * 嫌い
     * 
     * 得意
     * 不得意
     * 
     * 
     * @param \Illuminate\Database\Schema\Blueprint $b
     */
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('master_card_id');        
        $b->unique(['master_card_id'],"uniq_master_card_profile");
        
        $b->string('name',50);
        
        $b->timestamps();
    }

    public static function InitTable() {
        
    }

    public static function RegistMasterRow(array $data = array()) {
        
    }

}
