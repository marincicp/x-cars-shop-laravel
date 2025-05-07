<?php

namespace App\Listeners;

use App\Events\WatchlistedCar;
use App\Jobs\SendWatchlistedCarNotificationJob;

class SendWatchlistedCarNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WatchlistedCar $event): void
    {

        SendWatchlistedCarNotificationJob::dispatch($event->car);
    }
}
