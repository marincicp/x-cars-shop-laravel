<?php

namespace App\Listeners;

use App\Events\WatchlistedCar;
use App\Jobs\SendWatchlistedCarNotificationJob;
use App\Mail\WatchlistedCarMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

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
