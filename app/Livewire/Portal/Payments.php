<?php

namespace App\Livewire\Portal;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Payments')]
class Payments extends Component
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
    public function payments()
    {
        return Auth::user()->getUserPayments()->latest()->search($this->search)->paginate($this->perPage);
    }
    #[Computed()]
    public function pages()
    {
        return [10, 25, 50, 100];
    }
    public function render()
    {
        return view('livewire.portal.payments');
    }
}
