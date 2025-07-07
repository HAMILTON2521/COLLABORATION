<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasUlids;

    protected $guarded = ['id'];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
