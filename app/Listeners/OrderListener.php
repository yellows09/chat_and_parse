<?php

namespace App\Listeners;

use App\Services\Telegram;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderListener
{
    protected $telegram;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->telegram->send($event->chat_id, $event->message);
    }
}
