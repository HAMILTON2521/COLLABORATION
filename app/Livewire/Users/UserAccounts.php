<?php

namespace App\Livewire\Users;

use App\Models\User;
use App\Models\UserAccount;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('User Accounts')]
class UserAccounts extends Component
{
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }
    #[Computed()]
    public function accounts()
    {
        return $this->user->accounts()->latest()->get();
    }
    public function remove(UserAccount $userAccount)
    {
        $userAccount->delete();

        $this->dispatch('showToast', message: 'Account removed from user', status: 'Success');
    }
    public function render()
    {
        return view('livewire.users.user-accounts');
    }
}
