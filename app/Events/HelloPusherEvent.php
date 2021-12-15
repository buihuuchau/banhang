<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class HelloPusherEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Request $request)
    {
        $this->message  = $request->contents; // nhan contents tu form gui qua
    }

    // public function broadcastOn()
    // {
    //     return ['development']; // thong bao voi data duoc gui qua ten development
    // }
    public function broadcastOn()
    {
        return ['mychanel']; // frontend <script>var channel = pusher.subscribe('mychanel');</script>
    }

    public function broadcastAs()
    {
        return 'myevent'; // frontend channel.bind('myevent', function(data) {}
    }
}
