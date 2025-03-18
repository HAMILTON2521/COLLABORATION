<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Livewire\Form;

class UserForm extends Form
{
    public $first_name = '';
    public $last_name = '';
    public $phone = '';
    public $email = '';
    public $user_type = '';
    public $password = '';
    public $password_confirmation = '';

    protected function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:60'],
            'last_name' => ['required', 'string', 'max:60'],
            'phone' => ['required', 'size:10', 'unique:' . User::class],
            'email' => ['required', 'string', 'email', 'max:60', 'unique:' . User::class],
            'user_type' => ['required', 'in:Admin,User'],
            'password' => ['required', 'confirmed', env('APP_ENV') === 'production' ? Password::min(8)
                ->max(20)
                ->mixedCase()
                ->symbols()
                ->numbers()
                ->uncompromised() : Password::defaults()],
            'password_confirmation' => ['required'],
        ];
    }

    public function store()
    {
        $validData = $this->validate();
        $user = User::create([
            'first_name' => Str::ucfirst($validData['first_name']),
            'last_name' => ucfirst($validData['last_name']),
            'email' => $validData['email'],
            'phone' => $validData['phone'],
            'user_type' => $validData['user_type'],
            'password' => Hash::make($validData['password']),
            'created_by' => Auth::id()
        ]);
    }
}
