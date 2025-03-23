<?php

namespace App\Models;

use App\Observers\RealtimeDataObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(RealtimeDataObserver::class)]
class RealtimeData extends Model
{
    use HasUlids;

    protected $fillable = [
        'source',
        'customer_id',
        'status',
        'balance',
        'battery',
        'energy_type',
        'read_time',
        'imei',
        'margin',
        'margin',
        'leakage_mark',
        'reading',
        'valve_state',
        'valve_status',
        'temperature',
        'class_mode',
        'day_read_time',
        'month_read_time',
        'pay_mode',
        'rssi',
        'snr',
        'day_consumption',
        'error_code',
        'error_message'
    ];

    /**
     * Relationshipn with Customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    /**
     * Relationshipn with User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
