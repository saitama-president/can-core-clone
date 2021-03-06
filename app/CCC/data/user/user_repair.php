<?php

namespace App\CCC\data\user;

use Illuminate\Database\Eloquent\Model;
use App\CCC\data\master as master;

class user_repair extends Model implements \App\Common\CreateTable {

     public $table="user_repair";
     public $fillable=[
         "line_id",
         "complete_at",
         "card_id"
         
     ];
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("user_id");
        $b->integer("line_id");
        $b->unique(["user_id","line_id"]);
        $b->integer("card_id");        
        $b->timestamp("complete_at");
        $b->timestamps();
        $b->index(["user_id"]);
    }
    
    public function getLeftAttribute() {
    return
      \Carbon\Carbon::now()->diffInSeconds(
          \Carbon\Carbon::parse($this->complete_at),false);
    }
    
    public function card(){
        return $this->belongsTo(user_card::class,'card_id','id');
    }

    use \App\CCC\data\traits\belongsToUser;

}
