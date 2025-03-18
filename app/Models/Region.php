<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasUlids;

    protected $fillable = ['name', 'is_active'];
}
