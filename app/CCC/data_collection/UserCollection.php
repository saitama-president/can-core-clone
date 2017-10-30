<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CCC\data_collection;

/**
 * Description of CollectionBase
 *
 * @author shinp
 */
class UserCollection extends CollectionBase{

  protected $user;
  
  public function __construct(
      \App\CCC\data\user $user,
      \Illuminate\Database\Eloquent\Relations\HasMany $many) {
      
      parent::__construct($many);
      $this->user=$user;
    
  }


  //put your code here
}
