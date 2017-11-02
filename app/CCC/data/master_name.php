<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_name extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_name";
    public $fillable = [
    ];

    //名称マスタ
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('code',20);
        $b->string('lang_code',4);
        
        
        $b->string('name');
        $b->text('descript');
        $b->timestamps();
        //キャラクタID
        
        
    }

    public static function InitTable() {
        
    }

    public static function RegistMasterRow(array $data = array()) {
    }




    public function __toString() {
        
        return "aaaa";        
    }

}
