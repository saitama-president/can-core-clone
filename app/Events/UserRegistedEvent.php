<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\CCC\data\user_status;
use App\CCC\data\user_team;


class UserRegistedEvent implements \App\Common\EventHandler {

    use Dispatchable,
        InteractsWithSockets,
        SerializesModels;

    public $u;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\CCC\data\user $u) {
        $this->u = $u;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn() {
        return new PrivateChannel('channel-name');
    }

    public function onFire() {

        $assets = \App\CCC\data\master_item_asset::all();
        $user= $this->u;
        //資材関連の登録
        foreach ($assets as $asset) {
            \Log::Debug("ASSET:{$asset->id}");
            $user->assets()->save(
                new \App\CCC\data\user_asset(["asset_id" => $asset->id])
            );
        }
        \Log::Debug("ステータス登録");
        $user->status()->save(new user_status());
        \Log::Debug("チーム登録");
        $team=new user_team(["team_id"=>1]);
        $user->teams()->save($team);
        
        /*チーム関連の登録*/
        /*出撃関連の登録*/       
        $user->launches()->save(new \App\CCC\data\user_launch([
            "launch_id"=>1,            
            ]));
        
        
        
    }

}
