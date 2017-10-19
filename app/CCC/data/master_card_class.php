<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_card extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_card";

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('name',50);
        
        $b->timestamps();
    }

    public static function InitTable() {
        master_card::insert([
            ["name"=>"綾波"],
            ["name"=>"磯波"],
            ["name"=>"浮波"],
            ["name"=>"江波"],
            ["name"=>"大波"],
        ]);
        
        
    }
    
    public function spec(){
        return $this->hasOne("App\CCC\data\master_card_spec");        
    }
    
    public function profile(){
        return $this->hasOne("App\CCC\data\master_card_spec");        
    }
    

}
