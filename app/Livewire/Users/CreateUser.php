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
        $user = $this->form->store();

        session()->flash('success', 'User created successfully.');

        $this->form->reset();
        $this->redirectRoute('more.users.show', ['user' => $user->id]);
    }
    public function render()
    {
        return view('livewire.users.create-user');
    }
}
