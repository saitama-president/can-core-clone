<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;
use App\CCC\data\user_create;

class user extends Model implements \App\Common\CreateTable {

  public $table = "ccc_user";

  //
  public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
    $b->increments('id');
    $b->string('name', 20);

    $b->timestamps();
  }

  public static function FromToken($token) {
    return session_token::where("token", $token)
                    ->first()
                    ->user()
                    ->first();
  }

  public function creates() {
    return new \App\CCC\data_collection\creates(
        $this,
        $this->hasMany("App\CCC\data\user_create")
        );
  }

  //資材とか
  public function assets() {
    return new \App\CCC\data_collection\assets(
        $this,
        $this->hasMany("App\CCC\data\user_asset")
        );
  }

  public function cards() {
    return new \App\CCC\data_collection\cards(
        $this,
        $this->hasMany("App\CCC\data\user_card")
        );
  }

  /*補充はカードに紐づいてる！*/
  public function charges() {
    return $this->hasMany("App\CCC\data\user_card_charge");
  }

  public function housings() {
    return $this->hasOne("App\CCC\data\user_housing");
  }

  public function launches() {
    return $this->hasMany("App\CCC\data\user_launch");
  }
  
  public function missions() {
    return $this->hasMany("App\CCC\data\user_mission");
  }
  

  public function payments() {
    return $this->hasMany("App\CCC\data\user_payment");
  }

  public function presents() {
    return $this->hasMany("App\CCC\data\user_present");
  }

  //入渠とか
  public function repaires() {
    return $this->hasMany("App\CCC\data\user_card_repair");
  }

  //編成とか
  public function teams() {
    return $this->hasMany("App\CCC\data\user_team");
  }
  
  public function equips(){
    return $this->hasMany("App\CCC\data\user_equipment");
  }

  //改造とか
  public function upgrades() {
    return $this->hasMany("App\CCC\data\user_card_upgrade");
  }

}
