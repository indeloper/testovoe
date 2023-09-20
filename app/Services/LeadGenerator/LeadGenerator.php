<?php

namespace App\Services\LeadGenerator;

use App\Models\Lead;
use App\Services\Notification\Channels\Channel;
use App\Services\Notification\Channels\TelegramChannel;
use App\Services\Notification\Messages\LeadMessage;
use App\Services\Notification\Messages\Message;
use App\Services\Notification\Notification;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;

class LeadGenerator
{
    public function __construct(
        public Lead $lead
    )
    {
    }

    public function generate(): string
    {

        $accountKey = env('BITRIX24_ACCOUNT_KEY');
        $webhookKey = env('BITRIX24_WEBHOOK_KEY');

        $response = Http::get("https://{$accountKey}.bitrix24.ru/rest/1/{$webhookKey}/crm.lead.add.json",
            [
                'FIELDS' => [
                    'TITLE' => 'Новый лид',
                    'NAME' => $this->lead->name,
                    'PATRONYMIC' => $this->lead->patronymic,
                    'LAST_NAME' => $this->lead->surname,
                    'EMAIL' => $this->lead->email,
                    'PHONE' => $this->lead->phone,
                    'COMMENT' => $this->lead->comment,
                    'BIRTHDAY' => $this->lead->birthday->format('d.m.Y'),
                ]
            ]
        );

        $message = (new LeadMessage($this->lead))->meta($response->successful() ? 'Обработано' : 'Ошибка');

        try {
            Notification::channel((new TelegramChannel($message->plainText)))->send();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $response;
    }
}
