<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_recipient extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    //レシピのテーブル設定
    public $table = "master_recipient";

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('name',50);
        $b->integer('gacha_id');
        $b->integer('A');
        $b->integer('B');
        $b->integer('C');
        $b->integer('D');
        
        $b->timestamps();
    }

    public static function InitTable() {
        
    }
    
    

}
