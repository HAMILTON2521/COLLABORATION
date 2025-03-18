<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Users')]
class Users extends Component
{
    #[Computed()]
    public function users()
    {
        return User::latest()->get();
    }
    public function render()
    {
        return view('livewire.users.users');
    }
}
