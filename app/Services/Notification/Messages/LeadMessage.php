<?php

namespace App\Services\Notification\Messages;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Model;

class LeadMessage extends Message
{
    public function __construct(Model $model)
    {
        $this->plainText = $this->create($model);
    }

    public function meta(string $text): static
    {
        $this->plainText .= $text . ' ';

        return $this;
    }

    public function create(Lead|Model $model): string
    {
        return "Новый лид! {$model->surname} {$model->name} {$model->patronymic} {$model->birthday} {$model->phone} {$model->email} {$model->comment}";
    }
}
