<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

use App\CCC\data\user_create;

class user extends Model implements \App\Common\CreateTable {

    public $table="ccc_user";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('name',20);
        $b->timestamps();
    }
    
    //プレゼント
    public function presents(){
        return $this->hasMany("App\CCC\data\user_present");
    }

    //持ってる艦娘
    public function cards() {
        return $this->hasMany("App\CCC\data\user_card");
    }
    
    public function status(){
        
        $results=[];        
        foreach($this->assets() as $asset){            
            $results[$asset->key()]=$asset->value();
        }
        \Log::Debug(var_export($results,true));
        
        
        return $results;
    }

    /**
     * 消費系
     * @param type $key
     * @param type $value
     * @return boolean
     */
    public function spend($key,$value=10){
        $asset=user_asset::where("user_id", $this->id)
            ->where("asset_id", master_assets::idByKey($key))
            ->first();
        
       if(empty($asset))return false;
       
       return $asset->spend($value);
    }
    
    /**
     * 追加系
     */
    public function add($key,$value){
        
    }
    
    public function add_create(
        $line_id,
        $master_card_id,
        $complete_time = 120){
        $complete= \Carbon\Carbon::now()->addSecond($complete_time);
        
        $create=new user_create();
        $create->user_id= $this->id;
        $create->line_id= $line_id;
        $create->master_card_id=$master_card_id;
        $create->complete_at=$complete;
        $create->created_at=\Carbon\Carbon::now();
        
        $create->save();
        return $create->id;
    }
    
    
    //資材とか
    public function assets(){
        return $this->hasMany("App\CCC\data\user_asset")->get();
    }

    //編成とか
    public function teams() {
        return $this->hasMany("App\CCC\data\user_team")->get();
    }

    //入渠とか
    public function repair() {

        return $this->hasMany("App\CCC\data\user_card_repair")->get();
    }
    
    //改造とか
    public function upgrade() {
        return $this->hasMany("App\CCC\data\user_card_upgrade")->get();
    }

    //補給とか
    public function charge() {
        return $this->hasMany("App\CCC\data\user_card_charge")->get();
    }
    
    //製造とか
    public function creates() {
        return $this->hasMany("App\CCC\data\user_create")->get();
    }
    
    //出撃とか
    public function launches() {
        return $this->hasMany("App\CCC\data\user_launch")->get();
    }
    
    //お部屋とか
    public function housings(){
        return $this->hasOne("App\CCC\data\user_housing")->get();
    }
    
    

}
