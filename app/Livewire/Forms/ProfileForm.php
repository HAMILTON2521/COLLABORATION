<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProfileForm extends Form
{
    public User $user;
    public $email;

    #[Validate('required|string|max:255', as: 'first name')]
    public $first_name = '';

    #[Validate('required|string|max:255', as: 'last name')]
    public $last_name;

    #[Validate('required|size:10', as: 'phone number')]
    public $phone;

    public function setUser(User $user)
    {
        $this->user = $user;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->phone = $user->phone;
        $this->email = $user->email;
    }

    public function update()
    {
        $validData = $this->validate();

        $this->user->update([
            'first_name' => $validData['first_name'],
            'last_name' => $validData['last_name'],
            'phone' => $validData['phone']
        ]);

        session()->flash('success', 'Profile updated successfully');
    }
}
