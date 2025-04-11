<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasUlids;

    protected $fillable = [
        'key',
        'value',
        'type',
        'is_active',
        'description',
        'created_by'
    ];
}
