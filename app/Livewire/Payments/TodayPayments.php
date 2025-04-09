<?php

namespace App\Livewire\Payments;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;

#[Title('Payments')]
class TodayPayments extends Component
{
    #[Computed()]
    public function payments()
    {
        return [];
    }
    public function render()
    {
        return view('livewire.payments.today-payments');
    }
}
