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
class cards extends UserCollection{  
    public function remove($id){
      //削除
      $this->find($id)->delete();
      
      return true;
    }


}
