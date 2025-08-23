<?php

namespace App\Livewire\Payments;

use App\Models\Payment;
use Livewire\Component;

class PaymentDetails extends Component
{
    public Payment $payment;

    public function mount(Payment $payment): void
    {
        $this->payment = $payment;
    }

    public function render()
    {
        return view('livewire.payments.payment-details')->title('Payment Details');
    }
}
