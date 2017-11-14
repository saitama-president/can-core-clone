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
class repaires extends UserCollection{  

    
    public function add($card_id){
        \Log::Debug("空いてるところに入院させるで");
        $list=$this->get();
        $user=$this->user;
        
        for($i=1;$i<=$user->status->repair_dock;$i++){
            //空いてるのを探す
            \Log::Debug("検索:{$i}");
            if(!$this->where("line_id",$i)->exists()){
                //ここに入院
                $repair=new \App\CCC\data\user_repair([
                    "line_id"=>$i,
                    "card_id"=>$card_id,
                    "complete_datetime"=>
                    \Carbon\Carbon::now()->addSeconds(30)
                ]);
                $this->save($repair);
                \Log::Debug("追加した:{$repair->id}");
                return true;
            }
            
        }
        return FALSE;
        
    }
    
    public function refresh(){
        
        foreach($this->get() as $repair){
           if( \Carbon\Carbon::parse($repair->complete_datetime)
               < \Carbon\Carbon::now()){
               \Log::Debug("戦場に復帰");
               $repair->card()->first()->status->repair();
               $repair->delete();
           }
        }
        return true;
    }
    
    public function freeLine(){
        
    }
    


}
