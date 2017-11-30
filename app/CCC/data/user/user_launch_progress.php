<?php

namespace App\CCC\data\user;

use Illuminate\Database\Eloquent\Model;
use App\CCC\data\master as master;

class user_launch_progress extends Model implements \App\Common\CreateTable {

  public $table="user_launch_progress";
  public $fillable=["launch_id"];
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("user_id");
        $b->integer("user_launch_id");
        $b->integer("progress");
        $b->timestamps();        
        $b->index(["user_id"]);
    }

    use \App\CCC\data\traits\belongsToUser;
    
    public function master(){
        return $this->hasOne(master\master_launch::class,"id","launch_id")
            ->first();
    }

}
