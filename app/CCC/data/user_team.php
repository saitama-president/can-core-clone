<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user_team extends Model implements \App\Common\CreateTable {

      public $table="user_team";
      public $fillable=[
          "team_id",
          "name"
      ];
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');        
        $b->integer('user_id');
        $b->timestamps();
        $b->index(["user_id"],"idx_user_team");        
        $b->integer('team_id');
        $b->unique(["user_id","team_id"],"uniq_team");
        $b->string('name',50)->default('無名');
    }


    public function user() {
        return $this->belongsTo('App\CCC\data\user');
    }
    
    public function members(){
        return $this->hasMany("App\CCC\data\user_team_member","team_id");
    }
    
    public function member($index){
      return $this->members()->where("",$index)->first();
    }

}
