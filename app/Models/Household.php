<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Household extends Model
{
    use HasUlids, HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    public $fillable = [
        'name',
        'phone',
        'address',
        'created_by',
        'fee',
        'warn_money',
        'password',
        'serial_number',
        'status'
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

    /**
     * Relationships
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by')->select('id', 'first_name', 'last_name');
    }
}
