<?php

namespace App\Livewire\Login;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.login')]
#[Title('Login')]
class Login extends Component
{

    public function render()
    {
        return view('livewire.login.login');
    }
}
