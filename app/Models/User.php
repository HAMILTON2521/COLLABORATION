<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
     * Relationship with UserAccount model
     */
    public function accounts()
    {
        return $this->hasMany(UserAccount::class);
    }

    public function unassignedAccounts()
    {
        return Customer::where('is_assigned', 0)
            ->whereNotIn('id', $this->accounts()->pluck('customer_id'))
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
}
