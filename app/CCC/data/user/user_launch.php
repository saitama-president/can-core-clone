<?php

namespace App\CCC\data\user;

use Illuminate\Database\Eloquent\Model;
use App\CCC\data\master\master_launch;

class user_launch extends Model implements \App\Common\CreateTable {

  public $table="user_launch";
  public $fillable=["launch_id"];
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("user_id");
        $b->integer("launch_id");
        $b->tinyInteger("open_flg")->default(0);
        $b->timestamps();        
        $b->index(["user_id"],"idx_user_launch");
    }

    public function user() {
        return $this->belongsTo(user::class);
    }
    
    public function master(){
        return $this->hasOne(master_launch::class,"id","launch_id")
            ->first();
    }

}
