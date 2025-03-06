<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class AirtelRequest extends Model
{
    use HasFactory,HasUlids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'type',
        'request',
        'customer_msisdn',
        'merchant_msisdn',
        'amount',
        'user_name',
        'password',
        'pin',
        'customer_name',
        'reference',
        'reference_1',
        'reference_2',
        'enquiry_txn_id',
        'status',
        'error_message',
        'error_details'
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
}
