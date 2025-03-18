<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('User Details')]
class UserDetails extends Component
{
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function edit()
    {
        $this->redirectRoute('more.users.edit', $this->user->id, navigate: true);
    }

    public function delete()
    {
        $this->user->delete();

        session()->flash('success', 'User deleted successfully');

        $this->redirectRoute('more.users', navigate: true);
    }
    public function render()
    {
        return view('livewire.users.user-details', [
            'user' => $this->user
        ]);
    }
}
