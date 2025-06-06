<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerProfile extends Model
{
    use HasUlids;

    protected $fillable = ['customer_id', 'photo'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
