<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class SmsSetting extends Model
{
    use HasUlids;

    protected $guarded = ['id'];

    public static function get(string $key, $default = null)
    {
        return self::where('key', $key)->value('value') ?? $default;
    }

    public static function set(string $key, $value)
    {
        return self::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
