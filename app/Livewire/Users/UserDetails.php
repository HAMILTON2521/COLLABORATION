<?php

namespace App\Livewire\Users;

use App\Models\User;
use App\Models\UserAccount;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('User Details')]
class UserDetails extends Component
{
    public User $user;
    public $activeTab = '';

    public function mount(User $user)
    {
        $this->user = $user;
        $this->activeTab = 'profile';
    }

    #[Computed()]
    public function accounts()
    {
        return $this->user->accounts()->latest()->get();
    }
    #[Computed()]
    public function payments()
    {
        return $this->user->getUserPayments()->latest()->get();
    }

    public function edit()
    {
        $this->redirectRoute('more.users.edit', $this->user->id, navigate: true);
    }
    public function remove(UserAccount $userAccount)
    {
        $userAccount->delete();

        $this->dispatch('showToast', message: 'Account removed from user', status: 'Success');
    }

    public function delete()
    {
        $this->user->delete();

        session()->flash('success', 'User deleted successfully');

        $this->redirectRoute('more.users', navigate: true);
    }
    public function changeActiveStatus()
    {
        $this->user->update(['is_active' => $this->user->is_active == 0 ? 1 : 0]);

        $this->dispatch('showToast', message: 'Status changed successfully', status: 'Success');
    }
    public function assignAccount()
    {
        $this->redirectRoute('more.users.assign', ['user' => $this->user->id], navigate: true);
    }
    public function userAccounts()
    {
        $this->redirectRoute('more.users.accounts', ['user' => $this->user->id], navigate: true);
    }
    public function render()
    {
        return view('livewire.users.user-details');
    }
}
