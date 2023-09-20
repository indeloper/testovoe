<?php

namespace App\Services\Notification;

use App\Services\Notification\Channels\Channel;

class Notification
{
    public static function channel(Channel $channel): Channel
    {
        return self::prepare($channel);
    }

    public static function message()
    {

    }

    private static function prepare(Channel $channel): Channel
    {
        /**
         * some actions
         */
        return $channel;
    }
}
