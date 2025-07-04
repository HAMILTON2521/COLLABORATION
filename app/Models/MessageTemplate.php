<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MessageTemplate extends Model
{
    use HasUlids;

    protected $guarded = ['id'];

    /**
     * Get the activity associated with the MessageTemplate
     *
     * @return HasOne
     */
    public function activity(): HasOne
    {
        return $this->hasOne(MessageActivity::class);
    }
}
