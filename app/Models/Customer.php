<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Customer extends Model
{
    use HasFactory, HasUlids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'region_id',
        'district_id',
        'street',
        'ref',
        'created_by',
        'is_active',
        'is_assigned',
        'imei'
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

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => "{$this->first_name} {$this->last_name}"
        );
    }

    /**
     * The user who created this customer
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    /**
     * Customer region
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Customer district
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    /**
     * Relationship with ValveControl model
     */
    public function valveControls()
    {
        return $this->hasMany(ValveControl::class);
    }

    /**
     * Users assigned to this customer (UserAccount pivot table)
     */
    public function assignedUsers()
    {
        return $this->belongsToMany(User::class, 'user_accounts', 'customer_id', 'user_id');
    }

    /**
     * Payments associated with this customer
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Scope for customer search
     */
    public function scopeSearch($query, $term)
    {
        return $query->where('first_name', 'LIKE', "%{$term}%")
            ->orWhere('email', 'LIKE', "%{$term}%")
            ->orWhere('phone', 'LIKE', "%{$term}%")
            ->orWhere('ref', 'LIKE', "%{$term}%")
            ->orWhere('last_name', 'LIKE', "%{$term}%");
    }
}
