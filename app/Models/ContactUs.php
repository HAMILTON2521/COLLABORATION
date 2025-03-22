<?php

namespace App\Models;

use App\Observers\ContactUsObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(ContactUsObserver::class)]
class ContactUs extends Model
{
    use HasUlids;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'subject',
        'message',
        'status'
    ];
}
