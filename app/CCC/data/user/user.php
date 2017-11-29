<?php
namespace App\CCC\data\user;

use Illuminate\Database\Eloquent\Model;

class user extends Model implements \App\Common\CreateTable {

  public $table = "ccc_user";

  //
  public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
    $b->increments('id');
    $b->string('name', 20);

    $b->timestamps();
  }
  
/*
  getter ここから
 *  */    
  public function getStatusAttribute(){
    return $this->status()->first();
  }
  
  public function status(){
    return $this->hasOne(user_status::class);
  }
  
  
  
  /**
   * getter ここまで
   * @return \App\CCC\data_collection\creates
   */


  public function creates() {
    return new \App\CCC\data_collection\creates(
        $this,
        $this->hasMany(user_create::class)
        );
  }

  //資材とか
  public function assets() {
    return new \App\CCC\data_collection\assets(
        $this,
        $this->hasMany(user_asset::class)
        );
  }

  public function cards() {
    return new \App\CCC\data_collection\cards(
        $this,
        $this->hasMany(user_card::class)
        );
  }
  
  public function card($card_id){
    return $this->hasMany(user_card::class)
        ->where("id",$card_id)
        ->first();
  }
  
  public function team($team_id){
      return $this->teams()->where("team_id",$team_id)->first();
  }
  
  public function getTeamsAttribute(){
    return $this->teams()->get();
  }
  

  /*補充はカードに紐づいてる！*/
  public function charges() {
    return $this->hasMany(user_card_charge::class);
  }

  public function housings() {
    return $this->hasOne(user_housing::class);
  }

  public function launches() {
    return $this->hasMany(user_launch::class);
  }
  
  public function missions() {
    return $this->hasMany(user_mission::class);
  }
  

  public function payments() {
    return $this->hasMany(user_payment::class);
  }

  public function presents() {
    return $this->hasMany(user_present::class);
  }

  //入渠とか
  public function repaires() {
    return new \App\CCC\data_collection\repaires(
        $this,
        $this->hasMany(user_repair::class)
        );
  }

  //編成とか
  public function teams() {
    return $this->hasMany(user_team::class);
  }
  
  public function equips(){
    return $this->hasMany(user_equipment::class);
  }

  //改造とか
  public function upgrades() {
    return $this->hasMany(user_card_upgrade::class);
  }

}
