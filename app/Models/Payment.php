<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'amount',
        'msisdn',
        'reference',
        'external_id',
        'internal_txn_id',
        'amount',
        'external_reference',
        'payer_name',
        'merchant',
        'status'
    ];
}
