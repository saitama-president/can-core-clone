<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

/**
 * キャラクターの名寄せテーブル
 */
class master_character extends Model 
implements \App\Common\CreateTable
{
    public $table="character";
    //

    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('name',50);
        
        $b->timestamps();
    }
    
    /**
     * 同一キャラクターのカード一覧
     * @return type
     */
    public function master_cards(){
        
        return $this->hasMany("App\CCC\data\master_card","character_id");
    }

}
