<?php

namespace App\CCC\data\user;

use Illuminate\Database\Eloquent\Model;
use App\CCC\data\master as master;

class user_status extends Model implements \App\Common\CreateTable {

    public $table = "user_status";
    public $fillable = [
        "user_id"
    ];

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer('user_id');

        $b->integer('next_exp')->default(10); //ユーザ経験値
        $b->integer('user_level')->default(1); //ユーザレベル

        $b->integer('create_dock')->default(2); //解放できる工場の数
        $b->integer('repair_dock')->default(2); //解放できる工場の数

        $b->integer('team_max')->default(2); //編成できるチームの数

        $b->integer('mission_max')->default(5); //オープンできるミッションの数


        $b->integer('card_max')->default(60); //所持できるカードの数
        $b->integer('item_max')->default(100); //所持できるアイテムの数
        //$b->primary("user_id");
        $b->unique(['user_id'], "uniq_user_status");

        $b->integer('max_card')->default(20);
        $b->timestamps();
    }

    use \App\CCC\data\traits\belongsToUser;

    /**
     * 
     * @return type
     */
    public function requireChargeAssets() {

        return (Object) [
                "A" => 10,
                "B" => 10,
                "C" => 10,
                "D" => 10,
        ];
    }
    
    public function requireRepairAssets(){
        return (Object) [
                "A" => 20,
                "B" => 20,
                "C" => 20,
                "D" => 10,
        ];        
        
    }

}
