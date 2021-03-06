<?php

namespace App\CCC\data\master;

use Illuminate\Database\Eloquent\Model;
use App\CCC\data\master\master_card;

/**
 * キャラクターの名寄せテーブル
 */
class master_character extends Model 
implements \App\Common\CreateTable, \App\Common\MasterTable
{
    public $table="master_character";
    public $fillable = ["id","name", "description"];
    //

    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('name',50);        
        $b->timestamps();
        $b->text('description')->default('')->nullable();
    }
    
    /**
     * 同一キャラクターのカード一覧
     * @return type
     */
    public function master_card(){
            
        return $this->hasMany(master_card::class,"character_id");        
    }
    
    

    public static function InitTable() {
        
    }

    public static function RegistMasterRow(array $data = array()) {
        if (empty($data["名前"])) {
            return;
        }

        self::updateOrCreate(
            ["id" => $data["ID"]], [
            "name" => $data["名前"],
            "description" => $data["説明"]?:"なし",
            ]
        );
    }

}
