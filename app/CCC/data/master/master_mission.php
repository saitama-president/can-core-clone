<?php

namespace App\CCC\data\master;

use Illuminate\Database\Eloquent\Model;

class master_mission extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_mission";

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('mission_type')->default(1);
        $b->string('name',50);
        $b->text('descpription')->default('');
        $b->timestamps();

        
    }

    public static function InitTable() {
        for($i=0; $i< 10; $i++){
            master_mission::insert(
                [
                    "name"=>"ミッション{$i}"
                ]                
                );
            
        }        
    }
    
    public function isOpenWithUser(user $user){
        return true;
    }
    
    public function isAcceptableWithUser(user $user){
        return true;
    }
    
    public function accept(user $user){
    }
    public static function RegistMasterRow(array $data = array()) {
        
    }

}
