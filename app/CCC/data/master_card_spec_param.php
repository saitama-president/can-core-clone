<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

/*各種個別のステータスを担う*/
class master_card_spec_param extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    /**
     * @var type 
     */
    
    public $table = "master_card_spec_param";
    
    /**
     * 
     * @param \Illuminate\Database\Schema\Blueprint $b
     */
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('master_card_spec_id');
        $b->integer('type_id');
        $b->integer('min_value')->default(10);
        $b->integer('max_value')->default(100);        
        $b->unique(['type_id','master_card_spec_id'],
            "uniq_mcsp"
            );
        
        $b->string('name',20);        
        $b->timestamps();
    }


    
    public static function InitTable() {
        
    }
    
    

    public static function RegistMasterRow(array $data = array()) {
        
    }

}
