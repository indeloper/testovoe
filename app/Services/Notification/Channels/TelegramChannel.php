<?php

namespace App\Services\Notification\Channels;

use App\Services\Notification\Messages\Message;
use App\Services\Notification\Notification;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class TelegramChannel extends Channel
{

    public function __construct(
        public string $message
    )
    {
    }

    public function send(): Response
    {
        $key = env('TELEGRAM_BOT_KEY');
        $channel = env('NOTIFICATION_CHANEL_ID');

        $response = Http::get("https://api.telegram.org/bot{$key}/sendMessage",
            [
                'chat_id' => $channel,
                'text' => $this->message,
            ]
        );
        return $response;
    }
}
