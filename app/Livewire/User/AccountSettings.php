<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Account Settings')]
class AccountSettings extends Component
{
    public function render()
    {
        return view('livewire.user.account-settings');
    }
}
