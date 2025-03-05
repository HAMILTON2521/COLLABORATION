<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Customers')]
class Customers extends Component
{
    public function render()
    {
        return view('livewire.customer.customers');
    }
}
