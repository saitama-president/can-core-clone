<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user_create extends Model implements \App\Common\CreateTable {

  public $table = "user_create";
  public $fillable = [
    "user_id",
    "line_id",
    "master_card_id",
    "complete_at",
  ];

  //
  public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
    $b->increments('id');
    $b->integer('user_id');
    $b->integer('line_id');
    $b->integer('master_card_id');
    $b->timestamp('complete_at');
    $b->timestamp('taked_at')->nullable();

    $b->timestamps();
    $b->index(["user_id"], "idx_user_create");
  }

  /**
   * 各種getter
   * @return type
   */
  public function getIsTakableAttribute() {
    return
      empty($this->taked_at) && $this->complete_at < \Carbon\Carbon::Now()
    ;
  }

  public function getIsTakedAttribute() {
    return !empty($this->taked_at);
  }
  

  /**
   * 残り時間を取得
   */
  public function getLeftAttribute() {
    return
      \Carbon\Carbon::now()->diffInSeconds(\Carbon\Carbon::parse($this->complete_at));
  }

  /* 完成しているものの取得 */

  public function take() {

    if (
      \Carbon\Carbon::now() < \Carbon\Carbon::parse($this->complete_at) || !empty($this->taked_at)) {
      //あかん
      return false;
    }

    $this->taked_at = \Carbon\Carbon::now();    
    $this->save();
    $user=$this->user()->first();;
    
    \Log::Debug("カード取れる？:{$user->id}");
    
    $cards=$user->cards();
    \Log::Debug("cards?". get_class($cards));
    $cards->add($this->master_card_id);


    return true;
  }

  public function shortcut() {
    
  }

  public function user() {
    return $this->belongsTo('App\CCC\data\user');
  }

}
