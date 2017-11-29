<?php

namespace App\CCC\data\master;

use Illuminate\Database\Eloquent\Model;
use App\CCC\data\master\master_card_spec_param;

/*各種個別のステータスを担う*/
class master_card_spec extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    /**
     * 基本仕様：
     * 各パラメータは初期値と最大値がある。
     * 最大レベルになると最大値になる。
     * 合成によって最大値に近づくことはあっても最大値を超越することは無い。
     * →カード個々に成長値（Max100%）を持つ
     * 
     * 成長カーブは？
     * @var type 
     */
    
    public $table = "master_card_spec";
    
    /**
>>以下は成長するステータス（別定義）
耐久	:HP
装甲:DEF
回避:AVOID
火力:FIRE
雷装:THUNDER
対空	:AIR
対潜	:MARINE
索敵	:
<<ここまで
     * 
//成長しないステータス
運	:LAK
搭載	:装備スロット
速力	:MOV
射程	:RANGE
燃料	:GUS
弾薬	:AMMO
     * 
     * @param \Illuminate\Database\Schema\Blueprint $b
     */
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('master_card_id');
        
        $b->integer('level_type');//レベルキャップ

        $b->integer('hp');        
        $b->integer('atk');
        $b->integer('matk');
        
        $b->integer('def');
        $b->integer('mdef');
        $b->integer('speed');
                        
        $b->integer('gus');
        $b->integer('ammo');
       
        $b->integer('luck');
        $b->integer('slot');
        
        $b->unique(['master_card_id'],"uniq_master_card_spec");
        $b->string('name',50);
        
        $b->timestamps();
    }

    public function params(){
        return $this->hasMany(master_card_spec_param::class,"master_card_spec_id");
    }
    
    public static function InitTable() {
        
    }
    
    

    public static function RegistMasterRow(array $data = array()) {
        
    }

}
