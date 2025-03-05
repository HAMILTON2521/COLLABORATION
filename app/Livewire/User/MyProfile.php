<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('My Profile')]
class MyProfile extends Component
{
    public function render()
    {
        return view('livewire.user.my-profile');
    }
}
