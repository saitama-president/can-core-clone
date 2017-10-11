<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user_asset extends Model implements \App\Common\CreateTable {

    public $table="user_asset";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('user_id');
        $b->integer('asset_id');
        $b->unique(["user_id","asset_id"],"uniq_user_asset");
        $b->integer('last_value')->default(100);
        $b->integer('max_value')->default(100);
        $b->timestamp('last_update')->default(\Carbon\Carbon::now());
        $b->timestamps();
    }
    
    /**
     * 現在の値を取得
     */
    public function value(){
        $now= \Carbon\Carbon::now();
        $master=$this->master()->first();
        
        $base_value=$this->last_value;
        $max_value=$this->max_value;
        $last_update= \Carbon\Carbon::parse($this->last_update);
        $cycle=$master->cycle;
        $diff_second=$now->diffInSeconds($last_update);
        $calc_value=$base_value + ceil($diff_second/$cycle);
        
        return ($max_value<=$base_value)
        ?$base_value
        :($max_value<=$calc_value)
            ?$max_value
            :$calc_value;

    }
    
    public function key(){
        return $this->master()->first()->key;
    }
        
    public function spend($value){
        
        \Log::Debug("資源更新{$this->id}={$old_value}->{$next_value}");
        if($this->value()-$value < 0){
            return false;
        }
        
        $old_value= $this->last_value;
        $next_value=$this->value()-$value;
        
        $this->last_value=$next_value;
        $this->last_update= \Carbon\Carbon::now();
        $this->save();
        
        \Log::Debug("資源更新{$this->id}={$old_value}->{$next_value}");
        
        return true;
    }


    public function master(){
        return $this->hasOne("App\CCC\data\master_assets","id","asset_id");
    }


}
