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
abstract class CollectionBase extends \Illuminate\Database\Eloquent\Relations\HasMany{
  /*
  public function __construct(\Illuminate\Database\Eloquent\Builder $query, \Illuminate\Database\Eloquent\Model $parent, $foreignKey, $localKey) {
    
  }*/
  
  
  public function __construct(\Illuminate\Database\Eloquent\Relations\HasMany $many) {
    parent::__construct(
      $many->getQuery(),
      $many->getParent(), 
      $many->getForeignKeyName(), 
      $many->localKey);
    
  }


  //put your code here
}
