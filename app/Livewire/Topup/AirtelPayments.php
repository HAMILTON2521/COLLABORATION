<?php

namespace App\Livewire\Topup;

use App\Models\Payment;
use Livewire\Attributes\Computed;
use Livewire\Component;

use Livewire\Attributes\Title;

#[Title('Airtel Payments')]
class AirtelPayments extends Component
{
    #[Computed()]
    public function payments()
    {
        Log:
        info(json_encode(Payment::with(['customer', 'airtelRequest'])->orderBy('created_at', 'desc')->get()));
        return Payment::with(['customer', 'airtelRequest'])->orderBy('created_at', 'desc')->get();
    }
    public function render()
    {
        return view('livewire.topup.airtel-payments');
    }
}
