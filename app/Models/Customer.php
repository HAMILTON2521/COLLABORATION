<?php

namespace App\Models;

use App\Observers\CustomerObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

#[ObservedBy(CustomerObserver::class)]
class Customer extends Model
{
    use HasFactory, HasUlids;

    public $incrementing = false;

    protected $guarded = ['id'];

    /**
     * The user who created this customer
     */
    public function creator(): BelongsTo
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
     * Payments associated with this customer
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Users assigned to this customer (UserAccount pivot table)
     */
    // public function assignedUsers()
    // {
    //     return $this->belongsToMany(User::class, 'user_accounts', 'customer_id', 'user_id');
    // }

    /**
     * Push requests associated with this customer
     */
    public function pushRequests()
    {
        return $this->hasMany(PushRequest::class);
    }

    /**
     * RealtimeData associated with this customer
     */
    public function realTimeData()
    {
        return $this->hasMany(RealtimeData::class);
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

    public function getIsActiveColorAttribute(): string
    {
        return [
            '1' => 'success',
        ][$this->is_active] ?? 'danger';
    }

    public function getIsActiveLabelAttribute(): string
    {
        return [
            '1' => 'Active'
        ][$this->is_active] ?? 'Inactive';;
    }

    /**
     * Get all of the incomingRequests for the Customer
     *
     * @return HasMany
     */
    public function incomingRequests(): HasMany
    {
        return $this->hasMany(IncomingRequest::class);
    }

    /**
     * Get all of the selcomOrders for the Customer
     *
     * @return HasMany
     */
    public function selcomOrders(): HasMany
    {
        return $this->hasMany(SelcomOrder::class);
    }

    /**
     * Get the user that owns the Customer
     *
     * @return HasOne
     */
    public function account(): HasOne
    {
        return $this->hasOne(UserAccount::class);
    }

    public function photo(): HasOne
    {
        return $this->hasOne(CustomerProfile::class);
    }

    public function getProfilePhotoAttribute(): string
    {
        if ($this->photo && $this->photo->photo && Storage::disk('public')->exists($this->photo->photo)) {
            return Storage::url($this->photo->photo);
        }
        return asset('assets/images/profile/avatar.jpg');
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => "{$this->first_name} {$this->last_name}"
        );
    }
}
