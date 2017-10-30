<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

/*
    カードの燃料：弾薬を管理します。
 *  体調も管理します
 *  */
class user_card_charge extends Model implements \App\Common\CreateTable {

   public $table="user_card_charge";
   public $fillable=[
       "user_id",
       "card_id",
   ];
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("user_id");
        
        $b->timestamps();
        $b->index(["user_id"],"idx_user_card_charge");
        $b->bigInteger("card_id");
        $b->unique(["card_id"],"uniq_user_card_charge");
        $b->integer("fuel")->default(100);
        $b->integer("ammo")->default(100);        
    }

    public function user() {
        return $this->belongsTo('App\CCC\data\user');
    }
    
    /**
     * 補給に必要なコストを取得
     * @return type
     */
    public function getRequireChargeCost(){
        $this->belongsTo('App\CCC\data\user_card','card_id')->first();
        
        
        return (Object)[
            "fuel"=>100,
            "ammo"=>100
        ];
    }
    
    
    
    /**
     * 補給（素材は消費できるものとする）
     */
    public function charge($ammo=true,$fuel=true){
        if($ammo)$this->ammo=100;
        if($fuel)$this->fuel=100;
        $this->save();
    }

    
}
