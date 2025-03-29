<?php

namespace App\Livewire\Dashboard;

use App\Models\Customer;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Dashboard')]
class AdminHomePage extends Component
{
    #[Computed()]
    public function countOfCustomers()
    {
        return Customer::count();
    }
    public function render()
    {
        return view('livewire.dashboard.admin-home-page');
    }
}
