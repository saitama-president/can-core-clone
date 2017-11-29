<?php

namespace App\CCC\data\user;

use Illuminate\Database\Eloquent\Model;
use App\CCC\data\master as master;

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


    use \App\CCC\data\traits\belongsToUser;
    
    public function members(){
        return $this->hasMany(user_team_member::class,"team_id");
    }
    
    public function member($index){
      return $this->members()->where("position_index",$index)->first();
    }

}
