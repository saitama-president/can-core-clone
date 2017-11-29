<?php

namespace App\CCC\data\user;

use Illuminate\Database\Eloquent\Model;

/**
 * 浮いてる装備品
 * 
 * 装備品→装備しているやつ
 * のマップ定義になる。
 */
class user_equipment extends Model implements \App\Common\CreateTable {

    public $table = "user_equipment";
    
    public $fillable=[
        "master_equip_id",
        "attachment_card_id",
        "attachment_slot_id"
    ];

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("user_id");
        $b->integer("master_equip_id");

        $b->integer("attachment_card_id")->nullable();
        $b->integer("attachment_slot_id")->nullable();
        $b->unique(["attachment_card_id", "attachment_slot_id"]);

        $b->timestamps();
        //$b->unique(["user_id","slot_id"],"uniq_user_card_equip");
        $b->index(["user_id"], "idx_user_equip");
    }

    public function card() {
        return $this->belongsTo(user_card::class);
    }

    public function equipment() {
        return $this->hasOne(user_equipment::class, "id", "master_card_id")
                ->first();
    }

}
