<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_card extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_card";
    
    public $fillable=[
        "name",
        "rare",
        "class_id"        
    ];

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('name',50);
        $b->integer('rare')->default(1);
        $b->integer('class_id')->default(1);
        
        $b->timestamps();
    }

    public static function InitTable() {      
    }
    
    public function spec(){
        return $this->hasOne("App\CCC\data\master_card_spec");        
    }
    
    public function profile(){
        return $this->hasOne("App\CCC\data\master_card_spec");        
    }
    
    public function master_class(){
        return $this->belongsTo("App\CCC\data\master_card_class","class_id");
    }

    public static function RegistMasterRow(array $row = array()) {
        $card=new master_card([
            "name"=>$row["カード名"],
            "rare"=>$row["レアリティ"],
            "class_id"=>
                master_card_class::where(
                    "name",$row["クラス名"])
                ->first()
                ->id
                
            ]);
        $card->save();
    }

}
