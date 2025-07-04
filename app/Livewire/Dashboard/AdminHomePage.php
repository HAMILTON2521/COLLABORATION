<?php

namespace App\Livewire\Dashboard;

use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Support\Number;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;

#[Title('Dashboard')]
class AdminHomePage extends Component
{
    #[Computed()]
    public function countOfCustomers()
    {
        return Customer::count();
    }
    #[Computed()]
    public function payments(): array
    {
        return [
            'yesterday' => Number::abbreviate(Payment::whereDate('created_at', now()->subDay())->sum('amount')),
            'today' => Number::abbreviate(Payment::whereDate('created_at', now())->sum('amount')),
            'total' => Number::abbreviate(Payment::sum('amount')),
            'failedRecharge' => Number::abbreviate(Payment::whereDate('created_at', now())->where('status', 'Failed')->sum('amount')),
            'payments' => Payment::latest()->limit(5)->get(),
        ];
    }
    public function render()
    {
        return view('livewire.dashboard.admin-home-page');
    }
}
