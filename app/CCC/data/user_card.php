<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class user_card extends Model implements \App\Common\CreateTable {

    public $table = "user_card";
    public $fillable = [
        "user_id",
        "master_card_id",
    ];

    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("user_id");
        $b->integer("master_card_id");
        $b->timestamps();
        $b->string("uniq_name")->default('名前');
        $b->index(["user_id"], "idx_user_card");
    }

    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
    }

    


    public function getTensionAttribute() {
        return $this->tension()->first();
    }

    public function getStatusAttribute() {
        return $this->status()->first();
    }

    public function getTeamAttribute() {
        //\Log::Debug($this->team());
        return $this->team()->first();
    }
    
    public function getRepairingAttribute() {
        return $this->repair()->first();
    }
    

    public function user() {
        return $this->belongsTo('App\CCC\data\user');
    }

    public function master() {
        return $this->hasOne(
                "App\CCC\data\master_card", "id", "master_card_id")->first();
    }

    public function status() {
        return $this->hasOne("App\CCC\data\user_card_status", "card_id", "id");
    }

    public function tension() {
        return $this->hasOne("App\CCC\data\user_card_tension", "card_id", "id");
    }

    public function equips() {
        return $this->hasMany("App\CCC\data\user_card_tension", "attachment_card_id", "id");
    }

    public function team() {
        return $this->hasOne("App\CCC\data\user_team_member", "card_id", "id");
    }
    
    public function repair(){
        return $this->hasOne("App\CCC\data\user_repair","card_id","id");
    }
    
    public function isRepairing(){
        
        if(empty($this->repairing)){
            \Log::Debug("修理中ではない:{$this->id}");
            return false;
        }        
        return true;
    }
    
    

    public function master_item() {
        return $this->hasOne(
                "App\CCC\data\master_card", "id", "master_card_id")->first()->master()->first();
    }


}
