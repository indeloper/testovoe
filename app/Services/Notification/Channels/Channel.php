<?php

namespace App\Services\Notification\Channels;

abstract class Channel
{
    abstract public function send();
}
