<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CCC\data_trait\user;

use App\CCC\data\user_asset;
use App\CCC\data\master_assets;
/**
 * Description of asset
 *
 * @author s-yoshihara
 */
trait asset {

    //資材とか
    public function assets() {
        return $this->hasMany("App\CCC\data\user_asset");
    }

    /**
     * 消費系
     * @param type $key
     * @param type $value
     * @return boolean
     */
    public function spend($key, $value = 10) {
        $asset = user_asset::where("user_id", $this->id)
            ->where("asset_id", master_assets::idByKey($key))
            ->first();

        if (empty($asset))
            return false;

        return $asset->spend($value);
    }

    public function status() {

        $results = [];
        foreach ($this->assets()->get() as $asset) {
            $results[$asset->key()] = $asset->value();
        }
        \Log::Debug(var_export($results, true));


        return $results;
    }

}
