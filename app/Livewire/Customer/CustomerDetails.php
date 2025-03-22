<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Customer Details')]
class CustomerDetails extends Component
{
    public function render()
    {
        return view('livewire.customer.customer-details');
    }
}
