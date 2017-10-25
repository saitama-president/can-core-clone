<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user_create extends Model implements \App\Common\CreateTable {

    public $table="user_create";
    public $fillable=[
        "line_id",
        "master_card_id",
        "complete_at",
    ];
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('user_id');
        $b->integer('line_id');
        $b->integer('master_card_id');
        $b->timestamp('complete_at');
        $b->timestamp('taked_at')->nullable();
        
        $b->timestamps();
        $b->index(["user_id"],"idx_user_create");
    }
    
    /**
     * 残り時間を取得
     */
    public function left(){
        return -\Carbon\Carbon::now()->diffInSeconds(\Carbon\Carbon::parse($this->complete_at));
            
    }
    
    /*完成しているものの取得*/
    public function take(){
        
        if(
            \Carbon\Carbon::now()< \Carbon\Carbon::parse($this->complete_at)
            ||!empty($this->taked_at))
        {
            //あかん
            return false;
        }
        
        $this->taked_at= \Carbon\Carbon::now();
        
        //カード追加
        $this->save();
        $card=new user_card([
            "user_id"=>$this->user_id,
            "master_card_id"=> $this->master_card_id,
            "created_at"=> \Carbon\Carbon::now()
        ]);
        
        $card->save();
        
        return true;
        
    }
    
    public function user()
    {
        return $this->belongsTo('App\CCC\data\user');
    }


}
