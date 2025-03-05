<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Create Customer')]
class CreateCustomer extends Component
{
    public function render()
    {
        return view('livewire.customer.create-customer');
    }
}
