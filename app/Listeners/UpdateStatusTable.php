<?php

namespace App\Listeners;

use App\Events\RequestIsCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateStatusTable
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
     * @param  RequestIsCreated  $event
     * @return void
     */
    public function handle(RequestIsCreated $event)
    {
        //
    }
}
