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

        $this->form->reset();
        session()->flash('success', 'User created successfully');
        $this->redirectRoute('more.users', navigate: true);
    }
    public function render()
    {
        return view('livewire.users.create-user');
    }
}
