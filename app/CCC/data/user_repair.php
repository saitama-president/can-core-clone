<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user_repair extends Model implements \App\Common\CreateTable {

     public $table="user_repair";
     public $fillable=[
         "line_id",
         "complete_datetime",
         "card_id"
         
     ];
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("user_id");
        $b->integer("line_id");
        $b->unique(["user_id","line_id"]);
        $b->integer("card_id");        
        $b->dateTime("complete_datetime");
        $b->timestamps();
        $b->index(["user_id"]);
    }
    
    public function getLeftAttribute() {
    return
      \Carbon\Carbon::now()->diffInSeconds(
          \Carbon\Carbon::parse($this->complete_datetime),false);
    }
    
    public function card(){
        return $this->belongsTo('App\CCC\data\user_card','card_id','id');
    }

    public function user() {
        return $this->belongsTo('App\CCC\data\user');
    }

}
