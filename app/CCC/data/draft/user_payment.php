<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

/**
 * 課金石関連
 */
class user_payment extends Model implements \App\Common\CreateTable {

    public $table="user_payment";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('user_id');
        
        $b->integer('payment_type')->default(1);//1=無料 2= 有料 3=その他        
        $b->tinyInteger('item_type')->default(1);//石しかないはず
        $b->integer('item_count')->default(1);//払いだした数
        $b->integer('item_left')->default(1);//残りの数
        $b->text('descript')->default('');//備考
        
        $b->boolean('enable')->default(1);
        
        $b->timestamps();
        $b->index("user_id","idx_user_payment");
        //$b->unique(["user_id","item_type"],"uniq_user_payment");
    }
    
    public function user(){
        return $this->belongsTo('App\CCC\data\user');
    }

}
