<?php

namespace App\Providers;

use App\Events\deleteSerie;
use App\Events\NewSerie;
use App\Listeners\deleteCoverSerie;
use App\Listeners\logNewSerieAdded;
use App\Listeners\sendEmailNewSerieAdded;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NewSerie::class => [
            sendEmailNewSerieAdded::class,
            logNewSerieAdded::class
        ],
        // deleteSerie::class => [
        //     deleteCoverSerie::class
        // ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
