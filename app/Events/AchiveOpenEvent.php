<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AchiveOpenEvent implements \App\Common\EventHandler
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $user;
    public $achive;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        \App\CCC\data\user $user,
        \App\CCC\data\master_item_achive $achive)
    {
        $this->user=$user;
        $this->achive=$achive;                
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

    public function onFire() {
        \Log::Debug("実績開放イベント発火");
    }

}
