<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class HelloPusherEventt implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    // nhan thong bao qua form// neu nhan qua form can co router de call file nay
    public function __construct(Request $request)
    {
        $this->message  = $request->contents; // nhan contents tu form gui qua
    }

    // nhan thong bao qua controller // de goi file: event(new \App\Events\HelloPusherEvent($thongbao)); // HelloPusherEvent la ten file nay
    // public function __construct($thongbao)
    // {
    //     $this->message  = $thongbao; // nhan $thongbao tu controller gui qua
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
