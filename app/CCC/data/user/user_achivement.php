<?php

namespace App\CCC\data\user;

use Illuminate\Database\Eloquent\Model;
use App\CCC\data\master as master;

/**
 * 現在受けているミッション
 */
class user_achivement extends Model implements \App\Common\CreateTable {

    public $table="user_achivement";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('user_id');
        $b->integer('achivement_id');        
        $b->unique(["user_id","achivement_id"],"user_uniq_achivement");
        $b->timestamps();
    }

    use \App\CCC\data\traits\belongsToUser;
    
    public function master(){
        return $this->belongsTo(master\master_item_achive::class);
    }

}
