<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

#[ObservedBy(UserObserver::class)]
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'profile_image',
        'email',
        'password',
        'user_type',
        'created_by',
        'is_active'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = $model->id ?? Str::ulid()->toBase32();
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => "{$this->first_name} {$this->last_name}"
        );
    }

    /**
     * Relationship with User Verification
     */
    public function verificationToken()
    {
        return $this->hasOne(UserVerification::class);
    }

    /**
     * The user who created this user (Self-referencing)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Users created by this user (Self-referencing)
     */
    public function createdUsers()
    {
        return $this->hasMany(User::class, 'created_by');
    }

    /**
     * Relationship with UserAccount model
     */
    public function accounts()
    {
        return $this->hasMany(UserAccount::class);
    }

    /**
     * Customers created by the user
     */
    public function customers()
    {
        return $this->hasMany(Customer::class, 'created_by');
    }

    /**
     * Customers assigned to this user via UserAccount
     */
    public function assignedAccounts()
    {
        return $this->belongsToMany(Customer::class, 'user_accounts', 'user_id', 'customer_id');
    }

    public function unassignedAccounts()
    {
        return Customer::where('is_assigned', 0)
            ->whereNotIn('id', $this->assignedAccounts()->pluck('customer_id'))
            ->get();
    }


    /**
     * Scope for user search
     */
    public function scopeSearch($query, $term)
    {
        return $query->where('first_name', 'LIKE', "%{$term}%")
            ->orWhere('email', 'LIKE', "%{$term}%")
            ->orWhere('phone', 'LIKE', "%{$term}%")
            ->orWhere('last_name', 'LIKE', "%{$term}%");
    }
    /**
     * Badge color to display user types
     */
    public function getStatusColorAttribute()
    {
        return [
            'Admin' => 'primary',
            'User' => 'success'
        ][$this->user_type] ?? 'danger';
    }
    public function getIsActiveColorAttribute()
    {
        return [
            '1' => 'success',
        ][$this->is_active] ?? 'danger';
    }
    public function getIsActiveLabelAttribute()
    {
        return [
            '1' => 'Active'
        ][$this->is_active] ?? 'Inactive';;
    }

    public function getUserPayments(): Collection
    {
        return Payment::whereIn('customer_id', function ($query) {
            $query->select('customer_id')
                ->from('user_accounts')
                ->where('user_id', $this->id);
        })
            ->latest()
            ->get();
    }
}
