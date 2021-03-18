<?php

namespace App\Listeners;

use App\Models\Logs;
use App\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WhoDidLogout
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
     * @param  object  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        if(isset($event->logs) && $event->logs instanceof Logs) {
            $event->logs->userName = session('login');
            $event->logs->action = "Logout";
            $event->logs->userIP = $event->ip;
            $event->logs->loginedAt = date("Y-m-d H:i:s");;
            $event->logs->save();
        }
    }
}
