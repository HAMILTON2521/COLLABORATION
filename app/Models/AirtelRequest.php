<?php

namespace App\Models;

use App\Observers\AirtelRequestObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

#[ObservedBy(AirtelRequestObserver::class)]
class AirtelRequest extends Model
{
    use HasFactory, HasUlids;

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
        'error_details',
        'customer_id'
    ];

    /**
     * Relationship with Payment model
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
