<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_card_image_type extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    
    public $table = "master_card_image_type";
    const TYPE_STAND=1;//
    const TYPE_STAND_KI=2;
    const TYPE_STAND_DO=3;
    const TYPE_STAND_AI=4;
    const TYPE_STAND_RAKU=5;
    
    const TYPE_DAMAGE_SMALL=11;
    const TYPE_DAMAGE_MIDDLE=12;
    const TYPE_DAMAGE_LARGE=13;//大破（必要？）
    
    const TYPE_CUTIN_SMALL=21;//カットイン
    const TYPE_CUTIN_MIDDLE=22;//大破（必要？）
    const TYPE_CUTIN_LARGE=23;//大破（必要？）

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->tinyInteger("id");
        $b->string('name',20);
        $b->text('description')->default('');
        $b->unique(["id"],"uniq_master_card_image_type");
    }

    /**
     * ノーマル
     * 小破
     * 中破
     * カットイン
     * 
     * 喜怒哀楽
     */
    public static function InitTable() {
        
        master_card_image_type::insert([
            ["id"=>self::TYPE_STAND,"name"=>"立ち絵","description"=>"ホーム画面でしゃべります"],
        ]);
    }

    public static function RegistMasterRow(array $data = array()) {
        
    }

}
