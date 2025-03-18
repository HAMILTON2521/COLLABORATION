<?php

namespace App\Livewire\Users;

use Livewire\Attributes\Title;
use Livewire\Component;


#[Title('User Details')]
class EditUser extends Component
{
    public function render()
    {
        return view('livewire.users.edit-user');
    }
}
