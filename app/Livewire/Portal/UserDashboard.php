<?php

namespace App\Livewire\Portal;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Portal')]
class UserDashboard extends Component
{
    #[Computed()]
    public function payments()
    {
        return Auth::user()->getUserPayments()->latest()->take(5)->get();
    }

    #[Computed()]
    public function total()
    {
        return Auth::user()->getUserPayments()
            ->selectRaw('SUM(amount) as total_amount')
            ->first();
    }
    #[Computed()]
    public function recentPayment()
    {
        return Auth::user()->getUserPayments()->latest()->first()->amount ?? 0;
    }

    public function render()
    {
        return view('livewire.portal.user-dashboard');
    }
}
