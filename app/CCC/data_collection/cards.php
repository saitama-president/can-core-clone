<?php
namespace App\CCC\data_collection;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\CCC\data\user_card;
use App\CCC\data\user_card_status;
use App\CCC\data\user_card_tension;
/**
 * Description of assets
 *
 * @author shinp
 */
class cards extends UserCollection{  
    public function remove($id){
      //削除
      $this->find($id)->delete();
      
      return true;
    }
    
    public function add($master_card_id){
        $card=new user_card(["master_card_id"=>$master_card_id]);        
        
    
        $user=$this->user;
        $user->cards()->save($card);
        
        /*装備一覧を取得する*/
        $equips= \App\CCC\data\master_card_equip::
            where("master_card_id",$master_card_id)
            ->get();
        /*装備品を保存する*/
        foreach($equips as $equip){
            $user->equips()->save(new \App\CCC\data\user_equipment([                
                "master_equip_id"=>$equip->master_equip_id,
                "attachment_card_id"=>$card->id,
                "attachment_slot_id"=>$equip->slot_id,                
            ]));
        }
        
        
        //$card->equips()->saveMany($equips);
        $card->status()->save(
            new user_card_status([
            "user_id"=>$user->id,
            //本来はマスタから取得する
            "hp"=>100
        ]));
    
        $tention=new user_card_tension(
            ["user_id"=>$user->id]
        );
        $card->tension()->save($tention);
        \Log::Debug("気分を保存した:{$tention->id}:{$tention->card_id}");
        //$card->status()->save(new user_car)
  
        
    }


}
