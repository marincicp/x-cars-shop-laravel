<?php

namespace App\Listeners;

use App\Events\WatchlistedCar;
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
        $owner = $event->car->owner;
        Mail::to($owner->email)->send(new WatchlistedCarMail($event->car));
    }
}
