<?php

namespace App\Services\Notification\Messages;

use Illuminate\Database\Eloquent\Model;

abstract class Message
{
    public string $plainText;

    abstract public function create(Model $model): string;
}
