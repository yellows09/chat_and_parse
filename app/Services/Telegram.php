<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Telegram
{
    protected $bot;
    protected $http;

    public function __construct(Http $http, $bot)
    {
        $this->http = $http;
        $this->bot = $bot;
    }

    public function send($chat_id, $message)
    {
        $this->http::post('https://api.telegram.org/bot'. $this->bot . '/sendMessage',[
            'chat_id' => $chat_id,
            'text' => $message,
            "parse_mode" => "html"
        ]);
    }
}
