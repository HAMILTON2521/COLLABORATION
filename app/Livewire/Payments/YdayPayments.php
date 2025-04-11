<?php

namespace App\Livewire\Payments;

use App\Models\Payment;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;

#[Title('Payments')]
class YdayPayments extends Component
{

    #[Computed()]
    public function payments()
    {
        return Payment::latest()->whereDate('created_at', now()->subDay())->get();
    }
    public function render()
    {
        return view('livewire.payments.yday-payments');
    }
}
