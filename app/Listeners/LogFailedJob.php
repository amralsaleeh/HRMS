<?php

namespace App\Listeners;

use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Log;

class LogFailedJob
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
    public function handle(JobFailed $event): void
    {
        Log::error('Job Failed', [
            'connection' => $event->connectionName,
            'job' => $event->job->resolveName(),
            'queue' => $event->job->getQueue(),
            'exception' => $event->exception->getMessage(),
            'trace' => $event->exception->getTraceAsString(),
        ]);
    }
}
