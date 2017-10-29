<?php

namespace App\CCC\data_collection;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\CCC\data\user_create;

/**
 * Description of assets
 *
 * @author shinp
 */
class creates extends CollectionBase {

  public function imcompletes() {
    \Log::Debug("imcompletes!");
    return $this->where("taked_at", null);
  }

  public function add(
  $user_id,
  $line_id,
  $master_card_id,
  $complete_time = 120
  ) {

    $complete = \Carbon\Carbon::now()->addSecond($complete_time);

    $user = request()->user();
    \Log::Debug("取得しようとする:{$user->id}");
    $create = user_create::firstOrCreate([
                "user_id" => $user_id,
                "line_id" => $line_id,
                "master_card_id" => $master_card_id,
                "complete_at" => $complete,
    ]);
    return $create->id;
  }
  
  

  public function add_x(
  ) {
    
  }

}
