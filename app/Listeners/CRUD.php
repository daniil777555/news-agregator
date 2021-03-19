<?php

namespace App\Listeners;

use App\Models\Logs;
use App\Events\InteractionWithNews;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CRUD
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
     * @param  InteractionWithNews  $event
     * @return void
     */
    public function handle(InteractionWithNews $event)
    {
        if(isset($event->logs) && $event->logs instanceof Logs) {
            $event->logs->userName = session('login');
            $event->logs->action = $event->action;
            $event->logs->updatedNews = $event->title;
            $event->logs->userIP = $event->ip;
            $event->logs->updatedAt = date("Y-m-d H:i:s");;
            $event->logs->save();
            Cache::pull("news");
        }
    }
}
