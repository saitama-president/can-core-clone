<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

class master_rare_type extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_rare_type";
    public $fillable = [
        "level",
        "name"
    ];

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("level");
        $b->unique(["level"], "uniq_master_rare_type");
        $b->string('name', 50);
        $b->timestamps();
    }

    public static function InitTable() {
        
    }

    public function spec() {
        return $this->hasOne("App\CCC\data\master_card_spec");
    }

    public function profile() {
        return $this->hasOne("App\CCC\data\master_card_spec");
    }

    public function master_class() {
        return $this->belongsTo("App\CCC\data\master_card_class", "class_id");
    }

    public static function RegistMasterRow(array $row = array()) {

        $record = new master_rare_type([
            "level" => $row["ランク"],
            "name" => $row["定義名"],
        ]);
        $record->save();
    }

}
