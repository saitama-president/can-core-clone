<?php
namespace App\CCC\data_collection;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Description of assets
 *
 * @author shinp
 */
class assets extends CollectionBase{  

  public function imcompletes(){
    \Log::Debug("imcompletes!");
    return $this->where("taked_at",null);
  }

}
