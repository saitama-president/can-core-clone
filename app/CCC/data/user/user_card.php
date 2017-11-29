<?php

namespace App\CCC\data\user;

use Illuminate\Database\Eloquent\Model;

use App\CCC\data\master as master;

class user_card extends Model implements \App\Common\CreateTable {

    public $table = "user_card";
    public $fillable = [
        "user_id",
        "master_card_id",
    ];
    
    use \App\CCC\data\traits\belongsToUser;

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
    

    

    public function master() {
        return $this->hasOne(master\master_card::class, "id", "master_card_id")->first();
    }

    public function status() {
        return $this->hasOne(user_card_status::class, "card_id", "id");
    }

    public function tension() {
        return $this->hasOne(user_card_tension::class, "card_id", "id");
    }

    public function equips() {
        return $this->hasMany(user_equipment::class, "attachment_card_id", "id");
    }
    
    public function equip($slot_id){
        return $this->equips()->where("attachment_slot_id",$slot_id)->first();
    }

    public function team() {
        return $this->hasOne(user_team_member::class, "card_id", "id");
    }
    
    public function repair(){
        return $this->hasOne(user_repair::class,"card_id","id");
    }
    
    public function isRepairing(){
        
        if(empty($this->repairing)){
            \Log::Debug("修理中ではない:{$this->id}");
            return false;
        }        
        return true;
    }
    
    

    public function master_item() {
        return $this->hasOne(master\master_card::class, "id", "master_card_id")->first()->master()->first();
    }


}
