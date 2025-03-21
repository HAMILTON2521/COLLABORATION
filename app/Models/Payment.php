<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Payment extends Model
{
    use HasFactory, HasUlids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'amount',
        'internal_txn_id',
        'status',
        'customer_id',
        'external_id',
        'msisdn'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::ulid()->toBase32();
            }
        });
    }

    public function getStatusColorAttribute()
    {
        return [
            'Received' => 'info',
            'Success' => 'success',
        ][$this->status] ?? 'danger';
    }

    /**
     * Relationships
     */

    public function airtelRequest()
    {
        return $this->belongsTo(AirtelRequest::class, 'internal_txn_id');
    }

    /**
     * The customer making the payment (nullable)
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
