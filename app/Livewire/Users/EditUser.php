<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title('Edit User')]
class EditUser extends Component
{
    public UserForm $form;
    public User $user;

    public function mount(User $user)
    {
        $this->form->setUser($user);
        $this->user = $user;
    }
    public function save()
    {
        $this->form->update();

        $this->dispatch('showToast', message: 'User updated successfully', status: 'Success');
    }

    public function render()
    {
        return view('livewire.users.edit-user');
    }
}
