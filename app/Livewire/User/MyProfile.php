<?php

namespace App\Livewire\User;

use App\Livewire\Forms\ProfileForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('My Profile')]
class MyProfile extends Component
{
    public ProfileForm $form;

    public function mount()
    {
        $this->form->setUser(Auth::user());
    }


    public function update()
    {
        //FIXME: When a user updates first_name and last_name the Auth::user() details are not updated until the page reloads
        $this->form->update();
    }
    public function changePassword()
    {
        //
    }

    public function render()
    {
        return view('livewire.user.my-profile');
    }
}
