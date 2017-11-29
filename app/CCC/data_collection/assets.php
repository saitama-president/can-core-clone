<?php
namespace App\CCC\data_collection;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\CCC\data\user\user_asset;
use App\CCC\data\master\master_item_asset;
/**
 * Description of assets
 *
 * @author shinp
 */
class assets extends UserCollection{  
    /**
     * 消費系
     * @param type $key
     * @param type $value
     * @return boolean
     */
    public function spend($key, $value = 10) {
        \Log::Debug("SPEND発行やで[$key => $value ]");
        $user= request()->user;
        
        $asset = user_asset::where("user_id", $user->id)
            ->where("asset_id",$key)
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


        return $results;
    }


}
