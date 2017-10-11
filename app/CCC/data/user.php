<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

use App\CCC\data\user_create;

class user extends Model implements \App\Common\CreateTable {

    public $table="ccc_user";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('name',20);
        
        $b->timestamps();
    }

    use \App\CCC\data_trait\user\payment;
    use \App\CCC\data_trait\user\present;
    use \App\CCC\data_trait\user\card;
    use \App\CCC\data_trait\user\create;
    use \App\CCC\data_trait\user\asset;

    

    


    //編成とか
    public function teams() {
        return $this->hasMany("App\CCC\data\user_team")->get();
    }

    //入渠とか
    public function repair() {

        return $this->hasMany("App\CCC\data\user_card_repair")->get();
    }
    
    //改造とか
    public function upgrade() {
        return $this->hasMany("App\CCC\data\user_card_upgrade")->get();
    }

    //補給とか
    public function charge() {
        return $this->hasMany("App\CCC\data\user_card_charge")->get();
    }
    

    
    //出撃とか
    public function launches() {
        return $this->hasMany("App\CCC\data\user_launch")->get();
    }
    
    //お部屋とか
    public function housings(){
        return $this->hasOne("App\CCC\data\user_housing")->get();
    }
    
    

}
