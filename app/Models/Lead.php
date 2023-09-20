<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $patronymic
 * @property string $surname
 * @property Carbon $birthday
 * @property string $phone
 * @property string $email
 * @property string $comment
 *
 */
class Lead extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'birthday',
        'phone',
        'email',
        'comment'
    ];

    protected $casts = [
        'birthday' => 'date'
    ];

    public function birthday(): Attribute
    {
        return new Attribute(
            set: fn(string $value) => Carbon::parse($value)->format('Y-m-d')
        );
    }

    public function phone(): Attribute
    {
        return new Attribute(
            set: fn(string $value) => preg_replace('/[^0-9]/', '', $value)
        );
    }
}
