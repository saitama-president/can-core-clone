<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

/*各種個別のステータスを担う*/
class master_card_spec_type extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    /**
     * @var type 
     */
    
    public $table = "master_card_spec_type";
    
    /**
     * 
     * @param \Illuminate\Database\Schema\Blueprint $b
     */
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('name',20);
        $b->string('key',20);
        $b->unique(["key"],"uniq_mcst");
        $b->timestamps();
    }


    
    public static function InitTable() {
        
    }
    
    

    public static function RegistMasterRow(array $data = array()) {
        
    }

}
