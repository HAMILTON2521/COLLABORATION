<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class MessageTemplate extends Model
{
    use HasUlids;

    protected $guarded = ['id'];

    /**
     * Get the activity associated with the MessageTemplate
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function activity(): HasOne
    {
        return $this->hasOne(MessageActivity::class);
    }
}
