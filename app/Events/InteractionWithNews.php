<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Logs;

class InteractionWithNews
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\Logs
     */
    public $logs;
    public $title;
    public $ip;
    public $action;
    /**
     * Create a new event instance.
     *
     * @param Logs $logs
     * @param  $ip
     * @return void
     */
    public function __construct(Logs $logs, $ip, $title, $action)
    {
        $this->logs = $logs;
        $this->ip = $ip;
        $this->title = $title;
        $this->action = $action;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
