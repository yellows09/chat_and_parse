<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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
        return $this->http::post('https://api.telegram.org/bot' . $this->bot . '/sendMessage', [
            'chat_id' => $chat_id,
            'text' => $message,
            "parse_mode" => "html"
        ]);
    }

    public function sendPhoto($chat_id,$file)
    {
        return $this->http::attach('document',Storage::get('/public/'.$file),'document.jpeg')
            ->post('https://api.telegram.org/bot' . $this->bot . '/sendDocument', [
                'chat_id' => $chat_id,
            ]);
    }
}
