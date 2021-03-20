<?php

namespace App\Listeners;

use App\Models\Logs;
use App\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WhoDidLogin
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
     * @return void
     */
    public function handle(Login $event)
    {
        if(isset($event->logs) && $event->logs instanceof Logs) {
            $event->logs->userName = session('login');
            $event->logs->action = "Login";
            $event->logs->userIP = $event->ip;
            $event->logs->loginedAt = date("Y-m-d H:i:s");;
            $event->logs->save();
        }
    }
}
