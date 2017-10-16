<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_item_type extends Model 
implements \App\Common\CreateTable, \App\Common\MasterTable {

    //ただの定義用テーブル
    public $table="master_item_type";
    
    const TYPE_STOCK=1;
    const TYPE_UNIQUE=2;
    const TYPE_ACHIVE=3;


    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->tinyInteger("id");
        $b->string('name',20);
        $b->text('description')->default('');
        $b->unique(["id"],"uniq_master_item_type");
    }

    public static function InitTable() {
        master_item_type::insert([
            ["id"=>self::TYPE_STOCK,"name"=>"個数管理","description"=>"消費系のアイテムです"],
            ["id"=>self::TYPE_UNIQUE,"name"=>"ユニーク管理","description"=>"装備品などのユニーク管理系アイテムです"],
            ["id"=> self::TYPE_ACHIVE,"name"=>"アチーブメント","description"=>"実績解放系のアイテムです"],
        ]);
    }

}
