<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_item_stock extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table="master_item_stock";
  
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        
        $b->string('name',50);
        $b->text('description')->default('');        
        $b->timestamps();
    }


    public static function InitTable() {
        master_item::insert([
            ["name"=>"製造資材","key"=>"MK"],
            
            ["name"=>"高速修理","key"=>"IR"],
            ["name"=>"高速製造","key"=>"IC"],

            ["name"=>"魔法石","key"=>"SP"],
        ]);
    }

    public static function RegistMasterRow(array $data = array()) {
        
    }

}
