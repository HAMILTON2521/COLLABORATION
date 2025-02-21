<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirtelRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'txn_id',
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
}
