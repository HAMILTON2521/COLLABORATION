<?php

namespace App\Livewire\User;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Account Settings')]
class AccountSettings extends Component
{
    public function render()
    {
        return view('livewire.user.account-settings');
    }
}
