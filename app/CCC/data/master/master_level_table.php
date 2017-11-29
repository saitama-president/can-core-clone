<?php

namespace App\CCC\data\master;

use Illuminate\Database\Eloquent\Model;
use App\CCC\data\master\master_card_spec;
use App\CCC\data\master\master_card_class;


class master_level_table extends Model implements \App\Common\CreateTable, \App\Common\MasterTable {

    public $table = "master_level_table";
    public $fillable = [
        "level",
        "name"
    ];

    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->integer("level");
        $b->unique(["level"], "uniq_master_level_table");
        $b->string('name', 50);
        $b->timestamps();
    }

    public static function InitTable() {
        
    }

    public function spec() {
        return $this->hasOne(master_card_spec::class);
    }

    public function profile() {
        return $this->hasOne(master_card_profile::class);
    }

    public function master_class() {
        return $this->belongsTo(master_card_class::class, "class_id");
    }

    public static function RegistMasterRow(array $row = array()) {

        $record = new master_rare_type([
            "level" => $row["ランク"],
            "name" => $row["定義名"],
        ]);
        $record->save();
    }

}
