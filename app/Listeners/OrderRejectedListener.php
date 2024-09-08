<?php

namespace App\Listeners;

use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use RingleSoft\LaravelProcessApproval\Events\ProcessRejectedEvent;

class OrderRejectedListener
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
    public function handle(ProcessRejectedEvent $event): void
    {
        $user = $event->approval->user;
        $order = $event->approval->approvable;
        $order->discard(null, $user);
        $order->status = 'rejected';
        $order->save();
    }
}
