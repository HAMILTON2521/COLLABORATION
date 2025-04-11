<?php

namespace App\Livewire\Payments;

use App\Models\Payment;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;

#[Title('Payments')]
class Payments extends Component
{
    #[Computed()]
    public function payments()
    {
        return Payment::latest()->get();
    }
    public function render()
    {
        return view('livewire.payments.payments');
    }
}
