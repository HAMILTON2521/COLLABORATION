<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\UserForm;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('New User')]
class CreateUser extends Component
{
    public UserForm $form;

    public function save()
    {
        $this->form->store();

        $this->dispatch('showToast', message: 'User created successfully', status: 'Success');

        $this->form->reset();
    }
    public function render()
    {
        return view('livewire.users.create-user');
    }
}
