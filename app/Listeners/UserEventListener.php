<?php

namespace App\Listeners;

use App\Events\UserRegisted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegisted  $event
     * @return void
     */
    public function handle(UserRegisted $event)
    {
        //
    }
}
