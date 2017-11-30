<?php

namespace App\CCC\data\master;

use Illuminate\Database\Eloquent\Model;

class master_map_point_event extends Model 
implements \App\Common\CreateTable,
    \App\Common\MasterTable {

    public $table = "master_map_point_event";
    public $fillable=[
        "map_id",
        "key",
        "X","Y","Z"
    ];

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('point_id');
        $b->tinyInteger("event_type");//イベント種別。便宜的
        $b->tinyInteger("event_index");
        $b->string("name")->default('無名');
        $b->unique(["point_id","event_index"]);
        $b->timestamps();
    }    

    public static function InitTable() {
        for($i=0;$i<100;$i++){
            $letter="ABCDEFGHIJKLMNOPQRSTUVWXYZ"[$i%26];
            
            $p=new master_map_point([
               "map_id"=>1+($i / 10),
               "key"=>$letter,
               "X"=> mt_rand(-10,10),
               "Y"=> mt_rand(-10,10),
               "Z"=> mt_rand(-10,10),
                
            ]);
            $p->save();
        }
        
    }
    
    /**
     * その地点に到達すると発生するイベント
     * @return type
     */
    public function Event(){
        
        return $this->hasMany($related);
    }

    public static function RegistMasterRow(array $data = array()) {
        
    }

}
