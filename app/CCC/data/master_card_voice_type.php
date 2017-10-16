<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_card_voice_type extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_card_voice_type";
    
    const TYPE_HOME=1;
    const TYPE_RETURN=2;//帰ってきた
    const TYPE_LAUNCH=3;//出撃
    
    const TYPE_REPAIR=4;//修理
    const TYPE_EQUIP=5;//装備
    const TYPE_UPGRADE=6;//改修
    
    const TYPE_ATTACK=7;
    const TYPE_ATTACK_SPECIAL=8;
    const TYPE_DAMAGE_SMALL=9;
    
    const TYPE_DAMAGE_MIDDLE=10;
    const TYPE_DAMAGE_LARGE=11;
    
    const TYPE_DAMAGE_DOWN=12;//ヤラレチャッタ
    
    const TYPE_DAMAGE_WIN=13;//
    const TYPE_DAMAGE_LOSE=14;//
    
    const TYPE_DAMAGE_HAPPY=15;//
    const TYPE_DAMAGE_BAD=16;//
    
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->tinyInteger("id");
        $b->string('name',20);
        $b->text('description')->default('');
        $b->unique(["id"],"uniq_master_voice_type");
        
    }

    /**
     * 部屋
     * 
     * タッチ
     * 
     */
    public static function InitTable() {
        master_card_voice_type::insert([
            ["id"=>self::TYPE_HOME,"name"=>"ホーム画面","description"=>"ホーム画面でしゃべります"],
        ]);
    }

}
