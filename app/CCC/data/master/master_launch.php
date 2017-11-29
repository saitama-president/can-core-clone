<?php

namespace App\CCC\data\master;

use Illuminate\Database\Eloquent\Model;

/**
 * 戦場的なもの。
 */
class master_launch extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table="master_launch";
    public $fillable=[
        "launch_type",
        "level",
        "name",
        "description"
    ];
  
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('launch_type')->default(1);
        $b->integer('level')->default(1);        
        $b->string('name',40);
        $b->text('description')->default('説明');
        $b->timestamps();
    }


    public static function InitTable() {
        echo "＜＜＜master_launchでInitTable＞＞＞";
        for($i=0;$i<12;$i++){
            $launch=new master_launch([                
                "launch_type"=>($i%2),
                "level"=>(int)($i/2),
                "name"=>"テスト{$i}",
            ]);
            $launch->save();
            echo "SAVE TO {$launch->id}";
        }  
    }

    public static function RegistMasterRow(array $data = array()) {
        
    }

}
