<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;
use App\CCC\data\master as master;

/**
 * 個数管理される系のアイテム
 */
class user_item extends Model implements \App\Common\CreateTable {

  public $table="user_item";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("user_id");
        $b->integer("item_id");
        $b->integer("item_count")->default(0);        
        $b->timestamps();
        $b->unique(["user_id","item_id"],"uniq_user_item");
        $b->index(["user_id"],"idx_user_item");
    }

    public function user() {
        return $this->belongsTo(user::class);
    }
    
    public function master(){
        return $this->hasOne(master\master_item::class,"id","item_id")
            ->first();
    }

    public function spend($value=1){
        
        if($this->item_count - $value < 0){
            
            return false;
        }
        
        $old_value= $this->item_count;
        $next_value=$this->item_count - $value;
        
        $this->item_count=$next_value;
        $this->updated= \Carbon\Carbon::now();        
        $this->save();
        
        \Log::Debug("アイテム更新{$this->id}={$old_value}->{$next_value}");
        
        return true;
    }
    
}
