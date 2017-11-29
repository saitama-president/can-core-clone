<?php

namespace App\CCC\data\user;

use Illuminate\Database\Eloquent\Model;

class session extends Model implements \App\Common\CreateTable{

    public $table="battle_session";
    
    public $A;
    public $B;
    
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('name',20);
        $b->timestamps();
    }
    
    public static function createSession(user $a, user $b){

        
    }
    
    public function Start(){
        
        //sessionResultを返却する
    }
    
    
    
    public function A(){
        return $this->hasMany("App\CCC\data\user_present");
    }
    

    

}
