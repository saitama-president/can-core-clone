<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Common;

/**
 * Description of DataGroup
 *
 * @author s-yoshihara
 */
abstract class DataGroup{
    
    protected $collection;


    public function __construct(\Illuminate\Database\Eloquent\Collection $collection) {
        $this->collection=$collection;
    }
    
    public function add($obj){
        $this->collection->add($obj);
    }


    //public abstract function add($data);
    
    //public abstract function remove($obj);
    
}
