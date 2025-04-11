<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Title('Users')]
class Users extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $perPage = 10;

    // Reset pagination when search query changes
    public function updatedSearch()
    {
        $this->resetPage();
    }

    #[Computed()]
    public function users()
    {
        return User::latest()->search($this->search)->paginate($this->perPage);
    }
    #[Computed()]
    public function pages()
    {
        return [10, 25, 50, 100];
    }
    public function delete(User $user)
    {
        $user->delete();

        $this->dispatch('showToast', message: 'User deleted successfully', status: 'Success');
    }
    public function render()
    {
        return view('livewire.users.users');
    }
}
