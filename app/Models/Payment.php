<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'internal_txn_id',
        'status',
        'customer_id',
        'external_id',
        'msisdn'
    ];
}
