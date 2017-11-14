<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

/*
    カードの燃料：弾薬を管理します。
 *  体調も管理します
 *  */
class user_card_status extends Model implements \App\Common\CreateTable {

   public $table="user_card_status";
   public $fillable=[
       "user_id",
       "card_id",
   ];
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("user_id");
        
        $b->timestamps();
        $b->index(["user_id"],"idx_card_status");
        $b->bigInteger("card_id");
        $b->unique(["card_id"]);
        $b->integer("hp")->default(100);
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
     * 燃料を使う
     * @param type $val
     * @return boolean
     */
    public function useFuel($val=1){
        
        if($val<=$this->fuel){
            $this->fuel-=$val;
            $this->save();
            return true;
        }
        return false;
    }
    
    /**
     * 弾丸を使う
     * @param type $val
     * @return boolean
     */
    public function useAmmo($val=1){
        if($val<=$this->ammo){
            $this->ammo-=$val;
            $this->save();
            return true;
        }
        return false;        
    }
    
    /**
     * ダメージ
     * @param type $val
     */
    public function useHP($val=1){
        
        if($this->hp<=0){
            return false;
        }
        
        
        $this->hp-=$val;
        
        if($this->hp <= 0){
            //0未満になったら轟沈        
        }
        
        $this->save();            
        return true;
    }


    public function repair(){
        
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
