<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Edit Customer')]
class EditCustomer extends Component
{
    public function render()
    {
        return view('livewire.customer.edit-customer');
    }
}
