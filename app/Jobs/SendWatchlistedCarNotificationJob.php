<?php

namespace App\Jobs;

use App\Mail\WatchlistedCarMail;
use App\Models\Car;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendWatchlistedCarNotificationJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Car $car)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        Mail::to($this->car->owner->email)->send(new WatchlistedCarMail($this->car));
    }
}
