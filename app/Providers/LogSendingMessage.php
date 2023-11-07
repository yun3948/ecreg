<?php

namespace App\Providers;

use App\Providers\MessageSending;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSendingMessage
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
     * @param  \App\Providers\MessageSending  $event
     * @return void
     */
    public function handle(MessageSending $event)
    {
        //
    }
}
