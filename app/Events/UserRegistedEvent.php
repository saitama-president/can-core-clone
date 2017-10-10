<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserRegistedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\CCC\data\user $u)
    {
        \Log::Debug("ユーザ登録イベント!");
        \Log::debug("パラメータマスタ登録");
        $assets= \App\CCC\data\master_assets::all();
        
        foreach($assets as $asset){
            \App\CCC\data\user_asset::insert(
                [
                    "user_id"=>$u->id,
                    "asset_id"=>$asset->id,
                ]);
        }
        \Log::debug("パラメータマスタ登録完了");
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
