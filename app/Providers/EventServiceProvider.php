<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //イベント登録
        Event::listen(\App\Events\UserRegistedEvent::class,function(
            \App\Events\UserRegistedEvent $event){
            $event->onFire();
        });
        Event::listen(\App\Events\AchiveOpenEvent::class,function(
            \App\Events\AchiveOpenEvent $event){
            $event->onFire();
        });

        
        
        //
        
        
    }
}
