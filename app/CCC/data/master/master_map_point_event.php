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
        $b->integer('map_id');
        $b->string('key',2);
        
        $b->float('X')->default(1);
        $b->float('Y')->default(2);
        $b->float('Z')->default(0);
        $b->unique(["map_id","key"],
            "uniq_map_point");
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
