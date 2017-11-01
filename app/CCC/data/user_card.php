<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user_card extends Model implements \App\Common\CreateTable {

    public $table = "user_card";
    public $fillable = [
        "user_id",
        "master_card_id"  ,
    ];
    
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
        
    }
    

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("user_id");
        $b->integer("master_card_id");
        $b->timestamps();
        $b->string("uniq_name")->default('名前');
        $b->index(["user_id"], "idx_user_card");
    }
    
    

    public function user() {
        return $this->belongsTo('App\CCC\data\user');
    }

    public function master() {
        return $this->hasOne(
            "App\CCC\data\master_card",
            "id",
            "master_card_id")->first();
    }
    
    public function status(){
        return $this->hasOne("App\CCC\data\user_card_status","card_id","id");  
    }
    public function tension(){
        return $this->hasOne("App\CCC\data\user_card_tension","card_id","id");  
    }
    
    public function getChargeAttribute(){
        return $this->status()->first();
    }
    public function getTensionAttribute(){
        return $this->tension()->first();
    }
    
    
    public function master_item() {
        return $this->hasOne(
            "App\CCC\data\master_card",
            "id",
            "master_card_id")->first()->master()->first();
    }
    
    
    public static function add(user $user,$master_card_id){
      \Log::debug("カードadd呼ばれた");
      $card=new user_card([
          "user_id"=>$user->id,
          "master_card_id"=>$master_card_id
      ]);
      $card->save();
      
      $charge=new user_card_status([
        "user_id"=>$user->id,
        "card_id"=>$card->id
      ]);
      $charge->save();
      
      $tension=new user_card_tension([
        "user_id"=>$user->id,
        "card_id"=>$card->id
      ]);
      \Log::Debug("気分２");
      $tension->save();
      

        
    }

}
