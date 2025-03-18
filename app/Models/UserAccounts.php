<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class UserAccounts extends Model
{
    use HasUlids;

    protected $fillable = ['customer_id', 'user_id'];
}
