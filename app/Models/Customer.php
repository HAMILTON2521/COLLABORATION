<?php

namespace App\Models;

use App\Models\Setting;
use App\Observers\CustomerObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(CustomerObserver::class)]
class Customer extends Model
{
    use  HasUlids;

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
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Customer district
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Relationship with ValveControl model
     */
    public function valveControls(): HasMany
    {
        return $this->hasMany(ValveControl::class);
    }

    /**
     * Payments associated with this customer
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Push requests associated with this customer
     */
    public function pushRequests(): HasMany
    {
        return $this->hasMany(PushRequest::class);
    }

    /**
     * Users assigned to this customer (UserAccount pivot table)
     */
    // public function assignedUsers()
    // {
    //     return $this->belongsToMany(User::class, 'user_accounts', 'customer_id', 'user_id');
    // }

    /**
     * RealtimeData associated with this customer
     */
    public function realTimeData(): HasMany
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
        ][$this->is_active] ?? 'Inactive';
        ;
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
        if ($this->image && $this->image->path && Storage::disk('public')->exists($this->image->path)) {
            return Storage::url($this->image->path);
        }
        return asset('assets/images/profile/avatar.jpg');
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }


    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => "{$this->first_name} {$this->last_name}"
        );
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            if (!$customer->ref) {
                // Get prefix and base number from settings
                $prefix = Setting::get('SELCOM_TILL_NUMBER');
                $baseNumber = (int) Setting::get('FIRST_ACCOUNT_NUMBER');

                // Find last created customer with matching prefix
                $lastCustomer = self::where('ref', 'like', $prefix . '%')
                    ->orderByDesc('ref')
                    ->first();

                if ($lastCustomer) {
                    preg_match('/' . preg_quote($prefix, '/') . '(\d+)/', $lastCustomer->ref, $matches);
                    $lastNumber = isset($matches[1]) ? (int) $matches[1] : $baseNumber;
                    $nextNumber = $lastNumber + 1;
                } else {
                    $nextNumber = $baseNumber;
                }

                $customer->ref = $prefix . $nextNumber;
            }
        });
    }

    public function selcomMerchantPayments(): HasMany
    {
        return $this->hasMany(SelcomMerchantPayment::class);
    }

}
