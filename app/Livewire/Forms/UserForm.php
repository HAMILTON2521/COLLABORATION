<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user;
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
            'user_type' => ['required', 'in:Admin,User'],
            'phone' => [
                'required',
                'size:10',
                'unique:' . User::class
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:60',
                'unique:' . User::class
            ],
            'password' => [
                'required',
                'confirmed',
                env('APP_ENV') === 'production' ? Password::min(8)
                    ->max(20)
                    ->mixedCase()
                    ->symbols()
                    ->numbers()
                    ->uncompromised() : Password::min(1)->max(20)
            ],
            'password_confirmation' => ['required'],
        ];
    }

    public function setUser(User $user)
    {
        $this->user = $user;

        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->user_type = $user->user_type;
        $this->phone = $user->phone;
    }

    public function store()
    {
        $validData = $this->validate();
        $user = User::create([
            'first_name' => Str::ucfirst(Str::lower($validData['first_name'])),
            'last_name' => Str::ucfirst(Str::lower($validData['last_name'])),
            'email' => $validData['email'],
            'phone' => $validData['phone'],
            'user_type' => $validData['user_type'],
            'password' => Hash::make($validData['password']),
            'created_by' => Auth::id()
        ]);

        return $user;
    }
    public function update()
    {
        $validData = $this->validate([
            'first_name' => ['required', 'string', 'max:60'],
            'last_name' => ['required', 'string', 'max:60'],
            'user_type' => ['required', 'in:Admin,User'],
            'phone' => [
                'required',
                'size:10',
                'unique:' . User::class . ',phone,' . optional($this->user)->id
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:60',
                Rule::unique(User::class)->ignore($this->user->id)
            ]
        ]);

        $this->user->update([
            'first_name' => Str::ucfirst(Str::lower($validData['first_name'])),
            'last_name' => Str::ucfirst(Str::lower($validData['last_name'])),
            'phone' => $validData['phone'],
            'user_type' => $validData['user_type']
        ]);
    }
}
