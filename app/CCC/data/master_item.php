<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_item extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table="master_item";
  
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->tinyInteger('item_type')->default(1);
        $b->string('name',20);
        $b->string('key',10);
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

}
