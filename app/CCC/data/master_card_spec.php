<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_card_spec extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_card_spec";
    
    /**
     * 
艦名	
艦種	
耐久	
装甲
回避
火力
雷装
対空	
対潜	
索敵	
運	
搭載	
速力	
射程	
燃料	
弾薬	
備考
     * @param \Illuminate\Database\Schema\Blueprint $b
     */
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('master_card_id');
        
        $b->unique(['master_card_id'],"uniq_master_card_spec");
        $b->string('name',50);
        
        $b->timestamps();
    }

    
    public static function InitTable() {
        
    }

}
